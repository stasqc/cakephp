<?php
App::uses('AppController', 'Controller');
/**
 * Books Controller
 *
 * @property Book $Book
 * @property PaginatorComponent $Paginator
 */
class BooksController extends AppController {

/**
 * Components
 *
 * @var array
 */
    

    
	public $components = array('Paginator', 'RequestHandler');
       // public $layout = 'defaultjquery';
        
        //beforeFilter pour donner le droit a index seulement!
        public function beforeFilter()
        {
            parent::beforeFilter();
            $this->Auth->allow('index', 'view', 'search');  
        }
        

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Book->recursive = 1;
		$this->set('books', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Book->exists($id)) {
			throw new NotFoundException(__('Invalid book'));
		}
		$options = array('conditions' => array('Book.' . $this->Book->primaryKey => $id));
		$this->set('book', $this->Book->find('first', $options));
	}
        
        


/**
 * add method
 *
 * @return void
 */
	public function add() {
            
          
               
            
            
		if ($this->request->is('post')) {
			$this->Book->create();
                        //À cause de la modification JQuery autocomplete, il faut
                        //aller prendre la corréspondance nom-id
                        $nameAuthor = $this->request->data['Book']['authorName'];
                        $idAuthor = $this->Book->getAuthorID($nameAuthor);
                        $this->request->data['Book']['author_id'] = $idAuthor;                        
			if ($this->Book->save($this->request->data)) {
				$this->Session->setFlash(__('The book has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$authors = $this->Book->Author->find('list');
		$covers = $this->Book->Cover->find('list');
		$categories = $this->Book->Category->find('list');
                $this->Book->recursive = 1;
		$users = $this->Book->User->find('list');
		$this->set(compact('authors', 'covers', 'categories', 'users'));
                
                 if ($this->request->is('ajax')) {
                  $term = $this->request->query('term');
                  $authorNames = $this->Book->getAuthorNames($term);
                  $this->set(compact('authorNames'));
                  $this->set('_serialize', 'authorNames');
                }
	}

        public function search()
        {
            $args = "";
            if($this->request->is('get'))
            {   
                $args = "";
                if (isset($this->params['url']['title']))
                {
                    $args = $this->params['url']['title']; 
                }
                               
                $data = $this->Paginator->paginate('Book', array('Book.title LIKE' => "%$args%"));
                $this->set('books', $data);
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
        $this->Book->id = $id;
                        if ($this->request->is('ajax')) {
                  $term = $this->request->query('term');
                  $authorNames = $this->Book->getAuthorNames($term);
                  $this->set(compact('authorNames'));
                  $this->set('_serialize', 'authorNames');

                }
        
		if (!$this->Book->exists($id)) {
			throw new NotFoundException(__('Invalid book'));
		}

                
                
		if ($this->request->is('post') || $this->request->is('put')) {
                    $data = $this->request->data['Book'];
                    if (!$data['filename']['name']){
                        unset($data['filename']);
                    }     
			if ($this->Book->save($this->request->data)) {
				$this->Session->setFlash(__('The book has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Book.' . $this->Book->primaryKey => $id));
			$this->request->data = $this->Book->find('first', $options);
		}
		$authors = $this->Book->Author->find('list');
                $theAuthor = $this->Book->Author->find('first');
                $theAuthor = $theAuthor['Author']['name'];
		$covers = $this->Book->Cover->find('list');
		$categories = $this->Book->Category->find('list');
		$users = $this->Book->User->find('list');
		$this->set(compact('authors', 'covers', 'categories', 'users'));
                $this->set('theAuthor', $theAuthor);
                
                 
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
		$this->Book->id = $id;
		if (!$this->Book->exists()) {
			throw new NotFoundException(__('Invalid book'));
		}
                    //À insérer la validation ici
                        $options['joins'] = array(
                          array(
                              'table' => 'books_users',
                              'type' => 'inner',
                              'conditions' => array(
                                  'book.id = books_users.book_id',
                                  'books_users.book_id = '.$this->Book->id
                              )
                          )  
                        );
                        $numberOfReservations = $this->Book->find('count', $options);
                        //Il y a des réservations actitves, impossible de supprimer
                        if($numberOfReservations > 0)
                        {
                            $this->Session->setFlash(__('Cannot delete book as it is currently reserved!'), 'flash/error');
                            $this->redirect(array('action' => 'index'));
                        }
                        else
                        {
                           if ($this->Book->delete()) {
                                $this->Session->setFlash(__('Book deleted'), 'flash/success');
                                $this->redirect(array('action' => 'index'));
                              }
                                $this->Session->setFlash(__('Book was not deleted'), 'flash/error');
                                $this->redirect(array('action' => 'index'));
                         }
                
                
                
                
                
                
                
                
                
                

	}
        

}
