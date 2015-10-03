<?php
require_once '/home4/cassio/public_html/aesop/src/generator/utils.php';
require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';
require_once '/home4/cassio/public_html/aesop/src/generator/character.php';
function createSettelment() {
	$trait_table = "settlement_traits";
	$table = "settlement";
	
	$columns = getColumnNames ( $table );
	
	if (empty ( $_POST ['size'] )) {
		$i = rand ( 0, 2 );
		if ($i == 0) {
			$size = "S";
		} else if ($i == 1) {
			$size = "M";
		} else {
			$s = "L";
		}
		$_POST ['size'] = $size;
	}
	
	if (empty ( $_POST ['population'] )) {
		$size = $_POST ['size'];
		if ($size == "S") {
			$pop = purebell ( 20, 75, 5 );
		} else if ($size == "M") {
			$pop = purebell ( 76, 300, 10 );
		} else {
			$pop = purebell ( 300, 1500, 100 );
		}
		$_POST ['population'] = $pop;
	}
	
	// Pick a mayor
	if (empty ( $_POST ['ruler_id'] )) {
		createCharacter ();
		$table = "character";
		$_POST ['ruler_id'] = insertAndReturnId ( $table );
	}
	
	foreach ( $columns as $column ) {
		if (empty ( $_POST [$column] )) {
			$_POST [$column] = getTrait ( $trait_table, $column );
		}
	}
}

?>