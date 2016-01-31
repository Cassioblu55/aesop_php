<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';
$table = "villain";
if (! empty ( $_GET ["id"] )) {
	$joinOn = [ 
			"npc_id" => "id" 
	];
	
	$t1_constraints = [ 
			"id" => $_GET ["id"] 
	];
	$t2_constraints = [ ];
	
	$query = getJoin ( "villain", "npc", $joinOn, $t1_constraints, $t2_constraints );
	
	print json_encode ( runQuery ( $query ) [0] );
} else if (! empty ( $_GET ['column'] )) {
	$column = $_GET ['column'];
	if ($column == "stats") {
		$query = " SELECT villain.id, villain.method_type, villain.scheme_type, villain.weakness_type, npc.first_name,
						npc.last_name FROM `villain` INNER JOIN `npc` ON villain.npc_id = npc.id;";
		print json_encode ( runQuery ( $query ) );
	} else if ($column == "ids") {
		$query = "SELECT npc_id AS id FROM `villain`;";
		$results = runQuery ( $query );
		$ids = [ ];
		foreach ( $results as $result ) {
			array_push ( $ids, $result ['id'] );
		}
		print json_encode ( $ids );
	}
}
?>