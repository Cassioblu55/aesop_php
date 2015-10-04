<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
	require_once '/home4/cassio/public_html/aesop/src/generator/dungeon.php';
	createDungeon();
	$table = "dungeon";
	header("Location: /aesop/dungeons/show.php?id=".insertAndReturnId($table));
?>