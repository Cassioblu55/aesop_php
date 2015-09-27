<?php 
require_once '../../src/utils/connect.php';
if (! empty ( $_GET['id'] )){
	
	$db=connect();
	
	$delete = "DELETE FROM settelement_traits WHERE id=".$_GET['id'].";";
	echo $delete;
	
	try{
		$db->query($delete);
	}catch(Execption $e){
		echo $e;
		die("Count not delete trait.");
	}
	
}
?>