<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';
	$table = "villain";
	if(!empty($_GET["id"])){
		$query = "SELECT * FROM `villain` INNER JOIN `character` ON villain.character_id = character.id WHERE villain.id=".$_GET['id'];
		print json_encode(runQuery($query)[0]);
	}
	else if(!empty($_GET['column'])){
		$column = $_GET['column'];
		if($column == "stats"){
			$query = " SELECT villain.id, villain.method_type, villain.scheme_type, villain.weakness_type, character.first_name,
						character.last_name FROM `villain` INNER JOIN `character` ON villain.character_id = character.id;";
			print json_encode(runQuery($query));
		}
		else if($column =="ids"){
			$query = "SELECT character_id AS id FROM `villain`;";
			$results = runQuery($query);
			$ids = [];
			foreach ($results as $result){
				array_push($ids, $result['id']);
			}
			print json_encode($ids);
		}
		
	}
?>