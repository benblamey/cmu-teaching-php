
<?php

function commit2() {
		$solrAddress = 'http://' . SOLR_SERVER_HOSTNAME . ':' . SOLR_SERVER_PORT . '/solr/collection1';
		$response =  file_get_contents($solrAddress . '/update?commit=true');
}

include "bootstrap.php";
$options = array
(
    'hostname' => SOLR_SERVER_HOSTNAME,
    'login'    => SOLR_SERVER_USERNAME,
    'password' => SOLR_SERVER_PASSWORD,
    'port'     => SOLR_SERVER_PORT,
);

$client = new SolrClient($options);

$doc = new SolrInputDocument();

$doc->addField('id', 334456);
$doc->addField('cat', 'Software');
$doc->addField('cat', 'Lucene');

$updateResponse = $client->addDocument($doc);
print_r($updateResponse->getResponse());

// Broken!
//$client->commit();
// Use our own solution instead!
commit2();


?>
