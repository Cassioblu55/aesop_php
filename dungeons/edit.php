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
					<div class="dungeon_map">
						<canvas id="mapDisplay" ng-class="dungeon.size=='S' ? 'small' : dungeon.size=='M' ? 'medium' : 'large'">
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

<script type="text/javascript">
var dungeonData =  document.getElementById("dungeon").textContent
if(dungeonData){var dungeon =JSON.parse(dungeonData)};
app.controller("DungeonAddEditController", ['$scope', "$http" , function($scope, $http){

	$scope.getParsedMap = function(){return JSON.parse($scope.dungeon.map);}
	$scope.stringifyMap = function(map){$scope.dungeon.map = JSON.stringify(map, null, '');}

	//Set size hash
	var sizeHash = {"S": 6, "M": 8, "L":12};
	
	var map = function(t){
		var that = {};
		var tiles = t;
		var activeTiles =[];
		var maxTiles = {"S": 30, "M": 60, "L": 90};

		function mapFull(){
			return 
		}
		
		function getTiles(){
			return tiles;
		}
		that.getTiles = getTiles;
		
		function get(x,y){
			return vaildTile(x,y) ? {"x" : x, "y" : y} : null;
		}
		that.get = get;

		function vaildTile(x,y){
			return (x>=0 && y>=0 && x<tiles[0].length && y<=tiles[0].length);
		}

		function set(t, value){
			if(vaildTile(t.x,t.y)){
				tiles[t.y][t.x]=value;
				activeTiles.push(t);
			}
		}
		that.set = set;

		function active(t){
			for(var i=0; i<activeTiles.length; i++){
				var at = activeTiles[i];
				if(at.x == t.x && at.y ==y){return true;}
			}
			return false;
		}
		that.active = active;
		
		function move(s, d){
			if(d==0){return get(s.x, s.y+1);}
			else if(d==1){return get(s.x, s.y-1);}
			else if(d==2){return get(s.x+1, s.y);}
			else{return get(s.x-1, s.y);}
		}
		that.move = move;
		
		return that;
	}

	function drawMap(tiles){
		console.log(tiles);
		var c = document.getElementById("mapDisplay");
		var tileSize = 32; var mapSize = tiles[0].length
		var colors = { 
				"x" : "#FFFFF0", "s" : "#006400",
				"t" : "#DC143C", "w" : "#A9A9A9"
					}
		
		var ctx = c.getContext("2d");
		var yStart=0;
		for(var y=0; y<mapSize; y++){
			var xStart = 0;
			for(var x=0; x<mapSize; x++){
				ctx.fillStyle = colors[tiles[y][x]];
				ctx.fillRect(xStart,yStart,tileSize, tileSize/2);
				xStart += tileSize;
			}
			yStart += (tileSize/2);
		}
		
	}
	
	$scope.generateMap = function(){
		//Start by finding the size if it dons't exist
		if(!$scope.dungeon.size){
			$scope.dungeon.size = getRandomSize();
		}
		var t = getBlankMap($scope.dungeon.size);
		var m = map(t);
		var size = sizeHash[$scope.dungeon.size];
		var start = m.get(getRandomNormal(size),0);
		m.set(start,"s");

		
		
		$scope.stringifyMap(m.getTiles());
		drawMap(m.getTiles());
	}

	

	//Down = 0, Up = 1, Right = 2, Left = 4
	function makeBranch(map, startY, startX, direction){
		
	}
		
	function getRandomDirection(){
		return Math.floor(Math.random() * 4);
	}
	
	function getRandomSize(){
		var rand = Math.floor(Math.random() * 2);
		return (rand==0) ? "S" : (rand==1) ? "M" : "L";
	}

	function getRandomNormal(n){
		return Math.floor(Math.random() * n);
	}
	
	
	$scope.addOrEdit = (!dungeon) ? "Add" : "Edit";
	$scope.saveOrUpdate = (!dungeon) ? "Save" : "Update"
	
	function getBlankMap(size){
		var count = sizeHash[size];
		var map = [];
		for(var y=0; y<count; y++){
			var mapRow = [];
			for(var x=0; x<count; x++){
				mapRow.push("x");
			}
			map.push(mapRow);
		}
		return map;
	}

	$scope.showMap = function(){
		var dispaly = "";
		var map = $scope.getParsedMap();
		for(var y=0; y<map.length; y++){
			
			dispaly += map[y].toString()+"<br>";
		}
		
		//for(var y=0; y<
			
		return dispaly;
		
	}

	if(dungeon){
		$scope.dungeon = dungeon;
	}
	else{
		$scope.dungeon = {};
		$scope.generateMap();
	}
	
	
}]);

</script>

