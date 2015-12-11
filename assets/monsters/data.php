<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';

$table = "monster"; 
if(!empty($_GET["id"])){
	
	print json_encode(findById($table, $_GET['id']));
}

?>