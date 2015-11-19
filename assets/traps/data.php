<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';
	$table = "traps";
	if(!empty($_GET["id"])){		
		print json_encode(findById($table, $_GET['id']));
	}
	else if(!empty($_GET['column'])){
		$column = $_GET['column'];
		if($column == "grid"){
			print json_encode(getAllData($table));
		}
		
	}
?>