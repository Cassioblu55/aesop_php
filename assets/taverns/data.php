<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';
$table = "tavern";

if(!empty($_GET['id'])){
	echo json_encode(findById($table, $_GET['id']));
}

if(!empty($_GET['get'])){
	
	$get = $_GET['get'];
	if($get == 'grid'){
		print json_encode ( getAllData ( $table ) );
	}
	
}


?>