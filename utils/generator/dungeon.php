<?php 
	include_once '../../config/config.php';
	include_once $serverPath.'utils/db_get.php';
	require_once $serverPath.'utils/generator/utils.php';

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