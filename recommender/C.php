<?php

//turn error reporting on
error_reporting(E_ALL);

require_once("facebook/src/facebook.php");

$config = array();
$config['appId'] = '595138727212812';
$config['secret'] = '063cd433548eee910038edad6706c8e6';
$config['fileUpload'] = false; // optional

$redirect_uri = 'http://localhost:1234/recommender/B.php';

$facebook = new Facebook($config);

//session_start(); - not needed, facebook does this for us.
if (!isset($_SESSION['fb_access_token'])) {
	// No access token.
	die("TODO: I should write some code here to redirect to A.php");
}

$facebook->setAccessToken($_SESSION['fb_access_token']);
  
  ?>
  
  

	<HTML>
	<BODY>
	You are logged in.
	<br/>
	<br/>

	This is what your Facebook profile looks like as a bunch of arrays:<br/>
	<?php
	$ret = $facebook->api('/me', 'GET', null);
	var_dump($ret);
	
	?>
	
<br/>
<br/>
	This is what your session looks like:
<?php	
	var_dump($_SESSION);
?>
}