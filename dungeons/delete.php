<?php 
require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
if (! empty ( $_GET['id'] )){
	$table  = "dungeon";	
	deletFrom($table, $_GET['id']);
}
?>