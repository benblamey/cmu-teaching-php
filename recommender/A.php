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
if (isset($_SESSION['fb_access_token'])) {
	$facebook->setAccessToken($_SESSION['fb_access_token']);
	die("TODO: I should write some code here to redirect to C.php");
} else {
  

	$params = array(
		// These are the permissions I'm requesting from Facebook.
		'scope' => 'read_stream, friends_likes',
		'redirect_uri' => $redirect_uri,
	);

	// Redirect to Facebook for login.
	$loginUrl = $facebook->getLoginUrl($params);
	header("Location: $loginUrl");

}
  

?>