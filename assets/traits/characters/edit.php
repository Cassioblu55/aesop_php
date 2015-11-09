<?php
include_once '../../../config/config.php';
include_once $serverPath.'utils/connect.php';

$table = "character_traits";
$added = false;
if (! empty ( $_POST )) {
	
	validateRequired($table);
	
	if (empty ( $_GET ['id'] )) {
		insert($table);
	} 
	else {
		update($table);
		//header ( "Location: index.php" );
		//die ( "Redirecting to index.php" );
	}

} else {
	if (empty ( $_GET ['id'] )) {
		$trait = '';
		$type = '';
	} 
	else {
		$db = connect ();
		$query = "SELECT * FROM character_traits WHERE id='" . $_GET ['id'] . "';";
		try {
			$result = $db->query ( $query );
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc ();
				$trait = $row ['trait'];
				$type = $row ['type'];
			}
		} catch ( Execption $e ) {
			echo $e;
			die ( "Something went wrong." );
		}
		$db->close ();
	}
}
include_once $serverPath.'resources/templates/head.php'; 
?>

<form
	action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
	method="post">
	<div class="col-sm-4">
		<div
			class="panel <?php if($added){echo "panel-success";} else{echo "panel-default";} ?>">
			<div class="panel-heading">
				<div class="panel-title">Edit Character Trait</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="trait">Trait</label> <input type="text"
						class="form-control" required="required" name="trait"
						value="<?php echo $trait;?>" placeholder="Trait" />
				</div>
				<div class="form-group">
					<label for="type">Type</label> <input type="text"
						class="form-control" required="required" name="type"
						value="<?php echo $type;?>" placeholder="Type" />
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Save</button>
					<a class="btn btn-danger" href="index.php">Cancel</a>
				</div>
				<div style='<?php if($added){echo "color:#5cb85c";}else{echo "display:none";}?>'>Recorded
					Updated</div>
			</div>
		</div>
	</div>

</form>

<?php include_once '../../resources/templates/footer.php';?>