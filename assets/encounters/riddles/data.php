<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db_get.php';
$table = "riddles";
if (! empty ( $_GET ["id"] )) {
	print json_encode ( findById ( $table, $_GET ['id'] ) );
} else if (! empty ( $_GET ['columns'] )) {
	$columns = $_GET ['columns'];
	if ($columns == "grid") {
		$columns = [ 
				"name" 
		];
		echo json_encode ( getSpecificData ( $table, $columns ) );
	}
}

?>