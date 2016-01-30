<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_post.php';

if (! empty ( $_GET ['id'] )) {
	$table = "ncp";
	deleteFrom ( $table, $_GET ['id'] );
}
?>