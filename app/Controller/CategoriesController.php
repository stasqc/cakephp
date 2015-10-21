<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

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
		$this->Category->recursive = 1;
		$this->set('categories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'), 'flash/error');
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
        $this->Category->id = $id;
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
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
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
                
                //À insérer la validation ici
                        $options['joins'] = array(
                          array(
                              'table' => 'books_categories',
                              'type' => 'inner',
                              'conditions' => array(
                                  'category.id = books_categories.category_id',
                                  'books_categories.category_id = '.$this->Category->id
                              )
                          )  
                        );
                        $numberOfReservations = $this->Category->find('count', $options);
                        //Il y a des réservations actitves, impossible de supprimer
                        if($numberOfReservations > 0)
                        {
                            $this->Session->setFlash(__('Cannot delete cover as it is already associated to a book!'), 'flash/error');
                            $this->redirect(array('action' => 'index'));
                        }
                        else
                        {
                            if ($this->Category->delete()) {
                                    $this->Session->setFlash(__('Category deleted'), 'flash/success');
                                    $this->redirect(array('action' => 'index'));
                            }
                            $this->Session->setFlash(__('Category was not deleted'), 'flash/error');
                            $this->redirect(array('action' => 'index'));
                        }
                
                
                
                
                
                

	}
        
                //Pour l'autorisation
        public function beforeFilter()
            {
                parent::beforeFilter();
                $this->Auth->allow('index', 'view');  
            }
}
