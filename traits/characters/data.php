<?php 
	require_once '../../src/utils/connect.php';
	$query = "SELECT * FROM character_traits;";
	$result = runQuery($query);
	print json_encode ( $result );
?>