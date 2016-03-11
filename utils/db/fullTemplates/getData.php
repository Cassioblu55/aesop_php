<?php
include_once $serverPath.'utils/db/db_get.php';
if($table){
	if(!empty($_GET['get'])){
		$get = $_GET['get'];
		if($get == "public"){
			$constraints = ['public' => 1, 'approved' => 1];
			if(!isset($columns)){
				$columns = null;
			}
			$results = getSpecificDataWithConstraints($table, $columns, $constraints);
			echo json_encode ($results);
		}else if($get =="my"){
			include_once $serverPath.'utils/security/requireLogin.php';
			$constraints = ['owner_id' => $_SESSION['user']['id']];
			$results = getSpecificDataWithConstraints($table, $columns, $constraints);
			echo json_encode ($results);
		}
	}else if(!empty($_GET['id'])){
		include_once $serverPath.'utils/security/canSee.php';
		echo json_encode (findById($table, $_GET['id']));
		
	}
}else{
	sendErrorMessage("No table set. Data cannot be retreived.");
}


?>