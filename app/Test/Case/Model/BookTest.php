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
        
        //------------ Test pour 3 choses qui ne sont pas correctes
        public function testMauvaisISBN()
        {
            //On construit data (pour sauvegarder)
            $data = array('Book' => array(
                'isbn' => '@@@',
                'title' => 'testing232',
                'datePublication' => '2015-02-15',
                'author_id' => '3',
                'cover_id' => '2',              

            ));
             
            //On essaye de sauvegarder
            $result = $this->Book->save($data);
            
            $this->assertFalse($result);
        }
        
        public function testMauvaiseDate()
        {
            $data = array('Book' => array(
                'isbn' => '8888888888112',
                'title' => 'testing232',
                'datePublication' => '2015-02-99',
                'author_id' => '3',
                'cover_id' => '2',              

            ));
             
            //On essaye de sauvegarder
            $result = $this->Book->save($data);
            
            $this->assertFalse($result);
        }
        
        public function testMauvaisTitre()
        {
            $data = array('Book' => array(
                'isbn' => '8888888888112',
                'title' => '',
                'datePublication' => '2015-02-15',
                'author_id' => '3',
                'cover_id' => '2',              

            ));
             
            //On essaye de sauvegarder
            $result = $this->Book->save($data);
            
            $this->assertFalse($result);
        }
        

        
        //---- Tests de validation pour les images
        
        //On va donner un livre qui est correcte  (image vide)
        public function testSaveBookValidEmptyImage()
        {
            //On construit data (pour sauvegarder)
            $data = array('Book' => array(
                'isbn' => '8888888888112',
                'title' => 'testing232',
                'datePublication' => '2015-02-15',
                'author_id' => '3',
                'cover_id' => '2',
                'filename' => array(
                   'name' => '',
                   'type' => '',
                   'tmp_name' => '',
                    'error' => 4,
                   'size' => 0
                   
                   )                

            ));
            //On essaye de sauvegarder
            $result = $this->Book->save($data);
            
            //On vérifie que cela s'est bien passé
            //Avec ma version de php, il faut cast
            $result = (array)$result;        
            //Tester si insertion OK
            print_r($result);
            $this->assertArrayHasKey('Book', $result);
            
            //Tester si dans BD
            $result = $this->Book->find('count', 
                    array('conditions' =>array(
                        'Book.isbn' => '8888888888112')
                        ));
            $this->assertEqual($result,1);
        }
        
        //On va donner un livre qui est correcte (pas d'image)
        public function testSaveBookValidNoImage()
        {
            //On construit data (pour sauvegarder)
            $data = array('Book' => array(
                'isbn' => '8888888888112',
                'title' => 'testing232',
                'datePublication' => '2015-02-15',
                'author_id' => '3',
                'cover_id' => '2',              

            ));
            
            
            
            //On essaye de sauvegarder
            $result = $this->Book->save($data);
            
            //On vérifie que cela s'est bien passé
            //Avec ma version de php, il faut cast
            $result = (array)$result;        
            //Tester si insertion OK
            print_r($result);
            $this->assertArrayHasKey('Book', $result);
            
            //Tester si dans BD
            $result = $this->Book->find('count', 
                    array('conditions' =>array(
                        'Book.isbn' => '8888888888112')
                        ));
            $this->assertEqual($result,1);
        }

        //On test avec un fichier valide
	public function testFormWithValidFile() {
		//Stub pour book
		$stub = $this->getMockForModel('Book', array('is_uploaded_file','move_uploaded_file'));
                
                //Toujours retourner TRUE pour is_uploaded_file
		$stub->expects($this->once())
			->method('is_uploaded_file')
			->will($this->returnValue(TRUE));
                //Copier le fichier à place de move_uploaded_file pour tester
		$stub->expects($this->once())
			->method('move_uploaded_file')
			->will($this->returnCallback('copy'));
                
                //On construit data (pour sauvegarder)
                $data = array('Book' => array(
                    'isbn' => '8888888888112',
                    'title' => 'testing232',
                    'datePublication' => '2015-02-15',
                    'author_id' => '3',
                    'cover_id' => '2',  
                    'filename' => array(
                       'name' => 'TestFile.jpg',
                       'type' => 'image/jpg',
                        'tmp_name' => ROOT.DS.APP_DIR.DS.'Test'.DS.''. 'Case'.DS.'Model'.DS.'TestFile.jpg',
                        //'tmp_name' => 'C:/wamp/tmp/TestFile.jpg' ICI AUSSI
                        'error' => (int) 0,
                       'size' => (int) 845941,
                       )                                   
                ));

		
		// Attempt to save
		$result = $stub->save($data);
                
                $result = (array)$result;

		// Test successful insert
		$this->assertArrayHasKey('Book', $result);

                //Tester si dans BD
                $result = $this->Book->find('count', 
                        array('conditions' =>array(
                            'Book.isbn' => '8888888888112')
                            ));
                $this->assertEqual($result,1);

		// Test uploaded file exists
                $this->assertFileExists(WWW_ROOT.'img'.DS.'uploads'.DS.'TestFile.jpg');
	}
        
        //On test avec un fichier valide
	public function testFormWithInValidFile() {
		//Stub pour book
		$stub = $this->getMockForModel('Book', array('is_uploaded_file','move_uploaded_file'));
                
                
                //On construit data (pour sauvegarder)
                $data = array('Book' => array(
                    'isbn' => '8888888888112',
                    'title' => 'testing232',
                    'datePublication' => '2015-02-15',
                    'author_id' => '3',
                    'cover_id' => '2',  
                    'filename' => array(
                       'name' => 'TestFile.txt',
                       'type' => 'text/plain',
                        'tmp_name' => ROOT.DS.APP_DIR.DS.'Test'.DS.''. 'Case'.DS.'Model'.DS.'TestFile.txt',
                        'error' => (int) 0,
                       'size' => (int) 19,
                       )                                   
                ));

		
		// On essaie de sauvegarder
		$result = $stub->save($data);

		// On test que false
		$this->assertFalse($result);


		// On vérifie que le fichier n'éxiste pas
		$this->assertFileNotExists(WWW_ROOT.'img'.DS.'uploads'.DS.'TestFile.txt');
	}


}
