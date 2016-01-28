<?php

include_once '../config/config.php';
include_once $serverPath.'login/requireLogin.php';
include_once $serverPath.'utils/db_get.php';

echo json_encode(runQuery("SELECT first_name, last_name, id, username, email FROM ".getTableQuote('users')." WHERE id='".$_SESSION['user']['id']."';"));

?>
