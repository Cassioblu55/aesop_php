<?php 
require_once '../../src/utils/connection.php';
if (! empty ( $_GET['id'] )){
	
	$db=connect();
	
	$delete = "DELETE FROM character_traits WHERE id=".$_GET['id'];
	
	try{
		$db->query($delete);
	}catch(Execption $e){
		echo $e;
		die("Count not delete song.");
	}
	
}
?>