<?php
include_once '../config/config.php';
include_once $serverPath.'login/requireAdmin.php';
include_once $serverPath.'utils/db_post.php';
include_once $serverPath.'utils/db_get.php';

$_POST = json_decode(file_get_contents('php://input'), true);
if(!empty($_POST) && !empty($_POST['id']) && $_POST['id'] != $_SESSION['user']['id']){
	$id = $_POST['id'];
	$table = "users";
	$user = findById($table, $id);
	if($user['protected'] == '0'){
		deleteFrom($table, $id);
	}
	
}
?>