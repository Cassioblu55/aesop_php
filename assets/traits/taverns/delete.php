<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/connect.php';

if (! empty ( $_GET ['id'] )) {
	
	$db = connect ();
	
	$delete = "DELETE FROM tavern_traits WHERE id=" . $_GET ['id'] . ";";
	echo $delete;
	
	try {
		$db->query ( $delete );
	} catch ( Execption $e ) {
		echo $e;
		die ( "Count not delete trait." );
	}
}
?>