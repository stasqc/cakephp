<?php
App::uses('AppController', 'Controller');
/**
 * Covers Controller
 *
 * @property Cover $Cover
 * @property PaginatorComponent $Paginator
 */
class CoversController extends AppController {

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
		$this->Cover->recursive = 0;
		$this->set('covers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cover->exists($id)) {
			throw new NotFoundException(__('Invalid cover'));
		}
		$options = array('conditions' => array('Cover.' . $this->Cover->primaryKey => $id));
		$this->set('cover', $this->Cover->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cover->create();
			if ($this->Cover->save($this->request->data)) {
				$this->Session->setFlash(__('The cover has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cover could not be saved. Please, try again.'), 'flash/error');
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
        $this->Cover->id = $id;
		if (!$this->Cover->exists($id)) {
			throw new NotFoundException(__('Invalid cover'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cover->save($this->request->data)) {
				$this->Session->setFlash(__('The cover has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cover could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Cover.' . $this->Cover->primaryKey => $id));
			$this->request->data = $this->Cover->find('first', $options);
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
		$this->Cover->id = $id;
		if (!$this->Cover->exists()) {
			throw new NotFoundException(__('Invalid cover'));
		}
                //À insérer la validation ici
                        $options['joins'] = array(
                          array(
                              'table' => 'books',
                              'type' => 'inner',
                              'conditions' => array(
                                  'cover.id = books.cover_id',
                                  'books.cover_id = '.$this->Cover->id
                              )
                          )  
                        );
                        $numberOfReservations = $this->Cover->find('count', $options);
                        //Il y a des réservations actitves, impossible de supprimer
                        if($numberOfReservations > 0)
                        {
                            $this->Session->setFlash(__('Cannot delete cover as there are associated books to it!'), 'flash/error');
                            $this->redirect(array('action' => 'index'));
                        }
                        else
                        {
                            if ($this->Cover->delete()) {
                                    $this->Session->setFlash(__('Cover deleted'), 'flash/success');
                                    $this->redirect(array('action' => 'index'));
                            }
                            $this->Session->setFlash(__('Cover was not deleted'), 'flash/error');
                            $this->redirect(array('action' => 'index'));
                        }
                
                
                
                
                
                

	}
        
        
        //Personne ne peut voir les covers apart admin
        public function beforeFilter() {
            $this->Auth->deny('index');
        }
}
