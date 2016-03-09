<?php
include_once $serverPath.'utils/security/requireLogin.php';

$_POST['owner_id'] = $_SESSION['user']['id'];
$_POST['public'] = $_SESSION['user']['assestDefaultAccess'];

?>