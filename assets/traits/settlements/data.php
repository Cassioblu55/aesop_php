<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/connect.php';

$table = "settlement_traits";
print json_encode ( getAllData ( $table ) );
?>