<?php

if(isset($table)){
	if (! empty ( $_GET ['id'] )) {
		deleteFrom( $table, $_GET ['id'] );
	}
	
}else{
	echo "Table not set";
}


?>


