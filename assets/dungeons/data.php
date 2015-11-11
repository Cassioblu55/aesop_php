<?php 
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_get.php';
$table = "dungeon";
	
	if(empty($_GET['column'])){
		print json_encode(getAllData($table));
	}
	
	else{
		if($_GET['column']=="index"){
			$columns = ['name','purpose','location', 'creator'];
		}
		else{
			$columns = getColumnNames($table);
		}
		
		print json_encode(getSpecificData($table, $columns));
		
	}

?>