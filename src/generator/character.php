<?php 
	require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
	require_once '/home4/cassio/public_html/aesop/src/generator/utils.php';
		
	function createCharacter(){
		$trait_table = "character_traits";
		$table = "character";
		
		$columns = getColumnNames($table);
		
		if(empty($_POST["sex"])){
			$_POST["sex"] = getGender();
		}
		
		if(empty($_POST["weight"])){
			$_POST["weight"] = getWeight();
		}
		
		if(empty($_POST["height"])){
			$_POST["height"] = getHeight();
		}
		
		if(empty($_POST["age"])){
			$_POST["age"] = getAge();
		}
		
		if(empty($_POST["first_name"])){
			$_POST["first_name"] = getName();
		}
		
		//will add the remaining traits not already added
		foreach ($columns as $column){
			if(empty($_POST[$column])){
				$_POST[$column]=getTrait($trait_table, $column);
			}
		}
	}
	
	function getName(){
		if($_POST['sex']=='F'){
			return getTrait("character_traits", "female_name");
		}
		return getTrait('character_traits', "male_name");
	}
	
	function getAge(){
		return purebell(16,50,5);
	}
		
	function getGender(){
		return (rand(0,1)==0) ? "M" :"F";
	}
	
	function getWeight(){
		if($_POST["gender"] == 'F'){
			return purebell(90,190,20);
		}
		return purebell(110,250,29);
	}
	
	function getHeight(){
		if($_POST["gender"] == 'F'){
			return purebell(48,72,2.7);
		}
		return purebell(54,78,2.9);
	}
	

?>