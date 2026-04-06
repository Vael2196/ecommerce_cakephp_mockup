<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
//        $query = $this->Users->find();
//        $users = $this->paginate($query);
//
//        $this->set(compact('users'));

        $this->paginate = [
            'limit' => 10,
            'order' => ['username' => 'asc']
        ];

        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login']);
        $this->Authentication->addUnauthenticatedActions(['register']);
//                $this->Authentication->addUnauthenticatedActions(['add']);
//                $this->Authentication->addUnauthenticatedActions(['view']);
//                $this->Authentication->addUnauthenticatedActions(['index']);
        $action = $this->request->getParam('action');
        if (!in_array($action, ['login', 'register', 'logout'])) {
            $user = $this->request->getAttribute('identity');
            if (!$user || $user->role != 1) {
                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            }
        }
    }
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();

//        if ($result->isValid()) {
//            $target = $this->Authentication->getLoginRedirect() ?? '/';
//            return $this->redirect($target);
//        }

        if ($result->isValid()) {
            $user = $this->request->getAttribute('identity');
            if ($user->role == 1) {
                $target = $this->Authentication->getLoginRedirect() ?? '/';
                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']); //redirects admin users to an admin dashboard
            } else {
                $target = $this->Authentication->getLoginRedirect() ?? '/';
                return $this->redirect($target);
            }
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password.');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
    }

    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['role'] = 0; //raw doggin' this; might not be the best solution, but I don't want to deal with another migration rn
            // TODO: Placeholder for any additional validation logic
            // CakePHP doesn't really check the validity of emails or how long the passwords are,
            // so this might require some additional actions in the future
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $cartsTable = $this->fetchTable('Carts');
                $cart = $cartsTable->newEmptyEntity();
                $cartData = [
                    'user_id' => $user->id,
                    'cart_total' => 0.00
                ];
                $cart = $cartsTable->patchEntity($cart, $cartData);
                if ($cartsTable->save($cart)) {
                    $this->Flash->success(__('Your account and cart have been created successfully.'));
                } else {
                    $this->Flash->warning(__('Your account was created but your cart is missing'));
                }
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to register, please try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function dashboard(){
        $user = $this->request->getAttribute('identity');
        if ($user->role != 1) {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }

    }
}
