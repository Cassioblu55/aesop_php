<?php 
require_once '/home4/cassio/public_html/aesop/src/utils/connect.php';

function getTrait($table, $type){
	$query = "SELECT * FROM `".$table."` WHERE type='".$type."' ORDER BY RAND() LIMIT 1;";
	return runQuery($query)[0]['trait'];
}

function purebell($min,$max,$std_deviation,$step=1) {
	$rand1 = (float)mt_rand()/(float)mt_getrandmax();
	$rand2 = (float)mt_rand()/(float)mt_getrandmax();
	$gaussian_number = sqrt(-2 * log($rand1)) * cos(2 * M_PI * $rand2);
	$mean = ($max + $min) / 2;
	$random_number = ($gaussian_number * $std_deviation) + $mean;
	$random_number = round($random_number / $step) * $step;
	if($random_number < $min || $random_number > $max) {
		$random_number = purebell($min, $max,$std_deviation);
	}
	return $random_number;
}

?>