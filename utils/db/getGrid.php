<?php
if(isset($table)){
	if (!empty ( $_GET ['get'] )) {
		if($_GET ['get'] =="grid"){
			echo json_encode(getAllData($table));
		}
		
	}
	
}else{
	echo "Table not set";
}

?>