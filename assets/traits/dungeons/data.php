<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/connect.php';

$query = "SELECT * FROM dungeon_traits;";
$result = runQuery ( $query );
print json_encode ( $result );
?>