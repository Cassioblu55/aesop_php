<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';
$table = "forest_encounters";
if (! empty ( $_GET ["id"] )) {
	print json_encode ( findById ( $table, $_GET ['id'] ) );
} else if (! empty ( $_GET ['columns'] )) {
	$columns = $_GET ['columns'];
	if ($columns == "grid") {
		$columns = [ 
				"title" 
		];
		echo json_encode ( getSpecificData ( $table, $columns ) );
	}
}

?>