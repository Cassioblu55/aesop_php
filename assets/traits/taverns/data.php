<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';

$query = "SELECT * FROM tavern_traits;";
$result = runQuery ( $query );
print json_encode ( $result );
?>