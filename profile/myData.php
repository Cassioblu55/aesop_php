<?php
include_once '../config/config.php';
include_once $serverPath.'utils/security/requireLogin.php';
include_once $serverPath.'utils/db/db_get.php';

$data = runQuery("SELECT first_name, last_name, id, admin, protected, username, email, assestDefaultAccess FROM ".getTableQuote('users')." WHERE id='".$_SESSION['user']['id']."';");
if(count($data) == 1){
	echo json_encode($data[0]);
}
?>
