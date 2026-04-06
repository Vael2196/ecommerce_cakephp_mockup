<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;

/**
 * ContentBlocks Controller
 *
 * @property \App\Model\Table\ContentBlocksTable $ContentBlocks
 */
class ContentBlocksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $page = $this->request->getQuery('page');
        $blocks = $this->ContentBlocks->find()
            ->where(['page' => $page])
            ->order(['id' => 'ASC'])
            ->all();

        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', ['blocks']);
        $this->set(compact('blocks'));
    }

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->Authentication->addUnauthenticatedActions(['index']);
    }

//    public function beforeFilter(EventInterface $event)
//    {
//        parent::beforeFilter($event);
//        $user = $this->request->getAttribute('identity');
//
//        $action = $this->request->getParam('action');
//        if (in_array($action, ['add','edit','delete'], true)) {
//            if (!$user || ((string)$user->role) !== '1') {
//                throw new ForbiddenException('Not authorized');
//            }
//        }
//    }

    /**
     * View method
     *
     * @param string|null $id Content Block id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contentBlock = $this->ContentBlocks->get($id, contain: ['ParentContentBlocks', 'ChildContentBlocks']);
        $this->set(compact('contentBlock'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', ['success','block']);
        $this->request->allowMethod(['post']);
        $block = $this->ContentBlocks->newEmptyEntity();
        if ($this->request->is('post')) {
            $block = $this->ContentBlocks->patchEntity($block, $this->request->getData());
            if ($this->ContentBlocks->save($block)) {
                $this->set(['block'=>$block, 'success'=>true, '_serialize'=>['success','block']]);
                return;
            }
        }
        $this->set(['success'=>false,'errors'=>$block->getErrors(),'_serialize'=>['success','errors']]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content Block id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', ['success','block']);
        $this->request->allowMethod(['post','put','patch']);
        $block = $this->ContentBlocks->get($id);
        if ($this->request->is(['get','patch','post','put'])) {
            $block = $this->ContentBlocks->patchEntity($block, $this->request->getData());
            if ($this->ContentBlocks->save($block)) {
                $this->set(['success'=>true,'block'=>$block,'_serialize'=>['success','block']]);
                return;
            }
        }
        $this->set(['success'=>false,'errors'=>$block->getErrors(),'_serialize'=>['success','errors']]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content Block id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', ['success']);
        $this->request->allowMethod(['get','post','delete']);
        $block = $this->ContentBlocks->get($id);
        $success = $this->ContentBlocks->delete($block);
        $this->set(compact('success'));
    }
}
