<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Carts Controller
 *
 * @property \App\Model\Table\CartsTable $Carts
 */
class CartsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $action = $this->request->getParam('action');
        if (in_array($action, ['addToCart', 'myCart', 'remove', 'updateQuantity'], true)) {
            return;
        }

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
        $query = $this->Carts->find()
            ->contain(['Users']);
        $carts = $this->paginate($query);

        $this->set(compact('carts'));
    }

    /**
     * View method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cart = $this->Carts->get($id, contain: ['Users', 'CartProducts']);
        $this->set(compact('cart'));
    }

    public function addToCart($productId = null)
    {
        $this->autoRender = false;
        $user = $this->request->getAttribute('identity');
        if (!$user) {
            $this->Flash->error(__('Please register or log in before adding items to your cart.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'register']);
        }

        $cartsTable = $this->fetchTable('Carts');
        $cart = $cartsTable->find()->where(['user_id' => $user->id])->first();
        if (!$cart) {
            $this->Authentication->logout();
            $this->Flash->error(__('There was an error with your cart. Please register again or contact support.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'register']);
        }

        $quantity = (int)$this->request->getQuery('quantity');
        if ($quantity < 1) {
            $quantity = 1;
        }

        $cartProductsTable = $this->fetchTable('CartProducts');
        $existing = $cartProductsTable->find()
            ->where([
                'cart_id' => $cart->id,
                'product_id' => $productId
            ])
            ->first();

        $productsTable = $this->fetchTable('Products');
        try {
            $product = $productsTable->get($productId);
        } catch (\Exception $e) {
            $this->Flash->error(__('Product not found.'));
            return $this->redirect($this->referer());
        }

        if ($existing) {
            $existing->product_quantity += $quantity;
            $existing->subtotal = $product->price * $existing->product_quantity;
            $cartProductsTable->save($existing);
        } else {
            $newCartProduct = $cartProductsTable->newEmptyEntity();
            $newCartProduct->cart_id = $cart->id;
            $newCartProduct->product_id = $productId;
            $newCartProduct->product_quantity = $quantity;
            $newCartProduct->subtotal = $product->price * $quantity;
            $cartProductsTable->save($newCartProduct);
        }

        $totalQuery = $cartProductsTable->find()
            ->select(['total' => $cartProductsTable->find()->func()->sum('subtotal')])
            ->where(['cart_id' => $cart->id]);
        $totalResult = $totalQuery->first();
        $cart->cart_total = $totalResult ? $totalResult->total : 0;
        $cartsTable->save($cart);

        $this->Flash->success(__('Product added to your cart.'));
        return $this->redirect($this->referer());
    }

    public function myCart()
    {
        $user = $this->request->getAttribute('identity');
        if (!$user) {
            $this->Flash->error(__('Please log in to view your cart.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $cartsTable = $this->fetchTable('Carts');
        $cart = $cartsTable->find()
            ->contain([
                'CartProducts' => function ($q) {
                    return $q->contain(['Products']);
                }
            ])
            ->where(['Carts.user_id' => $user->id])
            ->first();

        $this->set(compact('cart'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cart = $this->Carts->newEmptyEntity();
        if ($this->request->is('post')) {
            $cart = $this->Carts->patchEntity($cart, $this->request->getData());
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }
        $users = $this->Carts->Users->find('list', limit: 200)->all();
        $this->set(compact('cart', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cart = $this->Carts->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->Carts->patchEntity($cart, $this->request->getData());
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }
        $users = $this->Carts->Users->find('list', limit: 200)->all();
        $this->set(compact('cart', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The cart has been deleted.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Remove product that has been added to cart method
     * When customer goes into My Cart
     *
     */
    public function remove($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $cartProductsTable = $this->fetchTable('CartProducts');

        try {
            $cartProduct = $cartProductsTable->get($id);
        } catch (\Exception $e) {
            $this->Flash->error(__('Item not found.'));
            return $this->redirect(['action' => 'myCart']);
        }

        $cartId = $cartProduct->cart_id;

        if ($cartProductsTable->delete($cartProduct)) {
            $this->Flash->success(__('The item has been removed from your cart.'));
        } else {
            $this->Flash->error(__('The item could not be removed. Please try again.'));
        }

        $remainingTotal = $cartProductsTable->find()
            ->select(['sum' => $cartProductsTable->find()->func()->sum('subtotal')])
            ->where(['cart_id' => $cartId])
            ->first()
            ->sum ?? 0;

        $cartsTable = $this->fetchTable('Carts');
        $cart = $cartsTable->get($cartId);
        $cart->cart_total = $remainingTotal;
        $cartsTable->save($cart);

        return $this->redirect(['action' => 'myCart']);
    }

    public function updateQuantity($cartProductId)
    {
        $this->request->allowMethod(['post']);
        $CPs = $this->fetchTable('CartProducts');
        $cp  = $CPs->get($cartProductId, ['contain'=>['Products']]);
        
        $q = max(1, (int)$this->request->getData('quantity'));
        $cp->product_quantity = $q;
        $cp->subtotal         = $cp->product->price * $q;
        $CPs->save($cp);

        $Cs = $this->fetchTable('Carts');
        $cart = $Cs->get($cp->cart_id);
        $sum  = $CPs->find()
            ->where(['cart_id'=>$cart->id])
            ->select(['t'=>$CPs->find()->func()->sum('subtotal')])
            ->first()->t ?: 0;
        $cart->cart_total = $sum;
        $Cs->save($cart);

        $this->Flash->success(__('Cart updated.'));
        return $this->redirect(['action'=>'myCart']);
    }
}
