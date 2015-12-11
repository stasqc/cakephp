<?php
/**
 * Author Fixture
 */
class AuthorFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'name' => 'JRR Tolkien'
		),
		array(
			'id' => '3',
			'name' => 'George RR Martin'
		),
		array(
			'id' => '4',
			'name' => 'J. K. Rowling'
		),
		array(
			'id' => '5',
			'name' => 'Suzanne Collins'
		),
		array(
			'id' => '6',
			'name' => 'Ernest Hemingway'
		),
		array(
			'id' => '7',
			'name' => 'Stephen King'
		),
	);

}
