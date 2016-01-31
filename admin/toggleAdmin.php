<?php
include_once '../config/config.php';
include_once $serverPath.'utils/security/requireAdmin.php';
include_once $serverPath.'utils/db/db_post.php';
include_once $serverPath.'utils/db/db_get.php';

$_POST = json_decode(file_get_contents('php://input'), true);
if(!empty($_POST) && !empty($_POST['id']) && $_POST['id'] != $_SESSION['user']['id']){
	$id = $_POST['id'];
	$table = "users";
	$user = findById($table, $id);
	$data = ['admin' => (($user['admin'] == 1) ? '0' : '1')];
	$constraints = ['id' => $id, "protected" => 0];
	updateWithConstratints($table, $data, $constraints);
}
?>