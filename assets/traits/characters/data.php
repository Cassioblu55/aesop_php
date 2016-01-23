<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db_get.php';

$query = "SELECT * FROM character_traits;";
$result = runQuery ( $query );
print json_encode ( $result );
?>