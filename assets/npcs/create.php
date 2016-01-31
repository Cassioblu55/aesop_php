<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_post.php';
require_once $serverPath . 'utils/generator/npc.php';
createCharacter ();
$table = "npc";
header ( "Location: " . $baseURL . "assets/npcs/show.php?id=" . insertFromPostWithIdReturn ( $table ) );
?>