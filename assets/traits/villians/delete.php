<?php 
include_once '../../../config/config.php';
include_once $serverPath.'utils/db_post.php';

if (! empty ( $_GET['id'] )){
	
	$db=connect();
	
	$delete = "DELETE FROM villain_trait WHERE id=".$_GET['id'].";";
	echo $delete;
	
	try{
		$db->query($delete);
	}catch(Execption $e){
		echo $e;
		die("Count not delete trait.");
	}
	
}
?>