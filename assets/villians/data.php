<?php 
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';
	$table = "villian";
	if(!empty($_GET["id"])){
		$query = "SELECT * FROM `villian` INNER JOIN `character` ON villian.character_id = character.id WHERE villian.id=".$_GET['id'];
		print json_encode(runQuery($query)[0]);
	}
	else if(!empty($_GET['column'])){
		$column = $_GET['column'];
		if($column == "stats"){
			$query = " SELECT villian.id, villian.method_type, villian.scheme_type, villian.weekness_type, character.first_name,
						character.last_name FROM `villian` INNER JOIN `character` ON villian.character_id = character.id;";
			print json_encode(runQuery($query));
		}
		else if($column =="ids"){
			$query = "SELECT character_id AS id FROM `villian`;";
			$results = runQuery($query);
			$ids = [];
			foreach ($results as $result){
				array_push($ids, $result['id']);
			}
			print json_encode($ids);
		}
		
	}
?>