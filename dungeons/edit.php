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
					<input type="text" class="form-control"  name="name" ng-model="dungeon.name" placeholder="Dungeon Name" />
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
					<label for="size">Size</label>
					<select class="form-control" ng-model="dungeon.size"  name="size">
						<option value="">Any</option>
						<option ng-selected={{dungeon.size=="S"}} value="S">Smalll</option>
						<option ng-selected={{dungeon.size=="M"}} value="M">Medium</option>
						<option ng-selected={{dungeon.size=="L"}} value="L">Large</option>
					</select>
				</div>
				<div class="form-group">
					<label for="map">Map</label>
					<div>
						<canvas id="mapDisplay" class="dungeon_map" style="width: 384px; height: 384px;">
						Your browser does not support the HTML5 canvas tag.
						</canvas>
					</div>
					<button type="button" class="btn btn-primary" ng-click="generateMap()">New Map</button>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
					<a class="btn btn-danger" href="index.php">Cancel</a>
				</div>
				<div style='<?php if($added){echo "color:#5cb85c";}else{echo "display:none";}?>'>Added dungeon</div>
			</div>
		</div>
	</div>
	<textarea class="form-control" style = "display: none" ng-model="dungeon.map" name="map"></textarea>
</form>
<div id="dungeon" style="display: none"><?php if(!empty($_GET['id'])){echo json_encode(findById($table, $_GET['id']));}?></div>
</div>

<script src="/aesop/resources/mapGenerator.js"></script>
<script type="text/javascript">
var dungeonData =  document.getElementById("dungeon").textContent
if(dungeonData){var dungeon =JSON.parse(dungeonData)};
app.controller("DungeonAddEditController", ['$scope', "$http" , function($scope, $http){

	$scope.getParsedMap = function(){return JSON.parse($scope.dungeon.map);}
	$scope.stringifyMap = function(map){$scope.dungeon.map = JSON.stringify(map, null, '');}

	$scope.saveOrUpdate = dungeon ? "Update" : "Save"; 

	var firstLoad = true;
	$scope.$watch('dungeon.size', function(val){
		if(firstLoad && dungeon && dungeon.map){
			drawMap($scope.getParsedMap());
		}
		else if(val && val != ''){
			$scope.stringifyMap(generateMap($scope.dungeon.size).getTiles());
			drawMap($scope.getParsedMap());
		}
		else{
			$scope.dungeon.size = getRandomSize();
		}
		firstLoad = false;
	});
	
	$scope.generateMap = function(){
		$scope.stringifyMap(generateMap($scope.dungeon.size).getTiles());
		drawMap($scope.getParsedMap());
	}
	
	//Set size hash
	if(dungeon){
		$scope.dungeon = dungeon;
		if(dungeon.map){
			drawMap($scope.getParsedMap());
		}
		else if(dungeon.size){
			$scope.generateMap(dungeon.size);
		}
		else{
			$scope.dungeon.size = getRandomSize();
		}
	}
	else{
		$scope.dungeon = {};
		$scope.dungeon.size = getRandomSize();
	}
	
	
}]);

</script>


