<?php
include_once '../../config/config.php';
include_once $serverPath.'utils/connect.php';

if (! empty ( $_GET ['id'] )) {
	$table = "dungeon";
	$s = findById ( $table, $_GET ['id']);
	$dungeon = json_encode ( $s );
} else {
	header ( "Location: index.php" );
	
	// Remember that this die statement is absolutely critical. Without it,
	// people can view your members-only content without logging in.
	die ( "Redirecting to index" );
}

include_once $serverPath.'resources/templates/head.php';?>
<div ng-controller="DungeonController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{dungeon.name}}</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<h4>Purpose</h4>
							<div>{{dungeon.purpose}}</div>
						</div>
						<div class="col-md-12">
							<h4>History</h4>
							<div>{{dungeon.history}}</div>
						</div>
						<div class="col-md-12">
							<h4>Location</h4>
							<div>{{dungeon.location}}</div>
						</div><div class="col-md-12">
							<h4>Creator</h4>
							<div>{{dungeon.creator}}</div>
						</div>
						<div class="col-md-12">
							<h4>Map</h4>
							<div>
								<canvas id="mapDisplay" class="dungeon_map" style="width: 384px; height: 384px;">
									Your browser does not support the HTML5 canvas tag.
								</canvas>
					</div>
						</div>
						
					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a>
						<a ng-href="edit.php?id={{dungeon.id}}" class="btn btn-primary">Edit</a>
						<button ng-click="deletedungeon(dungeon.id, dungeon.name)" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="dungeon" style="display: none;"><?php echo $dungeon?></div>
</div>

<script src="<?php echo $baseURL;?>resources/mapGenerator.js"></script>
<script type="text/javascript">
var dungeon = JSON.parse(document.getElementById("dungeon").textContent);
app.controller("DungeonController", ['$scope', "$http", "$window" , function($scope, $http, $window){
	$scope.dungeon = dungeon;

	$scope.getParsedMap = function(){return JSON.parse($scope.dungeon.map);}
	drawMap($scope.getParsedMap());
	
	$scope.deletedungeon =function(id,name){
		if(window.confirm("Are you sure you want to delete "+name+"?")){
			$http.post('delete.php?id='+id).
				then(function(response){
					$window.location.href ="/aesop/dungeons/";
					}).then(function(response){
						console.log(response);
					});
		}
	}

	
	
		
}]);

</script>
