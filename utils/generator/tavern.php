<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/utils.php';
require_once $serverPath . 'utils/generator/npc.php';
function createTavern() {
	$table = "tavern";
	$trait_table = "tavern_traits";
	
	if (empty ( $_POST ['name'] )) {
		$first = getTrait ( $trait_table, "first_name" );
		$last = getTrait ( $trait_table, "last_name" );
		$_POST ['name'] = $first . " " . $last;
	}
	
	if (empty ( $_POST ['type'] )) {
		$_POST ['type'] = getTrait ( $trait_table, "type" );
	}
	
	// create owner
	if (empty ( $_POST ['tavern_owner_id'] )) {
		createNpc ();
		$table = "npc";
		$_POST ['tavern_owner_id'] = insertFromPostWithIdReturn ( $table );
	}
}

?>