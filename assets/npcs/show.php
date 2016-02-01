<?php
include_once '../../config/config.php';
$table = "npc";
include_once $serverPath.'utils/security/canSee.php';

include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="NCPShowController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{full_name}}</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								Age: <b>{{npc.age}}</b>
							</div>
							<div class="col-md-3">
								Sex: <b>{{displaySex()}}</b>
							</div>
							<div class="col-md-3">
								Weight: <b>{{npc.weight}}</b> lbs.
							</div>
							<div class="col-md-3">
								Height: <b>{{displayHeight()}}</b>
							</div>
						</div>

						<div class="col-md-12">
							<h4>Flaw</h4>
							<div>{{npc.flaw}}</div>
						</div>
						<div class="col-md-12">
							<h4>Interaction Trait</h4>
							<div>{{npc.interaction}}</div>
						</div>
						<div class="col-md-12">
							<h4>Mannerism</h4>
							<div>{{npc.mannerism}}</div>
						</div>
						<div class="col-md-12">
							<h4>Bond</h4>
							<div>{{npc.bond}}</div>
						</div>
						<div class="col-md-12">
							<h4>Appearance</h4>
							<div>{{npc.appearance}}</div>
						</div>
						<div class="col-md-12">
							<h4>Talent</h4>
							<div>{{npc.talent}}</div>
						</div>
						<div class="col-md-12">
							<h4>Ideal</h4>
							<div>{{npc.ideal}}</div>
						</div>
						<div class="col-md-12">
							<h4>Ability</h4>
							<div>{{npc.ability}}</div>
						</div>
						
						<div class="col-md-12" ng-show="npc.other_information">
							<h4>Other Information</h4>
							<div class="showDisplay">{{npc.other_information}}</div>
						</div>
					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a> <a
							ng-href="edit.php?id={{npc.id}}" class="btn btn-primary">Edit</a>
						<button ng-click="deleteWithRedirect(npc.id, full_name)"
							class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
app.controller("NCPShowController", ['$scope',"$http","$controller", function($scope, $http, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setById(function(data){
		$scope.npc = data;
		$scope.full_name = $scope.npc.first_name+" "+$scope.npc.last_name;

		$scope.displaySex = function(){
			var sex = $scope.npc.sex;
			if(sex=="M"){return "Male";}
			else if(sex=="F"){return "Female";}
			else{return "Other";}
		}
	
		$scope.displayHeight = function(){
			var height = $scope.npc.height;
			return Math.floor(height/12)+"' "+Math.floor(height%12)+'"';
		}
	});

		
}]);

</script>
