<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';

$table = "forest_encounters";
header ( "Location: " . $baseURL . "assets/encounters/forest/show.php?id=" . getRandomId ( $table ) );

?>