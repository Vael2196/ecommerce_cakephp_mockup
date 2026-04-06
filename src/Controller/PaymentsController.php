<?php

declare(strict_types=1);

namespace App\Controller;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Cake\Core\Configure;



/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 */
class PaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Payments->find()
            ->contain(['Orders']);
        $payments = $this->paginate($query);

        $this->set(compact('payments'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payments->get($id, contain: ['Orders']);
        $this->set(compact('payment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $payment = $this->Payments->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $payment = $this->Payments->patchEntity($payment, $this->request->getData());
    //         if ($this->Payments->save($payment)) {
    //             $this->Flash->success(__('The payment has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The payment could not be saved. Please, try again.'));
    //     }
    //     $orders = $this->Payments->Orders->find('list', limit: 200)->all();
    //     $this->set(compact('payment', 'orders'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $orders = $this->Payments->Orders->find('list', limit: 200)->all();
        $this->set(compact('payment', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function success()
    {
        $sessionId = $this->request->getQuery('session_id');
        \Stripe\Stripe::setApiKey(Configure::read('Stripe.secret'));

        $session = \Stripe\Checkout\Session::retrieve($sessionId);
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        $orderId = $paymentIntent->metadata->order_id ?? null;

        if (!$orderId) {
            $this->Flash->error('Could not find order ID in Stripe session.');
            return $this->redirect('/');
        }

        $payment = $this->Payments->newEmptyEntity();
        $payment->order_id = $orderId;
        $payment->payment_date = date('Y-m-d H:i:s');
        $payment->payment_status = $paymentIntent->status;

        if ($this->Payments->save($payment)) {
            $order = $this->Payments->Orders->get($orderId);

            $order->order_status = 1;
            $this->Payments->Orders->save($order);


            // if ($order->order_status == 1) {
            //     $cartId = $order->cart_id;

            //     // Delete cart products
            //     $cartProductsTable = $this->fetchTable('CartProducts');
            //     $cartProductsTable->deleteAll(['cart_id' => $cartId]);

            //     // Reset cart total
            //     $cartTable = $this->fetchTable('Carts');
            //     $cart = $cartTable->get($cartId);
            //     $cart->cart_total = 0;
            //     $cartTable->save($cart);
            // }

            $this->Flash->success('Payment was successful');
        } else {
            $this->Flash->error('Payment went through but failed to save. Please contact support');
        }

        return $this->redirect(['action' => 'thankYou', '?' => ['order' => $orderId]]);
    }

    public function thankYou()
    {
        $orderId = $this->request->getQuery('order');
        $order = $this->Payments->Orders->get($orderId, [
            'contain' => ['Users', 'Carts' => ['CartProducts' => ['Products']]]
        ]);

        $this->set(compact('order'));
    }

    public function finalizeOrder($cartId = null)
    {
        if (!$cartId) {
            $this->Flash->error('Missing cart ID.');
            return $this->redirect('/');
        }

        $cartProductsTable = $this->fetchTable('CartProducts');
        $cartTable = $this->fetchTable('Carts');

        // Delete all cart items
        $cartProductsTable->deleteAll(['cart_id' => $cartId]);

        // Reset total
        $cart = $cartTable->get($cartId);
        $cart->cart_total = 0;
        $cartTable->save($cart);

        $this->Flash->success('Order finalised. Cart has been cleared.');
        return $this->redirect('/');
    }
}
