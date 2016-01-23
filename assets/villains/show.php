<?php
include_once '../../config/config.php';
include_once $serverPath . 'resources/templates/head.php';
?>
<div ng-controller="VillainShowController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{villain.full_name}}</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								Age: <b>{{villain.age}}</b>
							</div>
							<div class="col-md-3">
								Sex: <b>{{villain.sex_display}}</b>
							</div>
							<div class="col-md-3">
								Weight: <b>{{villain.weight}}</b> lbs.
							</div>
							<div class="col-md-3">
								Height: <b>{{villain.display_height}}</b>
							</div>
						</div>
						<div class="col-md-12">
							<h4>Method</h4>
							<div>{{villain.method_type}}: {{villain.method_description}}</div>
						</div>
						<div class="col-md-12">
							<h4>Scheme</h4>
							<div>{{villain.scheme_type}}: {{villain.scheme_description}}</div>
						</div>
						<div class="col-md-12">
							<h4>Weakness</h4>
							<div>{{villain.weakness_type}}: {{villain.weakness_description}}</div>
						</div>
						<div class="col-md-12">
							<h4>Flaw</h4>
							<div>{{villain.flaw}}</div>
						</div>
						<div class="col-md-12">
							<h4>Interaction Trait</h4>
							<div>{{villain.interaction}}</div>
						</div>
						<div class="col-md-12">
							<h4>Mannerism</h4>
							<div>{{villain.mannerism}}</div>
						</div>
						<div class="col-md-12">
							<h4>Bond</h4>
							<div>{{villain.bond}}</div>
						</div>
						<div class="col-md-12">
							<h4>Appearance</h4>
							<div>{{villain.appearance}}</div>
						</div>
						<div class="col-md-12">
							<h4>Talent</h4>
							<div>{{villain.talent}}</div>
						</div>
						<div class="col-md-12">
							<h4>Ideal</h4>
							<div>{{villain.ideal}}</div>
						</div>
						<div class="col-md-12">
							<h4>Ability</h4>
							<div>{{villain.ability}}</div>
						</div>
					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a> <a
							ng-href="edit.php?id={{villain.id}}" class="btn btn-primary">Edit</a>
						<button
							ng-click="deleteWithRedirect(villain.id, villain.full_name)"
							class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
app.controller("VillainShowController", ['$scope', "$controller", function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setVillain = function(villain){
		$scope.villain = villain;
		$scope.villain.age = Number($scope.villain.age);
		$scope.villain.weight = Number($scope.villain.weight);
		$scope.villain.display_height = getHeightDisplay(Number($scope.villain.height));
		$scope.villain.full_name = combine(villain.first_name,villain.last_name);
		$scope.villain.sex_display = displaySex($scope.villain.sex);
	}

	$scope.setById($scope.setVillain);
		
}]);

</script>
