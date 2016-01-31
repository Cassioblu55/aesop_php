<?php
include_once '../../config/config.php';
include_once $serverPath.'utils/db/db_get.php';

$table = 'spell';
if(!empty($_GET['get'])){
	$get = $_GET['get'];
	if($get == 'grid'){
		$columns = ['name', 'class'];
		echo json_encode(getSpecificData($table, $columns));
	}
}

if(!empty($_GET['id'])){
	echo json_encode(findById($table, $_GET['id']));
}

?>