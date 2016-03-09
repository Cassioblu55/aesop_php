<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/npc.php';
require_once $serverPath .'utils/security/createAssestRequired.php';

createNpc ();
$table = "npc";
header ( "Location: " . $baseURL . "assets/npcs/show.php?id=" . insertFromPostWithIdReturn ( $table ) );
?>