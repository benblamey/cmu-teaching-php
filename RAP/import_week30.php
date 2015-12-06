<?php
// Only show serious errors.
error_reporting(E_ERROR | E_WARNING | E_PARSE);

set_time_limit(99999);

ini_set('memory_limit',-1);


echo 'Memory Limit is: ' . ini_get('memory_limit') . "\n";

echo "Test 1\n";

//error_reporting(E_ALL);
require_once 'rdfapi-php/test/config.php';
include(RDFAPI_INCLUDE_DIR . "RDFAPI.php");



$database = ModelFactory::getDbStore('MySQL', 'localhost', 'rap', 'root', '');

echo "Connected to DBStore.\n";

//$datatbase->createTables("MySQL");

echo "Tables created.\n";

//$friends = $datatbase->getNewModel("http://foo");
$friends = $database->getModel("http://foo");


// Create a new MemModel and load the document
//$friends = ModelFactory::getDefaultModel();

echo "Have model, Loading data...\n";
$friends->load(
        //'C:/work/services/Teaching/xampp/htdocs/RAP/dbpedia_persondata_en.nt'
        //'C:/work/services/Teaching/xampp/htdocs/RAP/dbpedia_aa.nt'
        'C:/work/services/Teaching/xampp/htdocs/RAP/dbpedia_10000aa.nt'
        );




echo "Loaded.\n";

//$friends->load('C:/work/services/Teaching/xampp/htdocs/foaf/foaf.rdf');
$querystring = '
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
SELECT ?x ?name
WHERE { ?x foaf:name ?name }
';
$result = $friends->sparqlQuery($querystring); 

echo "Executed Query.\n";

error_reporting(E_ALL);

//var_dump($result);

//$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
$mysqli = new mysqli("localhost", "root", "", "foaf");

$insert = $mysqli->prepare("INSERT INTO friends VALUES (?, ?)");

$count = 0;

// for each row in the results...
foreach ($result as $row) {
	// get the node for the "name" variable:
	$name = $row['?name'];
	// Read the literal value of the node (called its 'label')
	$actualName = $name->label;
	// Print out the name.
	
	$resource_uri = $row['?x']->uri;
	
	$count++;
	
	//if (count > 1000) { break; }
	
	//echo $actualName .' has URI ' . $row['?x']->uri . '<br/>';
	// Insert into mysql...
	
	$insert->bind_param('ss', $resource_uri, $actualName);
	
	$insert->execute();
}

echo "There are $count names.";

?>