<?php
App::uses('Cover', 'Model');

/**
 * Cover Test Case
 */
class CoverTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cover',
		'app.book',
		'app.author',
		'app.category',
		'app.user',
		'app.books_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cover = ClassRegistry::init('Cover');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cover);

		parent::tearDown();
	}

}
