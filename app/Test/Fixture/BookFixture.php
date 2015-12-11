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
		'filename' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => '2',
			'isbn' => '12314567890',
			'title' => 'Something',
			'datePublication' => '2015-02-14',
			'filename' => null,
			'author_id' => '1',
			'cover_id' => '3'
		),
		array(
			'id' => '3',
			'isbn' => '1111111111112',
			'title' => 'The Two Towers',
			'datePublication' => '2015-09-30',
			'filename' => null,
			'author_id' => '1',
			'cover_id' => '4'
		),
		array(
			'id' => '4',
			'isbn' => '1111111111113',
			'title' => 'Game of Thrones I',
			'datePublication' => '2015-09-30',
			'filename' => null,
			'author_id' => '3',
			'cover_id' => '1'
		),
		array(
			'id' => '7',
			'isbn' => '0261102354',
			'title' => 'The Fellowship of the Ring',
			'datePublication' => '2007-04-17',
			'filename' => 'uploads/fellowship.jpg',
			'author_id' => '1',
			'cover_id' => '1'
		),
		array(
			'id' => '8',
			'isbn' => '0261102737',
			'title' => 'The Silmarillion',
			'datePublication' => '2007-08-01',
			'filename' => 'uploads/silmar.jpg',
			'author_id' => '1',
			'cover_id' => '1'
		),
		array(
			'id' => '9',
			'isbn' => '0007309368',
			'title' => 'Children of Hurin',
			'datePublication' => '2010-11-15',
			'filename' => 'uploads/childrenofhurin.jpg',
			'author_id' => '1',
			'cover_id' => '2'
		),
		array(
			'id' => '10',
			'isbn' => '0618126996',
			'title' => 'Atlas of Middle-Earth',
			'datePublication' => '2000-10-04',
			'filename' => 'uploads/atlas.jpg',
			'author_id' => '1',
			'cover_id' => '1'
		),
		array(
			'id' => '12',
			'isbn' => '3333333333330',
			'title' => 'Testing autocomplete',
			'datePublication' => '2015-11-04',
			'filename' => 'uploads/imagedragon.jpg',
			'author_id' => '5',
			'cover_id' => '1'
		),
		array(
			'id' => '13',
			'isbn' => '8888888888888',
			'title' => 'Testing new cover',
			'datePublication' => '2015-11-06',
			'filename' => 'uploads/martian.jpg',
			'author_id' => '5',
			'cover_id' => '4'
		),
	);

}
