<?php

// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

define("RDFAPI_INCLUDE_DIR", "C:/work/services/Teaching/xampp/htdocs/RAP/rdfapi-php/api/");

include(RDFAPI_INCLUDE_DIR . "RDFAPI.php");


$friends = ModelFactory::getDefaultModel();
$friends->load('C:/work/services/Teaching/xampp/htdocs/foaf/foaf.rdf');
$friends_query = '
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
SELECT ?name
WHERE { ?x foaf:name ?name }';
echo $friends->sparqlQuery($friends_query, 'HTML');

die("done");


// Create a new MemModel and load the document
$employees = ModelFactory::getDefaultModel();
$employees->load('C:/work/services/Teaching/xampp/htdocs/RAP/rdfapi-php/doc/tutorial/employees.rdf');

//continue below 


$querystring = '
PREFIX vcard <http://www.w3.org/2001/vcard-rdf/3.0#>
SELECT ?fullName
WHERE { ?x vcard:FN ?fullName }'; 

$result = $employees->sparqlQuery($querystring); 

foreach($result as $line){
  $value = $line['?fullName'];
    if($value != "")
      echo $value->toString()."<br/>";
    else
      echo "undbound<br/>";
}

echo $employees->sparqlQuery($querystring, 'HTML');

?>