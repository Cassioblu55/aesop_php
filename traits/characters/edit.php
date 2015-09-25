<?php
require_once '../../src/utils/connect.php';

$added = false;
if (! empty ( $_POST )){
	
	if(empty($_POST['trait'])){
		die("Please trait.");
	}
	if(empty($_POST['type']))
	{
		die("Please enter type.");
	}
	
	$db = connect();
	$insert = "UPDATE character_traits SET trait='".$_POST['trait']."', type='".$_POST['type']."' WHERE id=".$_GET['id'].";";
	
	try{
		$db->query($insert);
		$added = true;
	}catch(Execption $e){
		echo $e;
		die("Count not insert song.");
	}
	$db->close();
	header("Location: index.php");
	die("Redirecting to index.php");
}else{
	$db = connect();
	$query = "SELECT * FROM character_traits WHERE id='".$_GET['id']."';";
	try{
		$result = $db->query($query);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$trait [] = $row;
			}
			$struct = array (
				"trait" => $trait
			);
			
			$s = $struct['trait'][0];
			$trait = $s['trait'];
			$type = $s['type'];
		}
	}catch(Execption $e){
		echo $e;
		die("Something went wrong.");
	}
	$db->close();
}
include_once '../../resources/templates/head.php';
?>

<form action="edit.php?id=<?php echo $_GET['id'];?>" method="post">
	<div class="col-sm-4">
		<div class="panel <?php if($added){echo "panel-success";} else{echo "panel-default";} ?>">
			<div class="panel-heading">
				<div class="panel-title">Edit Character Trait</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="trait">Trait</label>
					<input type="text" class="form-control" required="required" name="trait" value="<?php echo $trait;?>" placeholder="Trait"/>
				</div>
				<div class="form-group">
					<label for="type">Type</label>
					<input type="text" class="form-control" required="required" name="type" value="<?php echo $type;?>" placeholder="Type"/>
				</div>
				<div class="form-group">
					<button class="btn btn-default" type="submit">Save</button>
				</div>
				<div style='<?php if($added){echo "color:#5cb85c";}else{echo "display:none";}?>'>Recorded Updated</div>
			</div>
		</div>
	</div>

</form>

<?php include_once '../../resources/templates/footer.php';?>