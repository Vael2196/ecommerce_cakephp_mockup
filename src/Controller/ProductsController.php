<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
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
     * Index method for pagination on index pages
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 10,
            'order' => ['product_name' => 'asc']
        ];

        $products = $this->paginate($this->Products->find()->contain(['Suppliers']));
        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, contain: ['Suppliers', 'CartProducts']);
        $this->set(compact('product'));
    }

    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        $suppliers = $this->Products->Suppliers->find('list', limit: 200)->all();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if (!empty($data['image']) && is_object($data['image']) && method_exists($data['image'], 'getClientFilename')) {
                $file = $data['image'];

                //checks image size is below 2mb
                if ($file->getSize() > 2 * 1024 * 1024) {
                    $this->Flash->error(__('Image exceeds maximum size of 2MB.'));
                    unset($data['image']);
                    $product = $this->Products->patchEntity($product, $data);
                    $this->set(compact('product', 'suppliers'));
                    return $this->render('add');
                }


                if ($file->getError() === UPLOAD_ERR_OK) {
                    $originalFilename = $file->getClientFilename();
                    $ext = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];

                    $finfo = new \finfo(FILEINFO_MIME_TYPE);
                    $mimeType = $finfo->file($file->getStream()->getMetadata('uri'));

                    if (in_array($ext, $allowedExtensions) && in_array($mimeType, $allowedMimeTypes)) {
                        $newFilename = uniqid() . '.' . $ext;
                        $targetPath = WWW_ROOT . 'img' . DS . 'products' . DS . $newFilename;
                        $file->moveTo($targetPath);
                        $data['image'] = $newFilename;
                    } else {
                        $this->Flash->error(__('Invalid file type. Only JPG, JPEG, PNG, and WEBP images are allowed.'));
                        unset($data['image']); // prevent object from being passed
                        $product = $this->Products->patchEntity($product, $data);
                        $this->set(compact('product', 'suppliers'));
                        return $this->render('add');
                    }
                } else {
                    unset($data['image']); // upload error, remove key
                }
            } else {
                unset($data['image']); // not a valid file
            }

            $product = $this->Products->patchEntity($product, $data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $this->set(compact('product', 'suppliers'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, contain: ['Suppliers']);
        $suppliers = $this->Products->Suppliers->find('list', limit: 200)->all();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if (!empty($data['image']) && is_object($data['image']) && method_exists($data['image'], 'getClientFilename')) {
                $file = $data['image'];

                // Check file size
                if ($file->getSize() > 2 * 1024 * 1024) {
                    $this->Flash->error(__('Image exceeds maximum size of 2MB.'));
                    unset($data['image']);
                    $product = $this->Products->patchEntity($product, $data);
                    $this->set(compact('product', 'suppliers'));
                    return $this->render('edit');
                }

                if ($file->getError() === UPLOAD_ERR_OK) {
                    $originalFilename = $file->getClientFilename();
                    $ext = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];

                    $finfo = new \finfo(FILEINFO_MIME_TYPE);
                    $mimeType = $finfo->file($file->getStream()->getMetadata('uri'));

                    if (in_array($ext, $allowedExtensions) && in_array($mimeType, $allowedMimeTypes)) {
                        //DELETE old image if it exists!!
                        if (!empty($product->image)) {
                            $oldImagePath = WWW_ROOT . 'img' . DS . 'products' . DS . $product->image;
                            if (file_exists($oldImagePath)) {
                                unlink($oldImagePath);
                            }
                        }

                        //Allow for new image
                        $newFilename = uniqid() . '.' . $ext;
                        $targetPath = WWW_ROOT . 'img' . DS . 'products' . DS . $newFilename;
                        $file->moveTo($targetPath);
                        $data['image'] = $newFilename;
                    } else {
                        $this->Flash->error(__('Invalid file type. Only JPG, JPEG, PNG, and WEBP images are allowed.'));
                        unset($data['image']);
                        $product = $this->Products->patchEntity($product, $data);
                        $this->set(compact('product', 'suppliers'));
                        return $this->render('edit');
                    }
                } else {
                    unset($data['image']);
                }
            } else {
                unset($data['image']);
            }

//            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product = $this->Products->patchEntity($product, $data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                // if product stock is less than 20 the relevant supplier will receive an email to restock
                if ($product->quantity < 20 && !empty($product->supplier->email)) {
                    $this->checkStockAndNotify($product->id);
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product', 'suppliers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //Function to check the stock level of each product every time it gets edited
    public function checkStockAndNotify($productId)
    {
        $product = $this->Products->get($productId, contain: ['Suppliers']);

        if ($product->quantity < 20) {
            $mailer = new \Cake\Mailer\Mailer('default');
            $mailer
                ->setEmailFormat('html')
                ->setTo($product->supplier->email)
                // cc the crunchycravings manager so they have an email record of the notification
                ->addCc('crunchy_cravings@u25s1076.iedev.org')
                ->setSubject('Low Stock Alert')
                ->setViewVars(['product' => $product])
                ->viewBuilder()
                ->setTemplate('default');

            $mailer->deliver();
            $this->Flash->success('Notification email sent to Supplier.');
        } else {
            $this->Flash->success('Stock is sufficient. No email sent.');
        }

        return $this->redirect(['action' => 'view', $productId]);
    }


//    /**
//     * Remove product that has been added to cart method
//     * When customer goes into My Cart
//     *
//     */
//    public function remove($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//
//        // Load the CartProducts table
//        $this->loadModel('CartProducts');
//
//        // Attempt to get the cart product row by its ID
//        $Product = $this->Products->get($id);
//
//        if ($this->Products->delete($id)) {
//            $this->Flash->success(__('The product has been removed from your cart.'));
//        } else {
//            $this->Flash->error(__('The product could not be removed from your cart. Please try again.'));
//        }
//    }

    /**
     * Display a type of product on shop page to customers
     * Types: All, crackers, hampers, charcuterie boards
     */
    public function catalog()
    {
        $query = $this->Products->find();

        $type = $this->request->getQuery('type');
        if (!empty($type)) {
            $query->where(['product_type' => $type]);
        }

        $products = $this->paginate($query);

        $this->set(compact('products'));
    }
}

    /**
     * Display a type of product on shop page to customers
     * Types: All, crackers, hampers, charcuterie boards
     */
