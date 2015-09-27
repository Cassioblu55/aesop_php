<?php
require_once '../src/utils/connect.php';
require_once '../src/generator/character.php';

$added = false;
if (! empty ( $_POST )) {
	
	if (empty ( $_POST ['trait'] )) {
		die ( "Please trait." );
	}
	if (empty ( $_POST ['type'] )) {
		die ( "Please enter type." );
	}
	
	$db = connect ();
	$insert = '';
	if (empty ( $_GET ['id'] )) {
		$insert = "INSERT INTO character_traits (trait, type) VALUES ('" . $_POST ['trait'] . "','" . $_POST ['type'] . "');";
	} 

	else {
		$insert = "UPDATE character_traits SET trait='" . $_POST ['trait'] . "', type='" . $_POST ['type'] . "' WHERE id=" . $_GET ['id'] . ";";
	}
	try {
		$db->query ( $insert );
		$added = true;
	} catch ( Execption $e ) {
		echo $e;
		die ( "Count not insert trait." );
	}
	$db->close ();
	header ( "Location: index.php" );
	die ( "Redirecting to index.php" );
} else {
	if (empty ( $_GET ['id'] )) {
		$trait = '';
		$type = '';
	} else {
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
include_once '../resources/templates/head.php';
?>

<form
	action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
	method="post">
	<div class="col-md-6">
		<div
			class="panel <?php if($added){echo "panel-success";} else{echo "panel-default";} ?>">
			<div class="panel-heading">
				<div class="panel-title">Edit Character</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="first_name">First Name</label> <input type="text"
						class="form-control" required="required" name="first_name"
						value="<?php echo $first_name;?>" placeholder="First Name" />
				</div>
				<div class="form-group">
					<label for="last_name">Last Name</label> 
					<input type="text" class="form-control" required="required" name="last_name" value="<?php echo $last_name;?>" placeholder="Last Name" />
				</div>

				<div class="form-group">
					<label for="sex">Sex</label> 
					<select class="form-control" required="required" name="sex">
						<option value="m">Male</option>
						<option value="f">Female</option>
						<option value="o">Other</option>
					</select>
				</div>
				
				<div class=" col-sm-6 form-group">
					<label for="feet">Feet</label>
					<input type="number" class="form-control" required="required" name="feet" value="<?php echo $feet;?>" placeholder="Feet"/>
				</div>
				<div class=" col-sm-6 form-group">
					<label for="inches">Inches</label>				
					<input type="number" class="form-control" required="required" name="inches" value="<?php echo $inches;?>" placeholder="Inches"/>
				</div>
				
				<div class="form-group">
					<label for="weight">Weight</label>
					<div class="input-group">
						<input type="number" class="form-control" required="required" name="weight" value="<?php echo $weight;?>" placeholder="Weight"/>
						<div class="input-group-addon">lbs</div> 
					</div>
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

<?php include_once '../resources/templates/footer.php';?>