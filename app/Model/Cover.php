<?php
App::uses('AppModel', 'Model');
/**
 * Cover Model
 *
 * @property Book $Book
 */
class Cover extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'type';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'type' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'A cover cannot be blank.',
				'allowEmpty' => false,
				'required' => true
			),
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Only alphanumeric characters allowed',
				'allowEmpty' => false,
                                'required' => true
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Book' => array(
			'className' => 'Book',
			'foreignKey' => 'cover_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
