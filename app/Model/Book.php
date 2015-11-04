<?php
App::uses('AppModel', 'Model');
/**
 * Book Model
 *
 * @property Author $Author
 * @property Cover $Cover
 * @property Category $Category
 * @property User $User
 */
class Book extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
        public $uploadDir = "uploads";
        
        //Trouver les noms des auteurs pour auto complete
        public function getAuthorNames ($term = null) {
            if(!empty($term)) {
              $authors = $this->Author->find('list', array(
                'conditions' => array(
                  'name LIKE' => trim($term) . '%'
                )
              ));
              return $authors;
            }
            return false;
          }
          
          //Trouver le id d'auteur qui correspond au nom
          public function getAuthorID($name = null)
          {
              if(!empty($name))
              {
                  $authorID = $this->Author->find('first', 
                          array('conditions' => array('name' => $name)));
                  return $authorID['Author']['id'];
              }
              return false;
          }
          
          //L'inverse de la fonction ci-haut pour le edit
          public function getAuthorName($id = null)
          {
              if(!empty($id))
              {
                  $authorName = $this->Author->find('first', array('conditions' => array('id' => $id)));
                  return $authorName['Author']['name'];
              }
              return false;
          }
/**
 * Validation rules
 *
 * @var array
 */
        
	public $validate = array(
		'isbn' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'ISBN must not be blank.',
				'allowEmpty' => false,
				'required' => true
			),
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Only alphanumeric characters allowed.',
				'allowEmpty' => false,
				'required' => true
			),
			'maxLength' => array(
				'rule' => array('maxLength', 13),
				'message' => 'ISBN length is a maximum of 13',
				'allowEmpty' => false,
				'required' => true
			),
                    'unique' => array(
                        'rule' => 'isUnique',
                        'required' => 'create'
                    )
		),
		'title' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Enter a title.',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'datePublication' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Enter a valid publication date.',
				'allowEmpty' => false,
				'required' => true
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'Enter a valid publication date.',
				'allowEmpty' => false,
				'required' => true
			),
		),
            'filename' => array(
			'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Something went wrong with the file upload',
				'allowEmpty' => TRUE,
			),
			'mimeType' => array(
				'rule' => array('mimeType', array('image/jpg','image/jpeg')),
				'message' => 'Invalid file, only jpeg/jpg allowed!',
				'allowEmpty' => TRUE,
			),
                         'filesize' => array(
                            'rule' => array('filesize', '<=', '1MB'),
                            'message' => 'Article image must be less then 1MB',
                            'allowEmpty' => TRUE,
                        ),
			// notre méthode à nous
			'processImageUpload' => array(
				'rule' => 'processImageUpload',
				'message' => 'Something went wrong while processing your file',
				'allowEmpty' => TRUE
			))
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Author' => array(
			'className' => 'Author',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cover' => array(
			'className' => 'Cover',
			'foreignKey' => 'cover_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'books_categories',
			'foreignKey' => 'book_id',
			'associationForeignKey' => 'category_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'User' => array(
			'className' => 'User',
			'joinTable' => 'books_users',
			'foreignKey' => 'book_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
        
    public function processImageUpload($check=array()) {
//    debug($check); die();
	// deal with uploaded file
	if (!empty($check['filename']['tmp_name'])) {

		// check file is uploaded
		if (!is_uploaded_file($check['filename']['tmp_name'])) {

			return FALSE;
		}

		// build full filename
		$filename = WWW_ROOT . 'img' . DS . 'uploads'. DS . $check['filename']['name'];

		// @todo check for duplicate filename

		// try moving file
		if (!move_uploaded_file($check['filename']['tmp_name'], $filename)) {
			return FALSE;

		// file successfully uploaded
		} else {
			// save the file path relative from WWW_ROOT e.g. uploads/example_filename.jpg
			$this->data[$this->alias]['filename'] = 'uploads' . '/' . $check['filename']['name'];
		}
	}

	return TRUE;
}
    
    

}
