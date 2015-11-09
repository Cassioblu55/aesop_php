<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/connect.php';

if (! empty ( $_GET['id'] )){
	$table  = "character";	
	deletFrom($table, $_GET['id']);
}
?>