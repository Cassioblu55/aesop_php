<?php
require_once '../src/utils/connect.php';
require_once '../src/generator/dungeon.php';

$table = "dungeon";
if (! empty ( $_POST )) {
	createDungeon();
	if (empty ( $_GET ['id'] )) {
		insert($table);
		$added = true;
	} 

	else {
		update($table);
		header ( "Location: show.php?id=".$_GET['id'] );
		die ( "Redirecting to show.php" );
	}
	
} 
include_once '../resources/templates/head.php';
?>
<div ng-controller="DungeonAddEditController">
<form
	action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
	method="post">
	<div class="col-md-6">
		<div
			class="panel <?php if($added){echo "panel-success";} else{echo "panel-default";} ?>">
			<div class="panel-heading">
				<div class="panel-title">{{addOrEdit}} Dungeon</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control"  name="name" ng-model="dungeon.name" placeholder= "Dungeon Name" />
				</div>
				<div class="form-group">
					<label for="purpose">Purpose</label>
					<input type="text" class="form-control"  name="purpose" ng-model="dungeon.purpose" placeholder="Purpose"/>
				</div>
				<div class="form-group">
					<label for="history">History</label>
					<input type="text" class="form-control"  name="history" ng-model="dungeon.history" placeholder="History"/>
				</div>
				<div class="form-group">
					<label for="location">Location</label>
					<input type="text" class="form-control"  name="location" ng-model="dungeon.location" placeholder="Location"/>
				</div>
				<div class="form-group">
					<label for="creator">Creator</label>
					<input type="text" class="form-control"  name="creator" ng-model="dungeon.creator" placeholder="Creator"/>
				</div>
				
				<div class="form-group">
					<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
					<a class="btn btn-danger" href="index.php">Cancel</a>
				</div>
				<div style='<?php if($added){echo "color:#5cb85c";}else{echo "display:none";}?>'>Added dungeon</div>
			</div>
		</div>
	</div>

</form>
<div id="dungeon" style="display: none"><?php if(!empty($_GET['id'])){echo json_encode(findById($table, $_GET['id']));}?></div>
</div>

<script type="text/javascript">
var dungeonData =  document.getElementById("dungeon").textContent
if(dungeonData){var dungeon =JSON.parse(dungeonData)};
app.controller("DungeonAddEditController", ['$scope', "$http" , function($scope, $http){
	if(dungeon){
		$scope.dungeon = dungeon;
	}
		$scope.addOrEdit = (!dungeon) ? "Add" : "Edit";
		$scope.saveOrUpdate = (!dungeon) ? "Save" : "Update"
	
}]);

</script>


