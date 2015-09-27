<?php 
	require_once '../../src/utils/connect.php';
	$db = connect ();
	$query = "SELECT * FROM character_traits;";
	$result = $db->query ( $query );

	while ( $row = $result->fetch_assoc () ) {
		$trait [] = $row;
	}

	$struct = array (
			"traits" => $trait
	);
	print json_encode ( $struct );
?>