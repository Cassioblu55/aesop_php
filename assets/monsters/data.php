<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';

$table = "monster"; 
if(!empty($_GET["id"])){
	print json_encode(findById($table, $_GET['id']));
}
elseif (!empty($_GET['get'])){
	$get = $_GET['get'];
	if($get=="grid"){
		$columns = ['name'];
		print json_encode(getSpecificData($table, $columns));
	}
}

?>