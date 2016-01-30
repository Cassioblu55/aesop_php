<?php
include_once $serverPath.'login/requireLogin.php';

if($_SESSION['user']['admin'] == 0){
	header("Location: ". $baseURL."login/");
	
	die("Redirecting to login");
}

?>