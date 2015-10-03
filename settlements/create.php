<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
	require_once '/home4/cassio/public_html/aesop/src/generator/settlement.php';
	createSettelment();
	$table = "settlement";
	header("Location: /aesop/settlements/show.php?id=".insertAndReturnId($table));
?>