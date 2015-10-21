<?php
/**
 * Reservation Fixture
 */
class ReservationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'dateTaken' => array('type' => 'date', 'null' => false, 'default' => null),
		'dateDue' => array('type' => 'date', 'null' => false, 'default' => null),
		'dateReturned' => array('type' => 'date', 'null' => true, 'default' => null),
		'books_users_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_reservations_books_users1_idx' => array('column' => 'books_users_id', 'unique' => 0)
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
			'id' => 1,
			'dateTaken' => '2015-09-17',
			'dateDue' => '2015-09-17',
			'dateReturned' => '2015-09-17',
			'books_users_id' => 1
		),
	);

}
