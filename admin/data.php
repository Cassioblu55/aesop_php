<?php
include_once '../config/config.php';
include_once $serverPath.'utils/security/requireAdmin.php';

include_once $serverPath.'utils/db/db_get.php';

if(!empty($_GET['get'])){
	$get = $_GET['get'];
	if($get == "users"){
		$table = "users";
		$columns = ['username', 'email','admin','protected','assestDefaultAccess'];
		$data = getSpecificData($table, $columns);
		$returnData = [];
		foreach($data as $row){
			if($row['protected'] == 0){array_push($returnData, $row);}
		}
		echo json_encode($returnData);
	}
	
	
}

?>
