<?php 
error_reporting(E_ALL); // Show me all the errors.

$host = 'localhost'; // Postgres needs to be running on my local machine (i.e. localhost).
$database = 'webprogramming'; // Modify to match the name of your database.
$user = 'postgres';
$port = 5432; 

$con = pg_connect("host=localhost port=$port dbname=$database user=$user"); 

// This query selects the first walk in the table, you will need to modify this query (once you understand it).
// Note how the value from "path" column needs to be cast to the geometry type so that it can be passed to the ST_DumpPoints function.
$query = 'SELECT ((ST_DumpPoints("path"::geometry)).geom::point), "id", "name" FROM walks WHERE id = 1'; 

$rs = pg_query($con, $query) or die("Cannot execute query: $query\n");
while ($row = pg_fetch_row($rs)) {
  $point_string = $row[0]; // The point is the first item in the row.
  $point_string = trim($row[0],'()'); // Remove the parentheses from the start and end of the string.
  $point = explode(',', $point_string); // Break up on the comma (this makes an array out of the string).
  $point = array( // Then make a new array out of the old one, so that we don't forget that lat and long are reversed in postgres!!
		'lat' => $point[1],
		'long' => $point[0],
	);
   // Print out the results to check its working. Note that we use the HTML codes for speech marks.
   echo "Point on path $row[1] - &quot;$row[2]&quot; - lat=" . $point['long'] . " long=" . $point['lat'] . "<br/>";
}

// Remember to close the connection, so that we don't waste system resources!
pg_close($con); 
?>
