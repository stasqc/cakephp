<?php
App::uses('AppController', 'Controller');
/**
 * BooksUsers Controller
 *
 * @property BooksUser $BooksUser
 * @property PaginatorComponent $Paginator
 */
class BooksUsersController extends AppController {
    
    //Ceci est seulement une classe "liante" donc on n'affiche rien
        public function beforeFilter()
    {
        $this->Auth->deny('all');
    }
    //Aucune action dans booksusers n'est autorisée
    public function isAuthorized($user) {
        return false;
    }
    
    

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BooksUser->recursive = 0;
		$this->set('booksUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BooksUser->exists($id)) {
			throw new NotFoundException(__('Invalid books user'));
		}
		$options = array('conditions' => array('BooksUser.' . $this->BooksUser->primaryKey => $id));
		$this->set('booksUser', $this->BooksUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BooksUser->create();
			if ($this->BooksUser->save($this->request->data)) {
				$this->Session->setFlash(__('The books user has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The books user could not be saved. Please, try again.'), 'flash/error');
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->BooksUser->id = $id;
		if (!$this->BooksUser->exists($id)) {
			throw new NotFoundException(__('Invalid books user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BooksUser->save($this->request->data)) {
				$this->Session->setFlash(__('The books user has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The books user could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('BooksUser.' . $this->BooksUser->primaryKey => $id));
			$this->request->data = $this->BooksUser->find('first', $options);
		}
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
		$this->BooksUser->id = $id;
		if (!$this->BooksUser->exists()) {
			throw new NotFoundException(__('Invalid books user'));
		}
		if ($this->BooksUser->delete()) {
			$this->Session->setFlash(__('Books user deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Books user was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
