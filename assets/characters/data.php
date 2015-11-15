<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';
	$table = "character";
	if(!empty($_GET['column'])){
		$column = $_GET['column'];
		if($column=="name"){
			$columns = ["first_name","last_name"];
		}
		else if($column=="stats"){
			$columns = ["first_name","last_name","age","sex","height","weight"];
		}
		else{
			$columns = getColumnNames($table);
		}
		print json_encode(getSpecificData($table, $columns));
		
	}
	else if(!empty($_GET['id'])){
		$id = $_GET['id'];
		echo json_encode(findById($table, $id));
	}
	
	
?>