<?php
App::uses('Book', 'Model');

/**
 * Book Test Case
 */
class BookTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.book',
		'app.author',
		'app.cover',
		'app.overcover',
		'app.category',
		'app.books_category',
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
		$this->Book = ClassRegistry::init('Book');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Book);

		parent::tearDown();
	}

        //À faire - isOwnedBy??
        
        //------------ Tests pour les extractions
        
        public function testGetAuthorNamesUneLettreExistante()
        {
            $testAuthorNames = $this->Book->getAuthorNames("G");
            $this->assertEqual($testAuthorNames, array("3" => "George RR Martin"));
        }
        
        public function testGetAuthorNamesUneLettreNonExistante()
        {
            $testAuthorNames = $this->Book->getAuthorNames("Y");
            $this->assertEqual($testAuthorNames, array());
        }
        
        public function testGetAuthorNamesDeuxLettresExistantes()
        {
            $testAuthorNames = $this->Book->getAuthorNames("St");
            $this->assertEqual($testAuthorNames, array("7" => "Stephen King"));
        }
        
        
        public function testGetAuthorParametreVide()
        {
            $testAuthorNames = $this->Book->getAuthorNames("");
            $this->assertEqual($testAuthorNames, null);
        }
        
        //---- Tests pour la validation de 3 entrées de types différents
        
        //On va donner un livre qui est correcte
        public function testSaveBookValid()
        {
            //On construit data (pour sauvegarder)
            $data = array('Book' => array(
                'isbn' => '19111111111',
                'title' => 'testing',
                'datePublication' => '2015-02-15',
                'filename' => 'atlas.jpg',
                'author_id' => '5',
                'cover_id' => '4'
            ));
            
            
            
            //On essaye de sauvegarder
            $result = $this->Book->save($data);
            
            //On vérifie que cela s'est bien passé
            $this->assertTrue($result);
        }
        //
        //on va donner un titre vide
        //
        //
        //On va donner un nom d'auteur vide
        
        


}
