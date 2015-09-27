<?php 
	require_once '../../src/utils/connect.php';
	$query = "SELECT * FROM villain_trait;";
	$result = runQuery($query);
	print json_encode ( $result );
?>