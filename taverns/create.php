<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
	require_once '/home4/cassio/public_html/aesop/src/generator/tavern.php';
	createTavern();
	$table = "tavern";
	header("Location: /aesop/taverns/show.php?id=".insertAndReturnId($table));
?>