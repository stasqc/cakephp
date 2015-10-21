<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $theme = "Cakestrap";
    //A noter: Auth modifié à cause d'un bug (Non-authorisé mais logged, on se
    //fait redirect a libray/library/books donc besoin du fix avec
    //unauthorizedRedirect
    //github.com/cakephp/cakephp/issues/4812
    
     public $helpers = array('I18n.I18n');
    
    //Faire les components et la facon dont on hash les mots de passe
    public $components = array(
        'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'books',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'books',
                'action' => 'index',
                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                ),
                
            ),
            'authorize' => array('Controller'),
            'unauthorizedRedirect' => array(
                'controller' => 'books',
                'action' => 'index',
                'prefix' => false
            )
        ),
        'Session',
        'DebugKit.Toolbar',
    );
    
    public function beforeRender()
    {
        $this->set('title_for_layout', "Your local collection of books");
        //Pour savoir si l'utilisateur est logged in
        if($this->Auth->user())
        {
            $this->set('authUser', $this->Auth->user('role'));
        }
        else
        {
            $this->set('authUser', null);
        }
    }
    
    
    public function beforeFilter()
    {
        $this->Auth->allow('index');
        $this->Paginator->settings=array('limit' => 5);
    }
    
    
    //Admin peut tout acceder
    public function isAuthorized($user)
    {
        if(isset($user['role'])&& $user['role'] === 'Admin')
        {
            return true;
        }
        
        //Default: false
        return false;
    }

    
        
    
    
}
