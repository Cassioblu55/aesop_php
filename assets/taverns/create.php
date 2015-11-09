<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/connect.php';
require_once $serverPath.'utils/generator/tavern.php';
	createTavern();
	$table = "tavern";
	header("Location: ".$baseURL."assets/taverns/show.php?id=".insertAndReturnId($table));
?>