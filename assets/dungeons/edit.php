<?php
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';
include_once $serverPath.'utils/db_post.php';
require_once $serverPath.'utils/generator/dungeon.php';

$table = "dungeon";
if (! empty ( $_POST )) {
	createDungeon();
	if (empty ( $_GET ['id'] )) {
		$id  = insertFromPostWithIdReturn($table);
	} 

	else {
		updateFromPost($table);
		$id = $_GET['id'];
	}
	header ( "Location: show.php?id=". $id);
	die ( "Redirecting to show.php" );
	
} 
include_once $serverPath.'resources/templates/head.php'; ?>

<div ng-controller="DungeonAddEditController">
<form action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>" method="post">
	<div class="col-md-12">
		<div
			class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">{{addOrEdit+' '+(dungeon.name || 'Dungeon')}}</div>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
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
						<label>Number of Traps</label>
						<input class="form-control" type="number" ng-model="trapNumber" placeholder="Number of Traps"/>
					</div>
					<div class="row" ng-show="traps.length >0">
						<div class="col-md-4">
							<lable>Kind</lable>
						</div>
						<div class="col-md-4">
							<lable>Column</lable>
						</div>
						<div class="col-md-4">
							<lable>Row</lable>
						</div>
					</div>
					<div ng-repeat="trap in traps">
						<div class="form-group row">
							<div class="col-md-4">
								<select ng-model="trap.id" class="form-control">
									<option value="">Any</option>
									<option ng-repeat="trapOption in trapOptions" value={{trapOption.id}}>{{trapOption.name}}</option>
								</select>
							</div>
							<div class="col-md-4">
								<select ng-model="trap.column"  class="form-control">
									<option value="">Any</option>
									<option ng-repeat="(value, letter) in trap.columnOptions" value={{value}}>{{letter}}</option>
								</select>
							</div>
							<div class="col-md-4">
								<select ng-model="trap.row" class="form-control">
									<option value="">Any</option>
									<option ng-repeat="(key, value) in trap.rowOptions" value={{key}}>{{value}}</option>
								</select>
							</div>
						</div>
				</div>
					<div class="form-group">
						<button class="btn btn-primary" ng-click="submit" type="submit">{{saveOrUpdate}}</button>
						<a class="btn btn-danger" href="index.php">Cancel</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="map">Map</label>
						<div>
							<canvas id="mapDisplay" class="dungeon_map" style="width: 384px; height: 384px;">
							Your browser does not support the HTML5 canvas tag.
							</canvas>
						</div>
						<button type="button" class="btn btn-primary" ng-click="generateMap()">New Map</button>
						<button type="button" class="btn btn-primary" ng-click="setRandomTraps()">Set traps</button>
					</div>
					<div ng-repeat="trap in traps">
						<label>{{getTrapDisplay(trap).title}}</label>
						<p>{{getTrapDisplay(trap).description}}</p>
					</div>
					</div>
				</div>
			</div>
		</div>
	<textarea style = "display: none" type="text" ng-model="dungeon.map" name="map"></textarea>
	<input style = "display: none" type="text" ng-model="dungeon.traps" type="text" name="traps"/>
</form>
</div>

<script src="<?php echo $baseURL;?>resources/mapGenerator.js"></script>
<script type="text/javascript">
app.controller("DungeonAddEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('TrapController', {$scope: $scope}));
	//Load in traps
	
	function loadTraps(traps){$scope.trapOptions = traps;}
	$scope.setFromGet("data.php?column=traps",loadTraps);
	
	$scope.letters = letters;
	$scope.saveOrUpdate = "Add";
	$scope.addOrEdit = "Save"; 
	
	$scope.$watch('dungeon.size', function(val, oldVal){
		//If map size is being changed generate a new map
		if(oldVal && val && val != ''){
			$scope.generateMap();
		}
	});
	
	$scope.traps = [];
	$scope.$watch('trapNumber', function(newVal,oldVal){
		if(!$scope.traps){$scope.traps=[];}
		if(newVal != $scope.traps.length){
			while($scope.traps.length < newVal){
				var trap = {};
				$scope.traps.push(trap);
			}
			while($scope.traps.length > newVal){
				$scope.traps.pop();
			}
			
		} 
	});

	$scope.$watch('traps', function(val){
		if(val && val.length > 0){
			//Remove all traps in map
			$scope.map.removeTraps();
			for(var i=0; i<val.length; i++){
				//Set aviable options for each trap row				
				var trap = val[i];
				val[i].rowOptions = $scope.map.activeRows(trap.column);
				val[i].columnOptions = $scope.map.activeColumns(trap.row);
				if(trap.row && trap.column){
					$scope.map.setTrap(trap.column,trap.row);
				}
			}
			$scope.stringifyMap($scope.map.getTiles());
			$scope.dungeon.traps = getTrapSting(val);		
		}
	}, true);	

	$scope.$watch('dungeon.map', function(val){
		if(val){
			drawMap(JSON.parse(val));
		}
	});

	$scope.setDungeon = function(dungeon){
		$scope.dungeon = dungeon;
		$scope.map = map(JSON.parse(dungeon.map));
		$scope.map.setActiveTiles();
		$scope.traps = stringToTraps(dungeon.traps);
		$scope.trapNumber = ($scope.traps) ? $scope.traps.length : 0;
		
	}

	//Will make http request if id url parameter is present
	if(isEdit()){
		$scope.setById($scope.setDungeon);
		$scope.saveOrUpdate = "Update";
		$scope.addOrEdit = "Edit"; 
	}
	//If no id then it will set up to create a new dungeon
	else{
		$scope.dungeon = {};
		$scope.dungeon.name = "Test";
		$scope.dungeon.size = getRandomSize();
	}

	
}]);
</script>


