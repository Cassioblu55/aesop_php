<?php
// connects to database
function connect() {
	$dbUser = "cassio_aesop";
	$dbPassword = "qODS)0Umg=$~";
	$dbName = "cassio_aesop";
	$dbHost = "ns8043.hostgator.com";
	$adminEmail = "cassioblubyrd@gmail.com";
	$baseURL = "http://cassiohudson.com/aesop/";
	return connectSpecific ( $dbHost, $dbUser, $dbPassword, $dbName);
}

function connectSpecific($dbHost, $dbUser, $dbPassword, $dbName) {
	try {
		$db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
	} catch ( Exception $e ) {
		die('Connection failed: ' . $e->getMessage ());
	}
	return $db;
}

function findById($table, $id){
	$query = "SELECT * FROM `".$table."` WHERE id=".$id;
	return runQuery($query)[0];
}

//will return all column data for a given table
function getColumns($table){
	$query = "SHOW COLUMNS FROM `".$table."`";
	return runQuery($query);
}

//Will return list of column names for given table, without id
function getColumnNames($table){
	$result = getColumns($table);
	$columns = [];
	foreach ($result as $row){
		if($row['Field'] != 'id'){
			array_push($columns,$row['Field']);
		}
	}
	return $columns;
}

function getRequiredColumns($table){
	$result = getColumns($table);
	$columns = [];
	foreach ($result as $row){
		if($row['Field'] != 'id' && $row['Null']=='NO'){
			array_push($columns,$row['Field']);
		}
	}
	return $columns;
}

//Will take a table name and will add an error whenever a required column is not present
function validateRequired($table){
	if (! empty ( $_POST )) {
		$errors = [];
		$required = getRequiredColumns($table);
		foreach ($required as $column){
			if (empty ( $_POST [$column] )) {
				 array_push($errors, "Please enter ".$column);
			}
		}
		if(count($errors) >0){
			foreach ($errors as $error){
				echo $error;
			}
			die("Missing required columns");
		}
		
	}
}

function insert($table){
	if(! empty($_POST)){
		$columns = columnsToString($table);
		$values = valuesToString($table);
		$insert = "INSERT INTO `".$table."` ".$columns." VALUES ".$values.";";
		runInsert($insert);
	}
}

function update($table){
	if(!empty($_POST)){
		$update = "UPDATE `".$table."` SET ";
		$columns = getColumnNames($table);
		foreach ($columns as $column){
			$value = $_POST[$column];
			if(gettype($value)=="string"){
				$value = "'".$value."'";
			}
			$update.= $column."=".$value.", ";
		}
		$update = substr($update, 0,strlen($update)-2)." WHERE id=".$_GET['id'].";";
		runInsert($update);
	}
}

function valuesToString($table){
	if(!empty($_POST)){
		$columns = getColumnNames($table);
		$string = "(";
		foreach ($columns as $column){
			$value = $_POST[$column];
			if(gettype($value)=="string"){
				$value = "'".$value."'";
			}
			$string .= $value.", ";
		}
		return substr($string, 0,strlen($string)-2).")";
	}
}

//Will return list of columns as string with ()
function columnsToString($table){
	$columns = getColumnNames($table);
	$string = "(";
	foreach ($columns as $column){
		$string.=$column.", ";
	}
	return substr($string, 0,strlen($string)-2).")";
}

function runInsert($insert){
	//echo $insert;
	$db = connect();
	try {
		$db->query ( $insert );
		$db->close();
	} catch ( Execption $e ) {
		echo "Could not complete request: ".$insert;
		echo $e;
		$db->close();
		die ( "Could not complete request: ".$insert);
	}
}

function deletFrom($table, $id){
	$insert = "DELETE FROM `".$table."` WHERE id=".$id.";";
	runInsert($insert);
}

function getAllData($table){
	$query = "SELECT * FROM `".$table."`;";
	return runQuery($query);
}

//Will run query and return results as array
function runQuery($query){
	$db = connect();
	$results = [];
	$result = $db->query ( $query );
	if (!$result) {
		echo 'Could not run query: ' .$query;
		exit;
	}
	while ( $row = $result->fetch_assoc () ) {
		array_push($results,$row);
	}
	$db->close();
	return $results;
}


?>