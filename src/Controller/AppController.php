<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    /**
     * Centralised authorization check.
     * This method should return true if the user is allowed to access the current request.
     *
     * In this example, if the current controller is one of the admin controllers
     * (Messages (except contact), Products, Users, or Carts), then only users with
     * role == 1 (admin) will be authorized.
     *
     * V: This creates a bit of a mess, considering that there also are beforeFilter() functions, but I wanna make them call this method instead
     *
     * @param array $user
     * @return bool
     */
    public function isAuthorized($user)
    {
        $currentController = $this->request->getParam('controller');
        $currentAction = $this->request->getParam('action');

        $adminControllers = ['Messages', 'Products', 'Users', 'Carts', 'Suppliers'];

        // Exception handling:
        if ($currentController === 'Messages' && $currentAction === 'contact') {
            return true;
        } elseif ($currentController === 'Users' && $currentAction === 'login') {
            return true;
        } elseif ($currentController === 'Users' && $currentAction === 'logout') {
            return true;
        } elseif ($currentController === 'Users' && $currentAction === 'register') {
            return true;
        } elseif ($currentController === 'Carts' && $currentAction === 'addToCart') {
            return true;
        } elseif ($currentController === 'Carts' && $currentAction === 'myCart') {
            return true;
        } elseif ($currentController === 'Carts' && $currentAction === 'remove') {
            return true;
//        elseif ($currentController === 'Pages' && $currentAction === 'home') {
//            return true;
//        } elseif ($currentController === 'Pages' && $currentAction === 'faq') {
//            return true;
        }

        if (in_array($currentController, $adminControllers, true)) {
            if (isset($user['role']) && $user['role'] == 1) {
                return true;
            }
//            $this->Flash->error(__('You are not authorized to access that page.'));
            return false;
        }

        return true;
    }

    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        parent::beforeRender($event);

        // only load once, skip if already set
        if (!isset($this->viewBuilder()->getVars()['footerBlocks'])) {
            $footerBlocks = $this->getTableLocator()
                ->get('ContentBlocks')
                ->find()
                ->where(['page' => 'footer'])
                ->order(['id' => 'ASC'])
                ->all();
            $this->set(compact('footerBlocks'));
        }
    }

}
