<?php

// connect
$m = new MongoClient('localhost:27018'); // Not the default port.

// select a database
$db = $m->comedy;

// select a collection (analogous to a relational database's table)
$collection = $db->cartoons;

// add a record
$document = array( 
	"title" => "Calvin and Hobbes", 
	"author" => "Bill Watterson" );
$collection->insert($document);

//    Now look in localhost:1234/rockmongo   (credentials: admin/admin)

?>