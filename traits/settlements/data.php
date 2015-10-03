<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
	$table = "settlement_traits";
	print json_encode (getAllData( $table) );
?>