<?php
include_once '../../config/config.php';
include_once $serverPath . 'resources/templates/head.php';
?>
<div ng-controller="TrapShowController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{trap.name}}</h3>
					</div>
					<div class="panel-body">{{trap.description}}</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a> <a
							ng-href="edit.php?id={{trap.id}}" class="btn btn-primary">Edit</a>
						<button ng-click="deleteWithRedirect(trap.id, trap.name)"
							class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo $baseURL;?>resources/roll.js"></script>
<script>
app.controller("TrapShowController", ['$scope', "$controller", function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setTrap = function(trap){
		$scope.trap = trap;
		$scope.trap.description = getRolls($scope.trap.description, $scope.trap.rolls);
	}

	$scope.setById($scope.setTrap);
		
}]);

</script>
