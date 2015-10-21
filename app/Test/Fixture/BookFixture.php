<?php
/**
 * Book Fixture
 */
class BookFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'isbn' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 13, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'datePublication' => array('type' => 'date', 'null' => false, 'default' => null),
		'author_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'cover_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'isbn_UNIQUE' => array('column' => 'isbn', 'unique' => 1),
			'fk_book_author1_idx' => array('column' => 'author_id', 'unique' => 0),
			'fk_book_cover1_idx' => array('column' => 'cover_id', 'unique' => 0)
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
			'isbn' => 'Lorem ipsum',
			'title' => 'Lorem ipsum dolor sit amet',
			'datePublication' => '2015-09-18',
			'author_id' => 1,
			'cover_id' => 1
		),
	);

}
