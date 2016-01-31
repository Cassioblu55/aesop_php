<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_post.php';

if (! empty ( $_GET ['id'] )) {
	$table = "tavern";
	deletFrom ( $table, $_GET ['id'] );
}
?>