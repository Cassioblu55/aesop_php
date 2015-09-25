<?php
// connects to database
function connect() {
	$dbUser = "cassio_aesop";
	$dbPassword = "qODS)0Umg=$~";
	$dbName = "cassio_aesop";
	$dbHost = "ns8043.hostgator.com";
	$adminEmail = "cassioblubyrd@gmail.com";
	$baseURL = "http://cassiohudson.com/aesop/";
	return connectSpecific ( $dbHost, $dbUser, $dbPassword, $dbName);
}
function connectSpecific($dbHost, $dbUser, $dbPassword, $dbName) {
	try {
		$db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
	} catch ( Exception $e ) {
		die('Connection failed: ' . $e->getMessage ());
	}
	return $db;
}
?>