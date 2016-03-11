<?php 

include_once $serverPath . 'utils/db/db_post.php';

if(!isset($table)){
	echo "Table has not been set";
}else{
	if (! empty ( $_POST )) {
		if($runOnSave){
			$runOnSave();
		}
		if (! empty ( $_GET ['id'] )) {
			$id = $_GET ['id'];
			updateFromPost ( $table );
		} else {
			$_POST['owner_id'] = $_SESSION['user']['id'];
			$_POST['approved'] = $_SESSION['user']['admin'];
			$id = insertFromPostWithIdReturn ( $table );
		}
		
		if(isset($route)){
			header ( "Location: $route");
			die ( "Redirecting to $rotues" );
			
		}else{
			header ( "Location: show.php?id=" . $id );
			die ( "Redirecting to show.php" );
			
		}
	}
}
?>