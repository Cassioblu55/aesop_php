<?php
if(isset($table)){
	
	if(!empty($_GET['id'])){
		echo json_encode(findById($table, $_GET['id']));
	}
}else{
	echo "Table not set";
}

