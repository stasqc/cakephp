<?php
App::uses('AppController', 'Controller');
/**
 * Reservations Controller
 *
 * @property Reservation $Reservation
 * @property PaginatorComponent $Paginator
 */
class ReservationsController extends AppController {

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
                
                //Il faudrait montrer des utilisateurs et des livres ici
		$this->Reservation->recursive = 1;
                
                
                //On a besoin de savoir qui qui a emprunté quoi
                $this->loadModel('BooksUser');
                $this->BooksUser->recursive = 1;
                

                
                
                if($this->Auth->user('role') === 'User')
                {
                      
                    //Si utilisateur
                    $this->Paginator->settings = array('Reservation' => array('joins' => array(array('table' => 'books_users',
                              'type' => 'inner',
                              'conditions' => array(
                                  'Reservation.books_users_id = books_users.id',
                                  'books_users.user_id = '.$this->Auth->user('id'),
                                  'Reservation.dateReturned IS NULL')))));
                    $bookUsers = $this->BooksUser->find('all', array('conditions' => array('user_id' => $this->Auth->user('id')), 'order' => 'BooksUser.id ASC'));
                    
                }
                
                else
                {
                    //Mais on a besoin de les mettre dans le même ordre que reservations
                    //(reservations a books_users_id donc on va faire le même ordre)
                    $bookUsers = $this->BooksUser->find('all', array('ORDER BY books_users.id ASC'));

                    //Data pour les reservations
                    $this->Paginator->settings = array('Reservation' => array('order' => array('books_users_id' => 'asc')));
                }
                
                
                
                
                
                
                
                
                
                $this->set('theBookUsers', $bookUsers);
		$this->set('reservations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Reservation->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		$options = array('conditions' => array('Reservation.' . $this->Reservation->primaryKey => $id));
		$this->set('reservation', $this->Reservation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                        
                        $dateNow = date('Y-m-d');
                        $bookID = $this->request->data('bookID');
                        //À insérer la validation ici
                        $options['joins'] = array(
                          array(
                              'table' => 'books_users',
                              'type' => 'inner',
                              'conditions' => array(
                                  'Reservation.books_users_id = books_users.id',
                                  'books_users.book_id = '.$bookID,
                                  'Reservation.dateReturned IS NULL'
                              )
                          )  
                        );
                        $numberOfReservations = $this->Reservation->find('count', $options);
                        if($numberOfReservations > 0)
                        {
                            $this->Session->setFlash(__('The book is already reserved!'), 'flash/error');
                            $this->redirect(array('controller' => 'Books', 'action' => 'index'));
                        }
                        else
                        {
                                //On prepare les variables dont on a besoin:
                            //1. User id est dans auth,
                            //2. book id est passé par post
                            //3. id Pour reservation va être crée
                            //4. dateTaken est la date d'aujourd'hui
                            //5. dateDue est la date d'aujourd'hui + 2 semaines
                            //6. dateReturned: il n'y a pas tout de suite
                            $userID = $this->Auth->user('id');

                            $dateTaken = $dateNow;
                            $dateDue = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));


                            $this->Reservation->create();
                            //On se prepare a sauvegarder une reservation
                            //Maintenant, il faut setter bookcontroller
                            $this->Reservation->BooksUsers->create();
                            $this->request->data['BooksUsers']['user_id'] = $userID;
                            $this->request->data['BooksUsers']['book_id'] = $bookID;
                            $this->Reservation->BooksUsers->save($this->request->data);
                            $booksUsersID = $this->Reservation->BooksUsers->getLastInsertId();
                            $this->request->data['Reservation']['dateTaken'] = $dateTaken;
                            $this->request->data['Reservation']['dateDue'] = $dateDue;
                            $this->request->data['Reservation']['books_users_id'] = $booksUsersID;

                            //Si sauvegarde OK
                            if ($this->Reservation->save($this->request->data))
                            {
                                $this->Session->setFlash(__('The reservation has been saved.'), 'flash/success');
                                $this->redirect(array('controller' => 'Books', 'action' => 'index'));
                            }
                            else
                            {
                                $this->Session->setFlash(__('The reservation could not be saved. Please, try again.'), 'flash/error');
                            }
                        }
                        
                        /*
                    
                        
                        */
		}
                //Si pas post, on fait redirect pcq on ne veut pas un rajout manuel.
                else
                {
                    $this->Session->setFlash(__('No book selected for reservation!'), 'flash/error');
                    $this->redirect(array('controller' => 'Books', 'action' => 'index'));
                }
//		$booksUsers = $this->Reservation->BooksUser->find('list');
//		$this->set(compact('booksUsers'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($idRes = null, $idBU = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}           
                                
                $this->loadModel('BooksUser');
                $this->BooksUser->find('all');
		$this->Reservation->id = $idRes;
                $this->BooksUser->id = $idBU;
		if (!$this->Reservation->exists() || !$this->BooksUser->exists()) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		if ($this->Reservation->delete() && $this->BooksUser->delete()) {
			$this->Session->setFlash(__('Reservation deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Reservation was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
        
        //Seulement les utilisateurs peuvent voir LEUR reservations (dans controlelr et view)
        //Les admins peuvent voir TOUTES les reservations
        public function isAuthorized($user) {
            if(isset($user['role'])&& $user['role'] === 'User')
            {
                if($this->action === 'add' || $this->action === 'index')
                {
                    return true;
                }
                    
            }
            else
            {
                if(isset($user['role'])&& $user['role'] === 'Admin' && ($this->action === 'index' || $this->action === 'delete'))
                {
                    return true;
                }
            }
            //Default: false
            return false;
            }
            
            public function beforeFilter() {
                $this->Auth->deny('all');
            }
}
