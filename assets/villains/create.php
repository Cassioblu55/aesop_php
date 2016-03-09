<?php
include_once '../../config/config.php';
require_once $serverPath .'utils/security/createAssestRequired.php';

include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/villain.php';

createVillain ();
$table = "villain";
header ( "Location: " . $baseURL . "assets/villains/show.php?id=" . insertFromPostWithIdReturn ( $table ) );

?>