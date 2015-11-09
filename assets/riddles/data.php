<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
	$table = "character";
	if(empty($_GET['column'])){
		print json_encode(getAllData($table));
	}
	else{
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
	
?>