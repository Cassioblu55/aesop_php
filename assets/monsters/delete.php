<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_post.php';

if (! empty ( $_GET ['id'] )) {
	$table = "monster";
	deleteFrom ( $table, $_GET ['id'] );
}
?>