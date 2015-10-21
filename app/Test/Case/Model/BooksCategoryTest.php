<?php
App::uses('BooksCategory', 'Model');

/**
 * BooksCategory Test Case
 */
class BooksCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.books_category',
		'app.books',
		'app.categories'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BooksCategory = ClassRegistry::init('BooksCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BooksCategory);

		parent::tearDown();
	}

}
