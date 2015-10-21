<?php
App::uses('AppController', 'Controller');
/**
 * Authors Controller
 *
 * @property Author $Author
 * @property PaginatorComponent $Paginator
 */
class AuthorsController extends AppController {

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
                $this->Paginator->settings = array('limit' => 10);
		$this->Author->recursive = 0;
		$this->set('authors', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Author->exists($id)) {
			throw new NotFoundException(__('Invalid author'));
		}
		$options = array('conditions' => array('Author.' . $this->Author->primaryKey => $id));
		$this->set('author', $this->Author->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Author->create();
			if ($this->Author->save($this->request->data)) {
				$this->Session->setFlash(__('The author has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The author could not be saved. Please, try again.'), 'flash/error');
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
        $this->Author->id = $id;
		if (!$this->Author->exists($id)) {
			throw new NotFoundException(__('Invalid author'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Author->save($this->request->data)) {
				$this->Session->setFlash(__('The author has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The author could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Author.' . $this->Author->primaryKey => $id));
			$this->request->data = $this->Author->find('first', $options);
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
		$this->Author->id = $id;
		if (!$this->Author->exists()) {
			throw new NotFoundException(__('Invalid author'));
		}
                
                //À insérer la validation ici
                        $options['joins'] = array(
                          array(
                              'table' => 'books',
                              'type' => 'inner',
                              'conditions' => array(
                                  'author.id = books.author_id',
                                  'books.author_id = '.$this->Author->id
                              )
                          )  
                        );
                        $numberOfReservations = $this->Author->find('count', $options);
                        //Il y a des réservations actitves, impossible de supprimer
                        if($numberOfReservations > 0)
                        {
                            $this->Session->setFlash(__('Cannot delete author as there are associated books to him!'), 'flash/error');
                            $this->redirect(array('action' => 'index'));
                        }
                        else
                        {
                            if ($this->Author->delete()) {
                                $this->Session->setFlash(__('Author deleted'), 'flash/success');
                                $this->redirect(array('action' => 'index'));
                            }
                            $this->Session->setFlash(__('Author was not deleted'), 'flash/error');
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
