<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';

$table = "urban_encounters";
header ( "Location: " . $baseURL . "assets/encounters/urban/show.php?id=" . getRandomId ( $table ) );

?>