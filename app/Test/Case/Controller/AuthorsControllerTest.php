<?php
App::uses('AuthorsController', 'Controller');

/**
 * AuthorsController Test Case
 */
class AuthorsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.author',
		'app.book',
		'app.category',
		'app.cover',
		'app.user',
		'app.books_user'
	);

}
