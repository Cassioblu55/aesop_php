<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
	$table = "settlement";
	if(empty($_GET['column'])){
		print json_encode(getAllData($table));
	}
	else{
		if($_GET['column']=="index"){
			$columns = ['name','population','known_for'];
		}
		else{
			$columns = getColumnNames($table);
		}
		
		print json_encode(getSpecificData($table, $columns));
		
	}
	
?>