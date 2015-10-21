<?php
App::uses('BooksUser', 'Model');

/**
 * BooksUser Test Case
 */
class BooksUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.books_user',
		'app.user',
		'app.book',
		'app.author',
		'app.category',
		'app.cover'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BooksUser = ClassRegistry::init('BooksUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BooksUser);

		parent::tearDown();
	}

}
