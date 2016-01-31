<?php
include_once $serverPath.'utils/security/requireLogin.php';

if($_SESSION['user']['admin'] == 0){
	header("Location: ". $baseURL."login/");
	
	die("Redirecting to login");
}

?>