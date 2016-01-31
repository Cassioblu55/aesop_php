<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';

$table = "npc";

if (! empty ( $_GET ['column'] )) {
	$column = $_GET ['column'];
	if ($column == "name") {
		$columns = [ 
				"first_name",
				"last_name" 
		];
		print json_encode ( getSpecificData ( $table, $columns ) );
	} else if ($column == "stats") {
		$columns = [ 
				"first_name",
				"last_name",
				"age",
				"sex",
				"height",
				"weight" 
		];
		print json_encode ( getSpecificData ( $table, $columns ) );
	} else if ($column == "grid") {
		$columns = [ 
				"id, first_name",
				"last_name",
				"age",
				"sex",
				"height",
				"weight" 
		];
		$query = "SELECT " . arrayToString ( $columns ) . " FROM " . getTableQuote ( $table ) .";";
		echo json_encode ( runQuery ( $query ) );
	} else {
		$columns = getColumnNames ( $table );
		print json_encode ( getSpecificData ( $table, $columns ) );
	}
} else if (! empty ( $_GET ['id'] )) {
	include_once $serverPath.'utils/security/canSee.php';
	$id = $_GET ['id'];
	echo json_encode ( findById ( $table, $id ) );
}

?>