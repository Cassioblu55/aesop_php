<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db_post.php';

if (! empty ( $_GET ['id'] )) {
	$table = "urban_encounters";
	deleteFrom ( $table, $_GET ['id'] );
}
?>