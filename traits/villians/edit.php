<?php
require_once '../../src/utils/connect.php';

$added = false;
if (! empty ( $_POST )) {
	
	if (empty ( $_POST ['kind'] )) {
		die ( "Please enter kind." );
	}
	if (empty ( $_POST ['type'] )) {
		die ( "Please enter type." );
	}
	if (empty ( $_POST ['description'] )) {
		die ( "Please enter a description." );
	}
	
	$db = connect ();
	$insert = '';
	if (empty ( $_GET ['id'] )) {
		$insert = "INSERT INTO villain_trait (kind, type, description) VALUES ('" . $_POST ['kind'] . "','" . $_POST ['type'] . "','" . $_POST ['description'] . "');";
	} 

	else {
		$insert = "UPDATE villain_trait SET kind='" . $_POST ['kind'] . "', description='" . $_POST ['description'] . "' WHERE id=" . $_GET ['id'] . ";";
	}
	try {
		$db->query ( $insert );
		$added = true;
	} catch ( Execption $e ) {
		echo $e;
		die ( "Count not insert trait." );
	}
	$db->close ();
	if (! empty ( $_GET ['id'] )) {
		header ( "Location: index.php" );
		die ( "Redirecting to index.php" );
	}
} else {
	if (empty ( $_GET ['id'] )) {
		$kind = '';
		$description = '';
		$type = '';
	} else {
		$db = connect ();
		$query = "SELECT * FROM villain_trait WHERE id='" . $_GET ['id'] . "';";
		try {
			$result = $db->query ( $query );
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc ();
				$kind = $row ['kind'];
				$description = $row ['description'];
				$type = $row ['type'];
			}
		} catch ( Execption $e ) {
			echo $e;
			die ( "Something went wrong." );
		}
		$db->close ();
	}
}
include_once '../../resources/templates/head.php';
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
					<label for="kind">Kind</label> <input type="text"
						class="form-control" required="required" name="kind"
						value="<?php echo $kind;?>" placeholder="Kind" />
				</div>
				<div class="form-group">
					<label for="type">Type</label> <input type="text"
						class="form-control" required="required" name="type"
						value="<?php echo $type;?>" placeholder="Type" />
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" rows="5" name="description"
						placeholder="Description"><?php echo $description;?></textarea>
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