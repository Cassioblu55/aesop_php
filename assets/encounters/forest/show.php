<?php
include_once '../../../config/config.php';
include_once $serverPath.'resources/templates/head.php';
?>
	<div ng-controller="ForestEncounterShowController">
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{forest_encounter.title}}</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<h4>Description</h4>
							<div>{{forest_encounter.description}}</div>
						</div>
						
					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a>
						<a ng-href="edit.php?id={{forest_encounter.id}}" class="btn btn-primary">Edit</a>
						<button ng-click="deleteWithRedirect(forest_encounter.id, forest_encounter.full_name)" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

<script src="<?php echo $baseURL;?>resources/roll.js"></script>
<script>
app.controller("ForestEncounterShowController", ['$scope', "$controller", function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setForestEncounter = function(forest_encounter){
		$scope.forest_encounter = forest_encounter;
		$scope.forest_encounter.description = getRolls($scope.forest_encounter.description, $scope.forest_encounter.roll);
		
	}

	$scope.setById($scope.setForestEncounter);
		
}]);

</script>
