<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';

$table = "settlement";
include_once $serverPath.'utils/db/findById.php';

if (!empty ( $_GET ['column'] )) {
	$column = $_GET ['column'];
	if ($column == "index") {
		$columns = [ 
				'name',
				'population',
				'known_for' 
		];
		print json_encode ( getSpecificData ( $table, $columns ) );
	} else {
		//$columns = getColumnNames ( $table );
	}
	
}

?>