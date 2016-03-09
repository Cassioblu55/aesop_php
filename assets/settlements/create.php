<?php
include_once '../../config/config.php';
require_once $serverPath .'utils/security/createAssestRequired.php';

include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/settlement.php';

createSettelment ();
$table = "settlement";
header ( "Location: " . $baseURL . "assets/settlements/show.php?id=" . insertFromPostWithIdReturn ( $table ) );
?>