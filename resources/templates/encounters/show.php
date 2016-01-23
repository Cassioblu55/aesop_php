<?php
include_once $serverPath . 'resources/templates/head.php';
?>
<div ng-controller="encounterShowController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{encounter.title}}</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<h4>Description</h4>
							<div>{{encounter.description}}</div>
						</div>

					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a> <a
							ng-href="edit.php?id={{encounter.id}}" class="btn btn-primary">Edit</a>
						<button
							ng-click="deleteWithRedirect(encounter.id, encounter.title)"
							class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo $baseURL;?>resources/roll.js"></script>
<script>
app.controller("encounterShowController", ['$scope', "$controller", function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setEncounter = function(encounter){
		$scope.encounter = encounter;
		$scope.encounter.description = getRolls($scope.encounter.description, $scope.encounter.roll);
	}

	$scope.setById($scope.setEncounter);
		
}]);

</script>