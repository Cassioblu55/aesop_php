<?php 
include_once $serverPath.'utils/connect.php';
//Will run query and return results as array
function getAllData($table){
	$query = "SELECT * FROM ".getTableQuote($table).";";
	return runQuery($query);
}

function findById($table, $id){
	$query = "SELECT * FROM ".getTableQuote($table)." WHERE id=".$id;
	return runQuery($query)[0];
}

function getSpecificData($table, $columns){
	$columnsString = "id, ".arrayToString($columns)."";
	$query = "SELECT ".$columnsString." FROM ".getTableQuote($table).";";
	return runQuery($query);
}

?>