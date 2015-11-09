<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/connect.php';
$table = "tavern";
print json_encode ( getAllData ( $table ) );

?>