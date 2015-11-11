<?php
// connects to database
function connect() {
	global $dbHost;
	global $dbUser;
	global $dbPassword;
	global $dbName;
	
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

function cutString($string, $n){return substr ( $string, 0, strlen ( $string ) - $n );}

// function findById($table, $id){
// 	$query = "SELECT * FROM ".getTableQuote($table)." WHERE id=".$id;
// 	return runQuery($query)[0];
// }

// function insertAndReturnId($table){
// 	if(! empty($_POST)){
// 		$columns = columnsToString($table);
// 		$values = valuesToString($table);
// 		$insert = "INSERT INTO ".getTableQuote($table)." ".$columns." VALUES ".$values.";";
// 		$db = runInsertWithDBReturn($insert);
// 		$inserted = $db->insert_id; 
// 		$db->close();
// 		return $inserted;
// 	}
// }

//will take array of string and return comma seperated string of all values
function arrayToString($array){
	$string = "";
	foreach($array as $item){
		$string.=$item.", ";
	}
	return substr($string, 0,strlen($string)-2);
}

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

//will return all column data for a given table
function getColumns($table){
	$query = "SHOW COLUMNS FROM ".getTableQuote($table);
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

// function insert($table){
// 	if(! empty($_POST)){
// 		$columns = columnsToString($table);
// 		$values = valuesToString($table);
// 		$insert = "INSERT INTO ".getTableQuote($table)." ".$columns." VALUES ".$values.";";
// 		runInsert($insert);
// 	}
// }

// function update($table){
// 	if(!empty($_POST)){
// 		$update = "UPDATE ".getTableQuote($table)." SET ";
// 		$columns = getColumnNames($table);
// 		foreach ($columns as $column){
// 			$update.= $column."=".getValueString($_POST[$column]).", ";
// 		}
// 		$update = substr($update, 0,strlen($update)-2)." WHERE id=".$_GET['id'].";";
// 		runInsert($update);
// 	}
// }

//Adds correct quotes to table name for mysql
function getTableQuote($table){return "`".$table."`";}

//Will add quotes to string values and not to integer values
function getValueString($value){
	return (gettype($value)=="string")  ? "'".$value."'" : $value;
}

function valuesToString($table){
	if(!empty($_POST)){
		$columns = getColumnNames($table);
		$string = "(";
		foreach ($columns as $column){
			$string .= getValueString($_POST[$column]).", ";
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

// function runInsertWithDBReturn($insert){
// 	$db = connect();
// 	try {
// 		$db->query ( $insert );
// 		return $db;
// 	} catch ( Execption $e ) {
// 		echo "Could not complete request: ".$insert;
// 		echo $e;
// 		$db->close();
// 		die ( "Could not complete request: ".$insert);
// 	}
// }

// function runInsert($insert){
// 	//echo $insert;
// 	$db = connect();
// 	try {
// 		$db->query ( $insert );
// 		$db->close();
// 	} catch ( Execption $e ) {
// 		echo "Could not complete request: ".$insert;
// 		echo $e;
// 		$db->close();
// 		die ( "Could not complete request: ".$insert);
// 	}
// }

// function deletFrom($table, $id){
// 	$insert = "DELETE FROM ".getTableQuote($table)." WHERE id=".$id.";";
// 	runInsert($insert);
// }

// function getAllData($table){
// 	$query = "SELECT * FROM ".getTableQuote($table).";";
// 	return runQuery($query);
// }

//Will run query and return results as array
// function runQuery($query){
// 	$db = connect();
// 	$results = [];
// 	$result = $db->query ( $query );
// 	if (!$result) {
// 		echo 'Could not run query: ' .$query;
// 		exit;
// 	}
// 	while ( $row = $result->fetch_assoc () ) {
// 		array_push($results,$row);
// 	}
// 	$db->close();
// 	return $results;
// }


?>