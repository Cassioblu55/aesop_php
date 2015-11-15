<?php
include_once '../../../config/config.php';
include_once $serverPath.'resources/templates/head.php';
?>
	<div ng-controller="urban_encounterShowController">
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{urban_encounter.title}}</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<h4>Description</h4>
							<div>{{urban_encounter.description}}</div>
						</div>
						
					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a>
						<a ng-href="edit.php?id={{urban_encounter.id}}" class="btn btn-primary">Edit</a>
						<button ng-click="deleteWithRedirect(urban_encounter.id, urban_encounter.full_name)" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

<script>
app.controller("urban_encounterShowController", ['$scope', "$controller", function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setUrban_encounter = function(urban_encounter){
		$scope.urban_encounter = urban_encounter;
	}

	$scope.setById($scope.setUrban_encounter);
		
}]);

</script>
