<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db_get.php';

$table = "riddles";
header ( "Location: " . $baseURL . "assets/encounters/riddles/show.php?id=" . getRandomId ( $table ) );

?>