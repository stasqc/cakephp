<?php
App::uses('AppController', 'Controller');
/**
 * BooksCategories Controller
 *
 * @property BooksCategory $BooksCategory
 * @property PaginatorComponent $Paginator
 */
class BooksCategoriesController extends AppController {

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
		$this->BooksCategory->recursive = 0;
		$this->set('booksCategories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BooksCategory->exists($id)) {
			throw new NotFoundException(__('Invalid books category'));
		}
		$options = array('conditions' => array('BooksCategory.' . $this->BooksCategory->primaryKey => $id));
		$this->set('booksCategory', $this->BooksCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BooksCategory->create();
			if ($this->BooksCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The books category has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The books category could not be saved. Please, try again.'), 'flash/error');
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
        $this->BooksCategory->id = $id;
		if (!$this->BooksCategory->exists($id)) {
			throw new NotFoundException(__('Invalid books category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BooksCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The books category has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The books category could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('BooksCategory.' . $this->BooksCategory->primaryKey => $id));
			$this->request->data = $this->BooksCategory->find('first', $options);
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
		$this->BooksCategory->id = $id;
		if (!$this->BooksCategory->exists()) {
			throw new NotFoundException(__('Invalid books category'));
		}
		if ($this->BooksCategory->delete()) {
			$this->Session->setFlash(__('Books category deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Books category was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
