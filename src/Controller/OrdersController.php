<?php

declare(strict_types=1);

namespace App\Controller;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Event\EventInterface;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $user = $this->request->getAttribute('identity');
        if (!$this->isAuthorized($user)) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Orders->find()
            ->contain(['Users', 'Carts']);
        $orders = $this->paginate($query);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, contain: ['Users', 'Carts']);
        $this->set(compact('order'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $carts = $this->Orders->Carts->find('list', limit: 200)->all();
        $this->set(compact('order', 'users', 'carts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $carts = $this->Orders->Carts->find('list', limit: 200)->all();
        $this->set(compact('order', 'users', 'carts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function checkout($id = null)
    {
        $order = $this->Orders->get($id, contain : ['Users', 'Carts']);
        Stripe::setApiKey(Configure::read('Stripe.secret'));

        // Get all cart products for this order's cart_id
        $cartsProductsTable = $this->fetchTable('CartProducts');
        $cartProducts = $cartsProductsTable->find()
            ->contain(['Products'])
            ->where(['cart_id' => $order->cart_id])
            ->all();

        // Build Stripe line items
        $lineItems = [];

        foreach ($cartProducts as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'aud',
                    'unit_amount' => $item->product->price * 100,
                    'product_data' => [
                        'name' => $item->product->product_name,
                    ],
                ],
                'quantity' => $item->product_quantity,
            ];
        }

        // Create checkout session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'payment_intent_data' => [
                'metadata' => [
                    'order_id' => $order->id,
                ],
            ],
            'success_url' => Router::url(['controller' => 'Payments', 'action' => 'success'], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => Router::url('/', true),

        ]);

        return $this->redirect($session->url);
    }

    public function orderSummary($cartId = null)
    {
        $ordersTable = $this->fetchTable('Orders');
        $cartsTable = $this->fetchTable('Carts');

        // Try to find an order for the given cart
        $order = $ordersTable->find()
            ->contain(['Carts' => ['CartProducts' => ['Products']], 'Users'])
            ->where(['Orders.cart_id' => $cartId])
            ->first();

        // If no order exists, create a new one
        if (!$order) {
            $cart = $cartsTable->get($cartId,
                contain : ['CartProducts' => ['Products']
            ]);

            $user = $this->request->getAttribute('identity');

            $order = $ordersTable->newEmptyEntity();
            $order->user_id = $user->id;
            $order->cart_id = $cart->id;
            $order->order_createdAt = date('Y-m-d H:i:s');
            $order->order_status = 0;

            if (!$ordersTable->save($order)) {
                $this->Flash->error('Could not create an order for this cart.');
                return $this->redirect(['controller' => 'Carts', 'action' => 'myCart']);
            }

            // Re-fetch the order with associations
            $order = $ordersTable->get($order->id,
                contain : ['Carts' => ['CartProducts' => ['Products'], 'Users']
            ]);
        }

        $this->set(compact('order'));
    }


    public function confirmOrder($id = null)
    {
        $user = $this->request->getAttribute('identity');
        $cartTable = $this->fetchTable('Carts');
        $cart = $cartTable->get($id);

        $ordersTable = $this->fetchTable('Orders');
        $order = $ordersTable->newEmptyEntity();

        if ($this->request->is(['post', 'put', 'patch'])) {
            $order = $ordersTable->patchEntity($order, $this->request->getData());
            $order->user_id = $user->id;
            $order->cart_id = $cart->id;
            $order->order_createdAt = date('Y-m-d H:i:s');
            $order->order_status = 0; // pending

            if ($ordersTable->save($order)) {
                return $this->redirect(['action' => 'checkout', $order->id]);
            } else {
                $this->Flash->error(__('Could not save delivery address. Please try again.'));
            }
        }

        $this->set(compact('cart', 'order'));
    }
}
