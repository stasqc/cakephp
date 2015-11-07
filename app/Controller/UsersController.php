<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        //beforeFilter - seulement le droit de faire add si pas enregistré
        public function beforeFilter()
        {
            $this->Auth->allow('login', 'logout', 'add', 'activate', 'resend');  
        }
        
        //Fonction login - si login marche, redirect URL (dans app controller)
       public function login() {
        if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    //Si pas authorise
                    if(($this->User->checkIfUserConfirmed($this->Auth->user('id'))) === FALSE)
                    {
                            $this->Session->setFlash(__('Note that you won\'t be able to make a reservation since you haven\'t confirmed your e-mail yet.'), 'flash/warning');
                    }
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }

        public function logout() {
            return $this->redirect($this->Auth->logout());
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
                            $theUser = $this->User->find('first', array('conditions' => array('User.id' => $this->User->getLastInsertID())));
                                $this->User->envoyerEmail
                                        ($theUser['User']['username'], 
                                        $theUser['User']['password'], 
                                        $theUser['User']['email'], 
                                        $theUser['User']['id']);
				$this->Session->setFlash(__('The user has been saved'), 'flash/success');
				$this->redirect(array('action' => 'login'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$books = $this->User->Book->find('list');
		$this->set(compact('books'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->User->id = $id;
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$books = $this->User->Book->find('list');
		$this->set(compact('books'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
                if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}                
                //À insérer la validation ici
                        $options['joins'] = array(
                          array(
                              'table' => 'books_users',
                              'type' => 'inner',
                              'conditions' => array(
                                  'user.id = books_users.user_id',
                                  'books_users.user_id = '.$this->User->id
                              )
                          )  
                        );
                        $numberOfReservations = $this->User->find('count', $options);
                        //Il y a des réservations actitves, impossible de supprimer
                        if($numberOfReservations > 0)
                        {
                            $this->Session->setFlash(__('Cannot delete user as there are associated reservations with it!'), 'flash/error');
                            $this->redirect(array('action' => 'index'));
                        }
                        else
                        {
                            if ($this->User->delete()) {
                                $this->Session->setFlash(__('User deleted'), 'flash/success');
                                $this->redirect(array('action' => 'index'));
                            }
                                $this->Session->setFlash(__('User was not deleted'), 'flash/error');
                                $this->redirect(array('action' => 'index'));
                            }
	}
        
        public function activate($token)
        {
            //Si activation OK
            if($this->User->activateMethod($token) === TRUE)
            {
                $this->Session->setFlash(__('Successfully activated your account. You can now make reservations.'), 'flash/success');
                $this->redirect(array('action' => 'login'));
            }
            else
            {
                $this->Session->setFlash(__('Could not activate the account!'), 'flash/error');
                $this->redirect(array('controller' => 'books','action' => 'index'));                
            }
        }
        
        //Pour re-envoyer
        public function resend()
        {
            //Seulement si logged in et si pas déjà authentifé
            if(!empty($this->Auth->user()) && !$this->User->checkIfUserConfirmed($this->Auth->user('id')))
            {
                $theUser = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
                $this->User->envoyerEmail
                    ($theUser['User']['username'], $theUser['User']['password'], $theUser['User']['email'], $theUser['User']['id']);
                $this->Session->setFlash(__('Confirmation e-mail has been sent'), 'flash/success');
                $this->redirect(array('controller' => 'books','action' => 'index'));     
            }
            else
            {
                $this->Session->setFlash(__('You must be logged in to perform this action'), 'flash/error');
                $this->redirect(array('controller' => 'books','action' => 'index'));        
            }
            

    }
        

}
