<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
	require_once '/home4/cassio/public_html/aesop/src/generator/character.php';
	createCharacter();
	$table = "character";
	header("Location: /aesop/characters/show.php?id=".insertAndReturnId($table));
?>