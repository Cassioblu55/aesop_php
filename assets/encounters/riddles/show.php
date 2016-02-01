<?php
include_once '../../../config/config.php';

include_once $serverPath . 'resources/templates/head.php';

?>
<div ng-controller="RiddleShowController">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">{{riddle.name}}</div>
			</div>
			<div class="panel-body">
				<h4>{{riddle.riddle}}</h4>

				<div class="row">
					<div ng-show="riddle.hint" class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading clearfix">
								<div class="panel-title pull-left">Hint</div>
								<button class="btn btn-primary btn-sm pull-right" type="button"
									ng-click="showHint = !showHint">{{(showHint) ? "Hide" :
									"Show"}}</button>
							</div>
							<div class="panel-body" ng-show="showHint">{{riddle.hint}}</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading clearfix">
								<div class="panel-title pull-left">Solution</div>
								<button class="btn btn-primary btn-sm pull-right" type="button"
									ng-click="showSolution = !showSolution">{{(showSolution) ?
									"Hide" : "Show"}}</button>
							</div>
							<div class="panel-body" ng-show="showSolution">{{riddle.solution}}</div>
						</div>
					</div>

				</div>
				<div class="col-md-12" ng-show="riddle.other_information">
							<h4>Other Information</h4>
							<div class="showDisplay">{{riddle.other_information}}</div>
				</div>
				
			</div>
			<div class="panel-footer">
				<a ng-href="index.php" class="btn btn-info">Show All</a> <a
					ng-href="edit.php?id={{riddle.id}}" class="btn btn-primary">Edit</a>
				<button
					ng-click="deleteById(riddle.id,riddle.name, redirectToIndex)"
					class="btn btn-danger">Delete</button>
			</div>
		</div>
	</div>

</div>



<script>
app.controller("RiddleShowController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	$scope.showHint = false;
	$scope.showSolution = false;
	
	$scope.setRiddle = function(riddle){
		$scope.riddle = riddle;
		}

	$scope.setById($scope.setRiddle);
		
}]);

</script>
