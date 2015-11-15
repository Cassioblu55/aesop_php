<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';
	$table = "character";
	if(!empty($_GET['column'])){
		$column = $_GET['column'];
		if($column=="name"){
			$columns = ["first_name","last_name"];
			print json_encode(getSpecificData($table, $columns));
		}
		else if($column=="stats"){
			$columns = ["first_name","last_name","age","sex","height","weight"];
			print json_encode(getSpecificData($table, $columns));
		}
		else if($column == "grid"){
			$villians = getSingleColumnData("villain", 'character_id');
			$bartenders = getSingleColumnData("tavern", "owner_id");
			$mayors = getSingleColumnData("settlement", "ruler_id");
			$restrict = arrayToString(array_merge($villians, $bartenders, $mayors));
			$columns = ["id, first_name","last_name","age","sex","height","weight"];
			$query ="SELECT ".arrayToString($columns)." FROM ".getTableQuote($table)." WHERE id NOT IN (".$restrict.");";
			echo json_encode(runQuery($query));
		}
		else{
			$columns = getColumnNames($table);
			print json_encode(getSpecificData($table, $columns));
		}
	}
	else if(!empty($_GET['id'])){
		$id = $_GET['id'];
		echo json_encode(findById($table, $id));
	}
	
	
?>