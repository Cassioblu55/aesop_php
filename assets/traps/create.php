<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_post.php';
require_once $serverPath . 'utils/generator/villain.php';

createVillain ();
$table = "villain";
header ( "Location: " . $baseURL . "assets/villains/show.php?id=" . insertFromPostWithIdReturn ( $table ) );

?>