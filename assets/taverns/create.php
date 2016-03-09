<?php
include_once '../../config/config.php';
require_once $serverPath .'utils/security/createAssestRequired.php';

include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/tavern.php';
createTavern ();
$table = "tavern";
header ( "Location: " . $baseURL . "assets/taverns/show.php?id=" . insertFromPostWithIdReturn ( $table ) );
?>