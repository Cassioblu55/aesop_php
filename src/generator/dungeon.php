<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';	
	require_once '/home4/cassio/public_html/aesop/src/generator/utils.php';

	function createDungeon(){
		
		$trait_table = "dungeon_traits";
		$table = "dungeon";
		$columns = getColumnNames($table);
		
		foreach ($columns as $column){
			if(empty($_POST[$column])){
				$_POST[$column]=getTrait($trait_table, $column);
			}
		}
		
	}

?>