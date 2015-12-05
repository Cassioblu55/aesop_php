<?php 
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_get.php';
$table = "dungeon";
$traps_table = "traps";
	if(!empty($_GET['id'])){
		echo json_encode(findById($table, $_GET['id']));	
	}
	else{
		if(!empty($_GET['column'])){
			$column = $_GET['column'];
			if($column =="index"){
				$columns = ['name','purpose','location', 'creator'];
				print json_encode(getSpecificData($table, $columns));
			}
			else if($column == "traps"){
				print json_encode(getAllData($traps_table));
			}
		}
	}

?>