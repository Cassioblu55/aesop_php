<?php 

require_once '/home4/cassio/public_html/aesop/src/generator/utils.php';
require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
require_once '/home4/cassio/public_html/aesop/src/generator/character.php';

	function createTavern(){
		$table = "tavern";
		$trait_table = "tavern_traits";
		
		if(empty($_POST['name'])){
			$first = getTrait ( $trait_table, "first_name");
			$last = getTrait($trait_table, "last_name");
			$_POST['name'] = $first." ".$last;
		}
		
		if(empty($_POST['type'])){
			$_POST['type'] = getTrait($trait_table, "type");
		}
		
		//create owner
		if(empty($_POST['owner_id'])){
			createCharacter ();
			$table = "character";
			$_POST ['owner_id'] = insertAndReturnId ( $table );
		}
		
	}

?>