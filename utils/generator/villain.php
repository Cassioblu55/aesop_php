<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/utils.php';
require_once $serverPath . 'utils/generator/npc.php';
function createVillain() {
	$trait_table = "villain_trait";
	$table = "villain";
	
	$columns = getColumnNames ( $table );
	
	if (empty ( $_POST ['npc_id'] )) {
		createCharacter ();
		$c_table = "npc";
		$_POST ['npc_id'] = insertFromPostWithIdReturn ( $c_table );
	}
	
	foreach ( $columns as $column ) {
		
		if (empty ( $_POST [$column] )) {
			$c = split ( "_", $column );
			if (count ( $c ) == 2) {
				$type = $c [0];
				$trait = getFullTrait ( $trait_table, $type );
				$_POST [$type . "_type"] = $trait ['kind'];
				$_POST [$type . "_description"] = $trait ['description'];
			} else {
				$_POST [$column] = getTrait ( $trait_table, $column );
			}
		}
	}
}

?>