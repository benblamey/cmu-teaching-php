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
}
  
if (isset($_GET['code'])) {

  $url = 'https://graph.facebook.com/oauth/access_token?'
   . 'client_id='.$config['appId']
   .'&redirect_uri='.urlencode($redirect_uri)
   .'&client_secret='.$config['secret']
   .'&code='.$_GET['code'];
 
  
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$output = curl_exec($ch);      
	curl_close($ch);
	
	$response = array();
	// Snippet from http://www.php.net/manual/en/function.urldecode.php
	foreach (explode('&', $output) as $chunk) {
		$param = explode("=", $chunk);

		if ($param) {
			$response[$param[0]] = $param[1];
		}
	}
	
	$_SESSION['fb_access_token'] = $response['access_token'];
	echo "Cracking - I've saved my access token in the session!";
	
	$facebook->setAccessToken($_SESSION['fb_access_token']);
	var_dump($response);
	
	echo "TODO - redirect to C.php...";
	
  } else {
	die("I'm confused.");
  }
  
  
 ?>