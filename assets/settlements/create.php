<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/connect.php';
require_once $serverPath . 'utils/generator/settlement.php';

createSettelment ();
$table = "settlement";
header ( "Location: /aesop/settlements/show.php?id=" . insertAndReturnId ( $table ) );
?>