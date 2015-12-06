<?php


//echo 'microtime is = ' . microtime(true);
//echo '<br/>';
//echo 'time is = ' . time();


$mysqli = new mysqli("localhost", "root", "", "foaf");

	$start = microtime(true);
	$select = $mysqli->prepare("SELECT * FROM friends WHERE name LIKE '%con%'");	
	echo microtime(true) - $start;

//echo 'Running query..<br/>';

for ($i = 0; $i < 10; $i++) {

	
	//echo '<br/>';
	
	$start = microtime(true);
	$results = $select->execute();
	echo '"This text in the first column",';
	echo (microtime(true) - $start) . "\n";

	
}

// echo '<br/>';

// echo 'The query took: ' . $duration;

?>