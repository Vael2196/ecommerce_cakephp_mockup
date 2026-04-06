<?php
declare(strict_types=1);

namespace App\Controller;


use Cake\Event\EventInterface;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
//        $query = $this->Messages->find();
//        $messages = $this->paginate($query);
//
//        $this->set(compact('messages'));
//
        $this->paginate = [
            'order' => ['created' => 'desc'], //default order
            'limit' => 10,
        ];

        // Fetch paginated and sorted messages
        $messages = $this->paginate($this->Messages);

        // Pass to view
        $this->set(compact('messages'));
    }


    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['contact']);
        $action = $this->request->getParam('action');
        if (!in_array($action, ['contact'])) {
            $user = $this->request->getAttribute('identity');
            if (!$user || $user->role != 1) {
                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            }
        }
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, contain: []);
        $this->set(compact('message'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEmptyEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());//could limit characters from here
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $this->set(compact('message'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $this->set(compact('message'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function adminRespond($id = null)
    {
//        // Only allow admins (assuming your Auth component is configured)
//        $user = $this->Auth->user();
//        if (!$user || $user['role'] !== true) {
//            $this->Flash->error(__('Unauthorized access.'));
//            return $this->redirect(['action' => 'index']);
//        }

        $message = $this->Messages->get($id);
        if ($this->request->is(['post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            $message->responded = true;
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('Response saved successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The response could not be saved. Please try again.'));
        }
        $this->set(compact('message'));
    }

    public function contact()
    {
        $message = $this->Messages->newEmptyEntity();
        if ($this->request->is('post')) {
            $captchaResponse = $this->request->getData('g-recaptcha-response');
            $secretKey = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
            $userIP = $this->request->clientIp();

            $verificationUrl = 'https://www.google.com/recaptcha/api/siteverify?secret='
                . urlencode($secretKey) . '&response='
                . urlencode($captchaResponse) . '&remoteip='
                . urlencode($userIP);

            $verifyResponse = file_get_contents($verificationUrl);
            $responseData = json_decode($verifyResponse);

            if (!$responseData->success) {
                $this->Flash->error(__('Captcha verification failed, please try again.'));
            } else {
                $message = $this->Messages->patchEntity($message, $this->request->getData());
                if ($this->Messages->save($message)) {
                    $this->Flash->success(__('Thank you for contacting us!'));

                    $this->request = $this->request->withParsedBody([]); // Clears the form
                    $message = $this->Messages->newEmptyEntity(); //keeps user on contact us page
                } else {
                    $this->Flash->error(__('Message could not be saved. Please try again later or contact us manually.'));
                }
            }
        }
        $this->set(compact('message'));
    }
}
