<?php 
	include_once '../../config/config.php';
	include_once $serverPath.'utils/db_post.php';
	require_once $serverPath.'utils/generator/utils.php';
	require_once $serverPath.'utils/generator/character.php';
	
	function createVillain(){
		$trait_table = "villain_trait";
		$table = "villain";
		
		$columns = getColumnNames ( $table );
		
		if (empty ( $_POST ['character_id'] )) {
			createCharacter ();
			$c_table = "character";
			$_POST ['character_id'] = insertFromPostWithIdReturn ( $c_table );
		}
		
		foreach ( $columns as $column ) {
			
			if (empty ( $_POST [$column] )) {
				$c = split("_", $column);
				if(count($c) == 2){
					$type = $c[0];
					$trait = getFullTrait( $trait_table, $type);
					$_POST[$type."_type"] = $trait['kind'];
					$_POST[$type."_description"] = $trait['description'];
					
				}
				else{
					$_POST [$column] = getTrait( $trait_table, $column );
				}
				
			}
		}
	}

?>