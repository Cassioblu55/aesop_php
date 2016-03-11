<?php
	
	include_once $serverPath.'utils/db/db_get.php';	

	if(isset($table)){
		if(isset($_GET['id'])){
		$canSee = false;
		$data = findById($table, $_GET['id']);
		
		if($data['public'] == '1' || isset($_SESSION['user']) && ($data['owner_id'] ==  $_SESSION['user']['id'] || $_SESSION['user']['admin'] == '1')){
			$canSee = true;
		}
			
		if($canSee == false){
			header("Location: ".$baseURL."index.php?error=You do not have access to that.");
			die("redirecting to login");
		}
			
		}
		
	}else{
		echo "Cannot guarantee security table name is undefined.";
	}
?>