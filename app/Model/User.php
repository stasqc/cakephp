<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Book $Book
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'User needs a valid username.',
				'allowEmpty' => false,
				'required' => true
			),
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Username must be alphanumeric only.',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Enter a valid e-mail adress.',
				'allowEmpty' => false,
				'required' => true
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'E-mail field must not be blank.',
				'allowEmpty' => false,
				'required' => true
			),
                        'unique' => array(
                            'rule' => 'isUnique',
                            'required' => 'create',
                            'message' => 'E-mail is already in use by another user!'
                        )
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Name must not be blank',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'phoneNumber' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter a phone nu,ber.',
				'allowEmpty' => false,
				'required' => true
			),
			'phone' => array(
				'rule' => array('phone'),
				'message' => 'Please enter a valid phone number',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Password field must not be blank.',
				'allowEmpty' => false,
				'required' => true
			),
			'userDefined' => array(
				'rule' => '/^[a-z0-9]{5,}$/i',
				'message' => 'Only letters and integers, minimum of 5 characters',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'role' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Enter a valid role.',
				'allowEmpty' => false,
				'required' => true
			),
                        'valid' => array(
                                'rule' => array('inList', array('Admin', 'User')),
                                'message' => 'Plese enter a valid role',
                                'allowEmpty' => false
                        )
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
        
       //Ce qui arrive avant de faire Save nos donnees
        public function beforeSave($options = array()) {
            if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
    return true;
}
/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book' => array(
			'className' => 'Book',
			'joinTable' => 'books_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'book_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
        //Vérifie si notre utilisateur a confirmé son compte par e-mail
        public function checkIfUserConfirmed($userID = null)
        {
            $outcome = false;
            if($userID != null)
            {
                $theUser = $this->find('first', array('conditions' => array('User.id' => $userID)));
                if($theUser['User']['authorized'] == 1)
                    $outcome = true;
            }
            return $outcome;
        }
        
        //Envoi e-mail de confirmation à l'utilisateur
        public function envoyerEmail($username, $password, $emailAd, $userid)
        {
            //On prepare link
            $link = array('controller' => 'users', 'action' => 'activate', $userid.'-'.md5($password));
            App::uses('CakeEmail', 'Network/Email');
            $email = new CakeEmail('gmail');
            $email->from('gererstages@gmail.com');
            $email->to($emailAd);
            $email->subject('Activation of account');
            $email->emailFormat('html');
            $email->template('default');
            $email->viewVars(array('username'=> $username, 'link' => $link));
            $email->send();
        }
        
        //Réception de la confirmation et activation de l'usager
        public function activateMethod($token)
        {
            $outcome = false;
            $token = explode('-', $token);
            $user = $this->find('first', array('conditions' => array('id' => $token[0], 'MD5(User.password)' => $token[1], 'authorized' => 0)));
            //Si on l'a trouvé
            if(!empty($user))
            {
                //Charger avec le résultat qu'on avait obtenu auparavant
                $this->id = $user['User']['id'];
                $this->saveField('authorized', 1);
                $outcome = true;
            }
           //Si non, false
            
            return $outcome;
        }


}
