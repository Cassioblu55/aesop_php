<?php 
	include_once '../../../config/config.php';
	include_once $serverPath.'utils/db_post.php';	
	
	if(!empty($_POST)){
		$table = "forest_encounters";
		if(!empty($_GET['id'])){
			$id = $_GET['id'];
			updateFromPost($table);
		}
		else{
			$id = insertFromPostWithIdReturn($table);
		}
			header ( "Location: show.php?id=".$id);
			die ( "Redirecting to show.php" );
	}
	
	include_once $serverPath.'resources/templates/head.php';
?>

<div ng-controller="urban_encounterEditController">
	<form action="{{::post_to}}" method="post">
		<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">{{addOrEdit}} Urban encounter</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12 form-group">
						<label for="title">Title</label> <input type="text"
							class="form-control"  name="title"
							ng-model="urban_encounter.title" placeholder="Title" />
					</div>
					<div class="col-sm-12 form-group">
						<label for="description">Description</label> 
						<textArea type="text" class="form-control"  name="description" ng-model="urban_encounter.description" placeholder="Description"></textArea>
					</div>
					<div>
						<div class="col-sm-12 form-group">
						<label for="roll">Roll</label> 
						<input type="text" class="form-control" name="roll" ng-model="urban_encounter.roll" placeholder="Roll" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
					<a class="btn btn-danger" href="index.php">Cancel</a>
				</div>
			</div>
		</div>
	</div>
	</form>

</div>
<script>
app.controller("urban_encounterEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setUrban_encounter = function(urban_encounter){
		$scope.urban_encounter = urban_encounter;
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
	}

	$scope.setById($scope.setUrban_encounter);
	$scope.saveOrUpdate = "Save";
	$scope.addOrEdit = "Add";
	
}]);
</script>