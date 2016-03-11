<?php
include_once $serverPath.'utils/db/db_get.php';
if($table){
	if(!empty($_GET['get'])){
		$get = $_GET['get'];
		if($get == "public"){
			$constraints = ['public' => 1, 'approved' => 1];
			$results = getConstraintsWithTable($table, $constraints);
		}else if($get =="mine"){
			include_once $serverPath.'utils/security/requireLogin.php';
			$constraints = ['owner_id' => $_SESSION['user']['id']];
			$results = getConstraintsWithTable($table, $constraints);		
		}	
	}	
}else{
	sendErrorMessage("No table set. Data cannot be retreived.");
}


?>