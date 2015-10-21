<?php
App::uses('AppModel', 'Model');
/**
 * BooksCategory Model
 *
 * @property Books $Books
 * @property Categories $Categories
 */
class BooksCategory extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Books' => array(
			'className' => 'Books',
			'foreignKey' => 'books_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Categories' => array(
			'className' => 'Categories',
			'foreignKey' => 'categories_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
