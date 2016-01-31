<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';
require_once $serverPath . 'utils/generator/utils.php';
function createNpc() {
	$trait_table = "npc_traits";
	$table = "npc";
	
	$columns = getColumnNames ($table );
	
	if (empty ( $_POST ["sex"] )) {
		$_POST ["sex"] = getGender ();
	}
	
	if (empty ( $_POST ["weight"] )) {
		$_POST ["weight"] = getWeight ();
	}
	
	if (empty ( $_POST ["feet"] ) || empty ( $_POST ["inches"] )) {
		$_POST ["height"] = getHeight ();
	} else {
		$_POST ["height"] = ($_POST ["feet"] * 12) + $_POST ["inches"];
	}
	
	if (empty ( $_POST ["age"] )) {
		$_POST ["age"] = getAge ();
	}
	
	if (empty ( $_POST ["first_name"] )) {
		$_POST ["first_name"] = getName ();
	}
	
	// will add the remaining traits not already added
	foreach ( $columns as $column ) {
		if (empty ( $_POST [$column] )) {
			$_POST [$column] = getTrait ( $trait_table, $column );
		}
	}
}
function getName() {
	$trait_table = "npc_traits";
	if ($_POST ['sex'] == 'F') {
		return getTrait ( $trait_table, "female_name" );
	}
	return getTrait ( $trait_table, "male_name" );
}
function getAge() {
	return purebell ( 16, 50, 5 );
}
function getGender() {
	return (rand ( 0, 1 ) == 0) ? "M" : "F";
}
function getWeight() {
	if ($_POST ["sex"] == 'F') {
		return purebell ( 90, 190, 20 );
	}
	return purebell ( 110, 250, 29 );
}
function getHeight() {
	if ($_POST ["sex"] == 'F') {
		return purebell ( 48, 72, 2.7 );
	}
	return purebell ( 54, 78, 2.9 );
}

?>