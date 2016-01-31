<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_post.php';
include_once $serverPath.'utils/security/canSee.php';

if (! empty ( $_GET ['id'] )) {
	$table = "npc";
	deleteFrom ( $table, $_GET ['id'] );
}
?>