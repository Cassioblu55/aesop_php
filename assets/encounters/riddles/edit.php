<?php
include_once '../../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';
include_once $serverPath . 'utils/db/db_post.php';

$table = "riddles";

if (! empty ( $_POST )) {
	if (! empty ( $_GET ['id'] )) {
		$id = $_GET ['id'];
		updateFromPost ( $table );
	} else {
		$id = insertFromPostWithIdReturn ( $table );
	}
	
	header ( "Location: show.php?id=" . $id );
	die ( "Redirecting to show.php" );
}

include_once $serverPath . 'resources/templates/head.php';
?>
<div ng-controller="RiddleEditController">
	<form
		action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
		method="post">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} Riddle</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="name">Name</label> <input type="text"
							class="form-control" name="name" ng-model="riddle.name"
							placeholder="Name" />
					</div>
					<div class="form-group">
						<label for="riddle">Riddle</label>
						<textarea type="text" class="form-control" rows="4" name="riddle"
							ng-model="riddle.riddle" placeholder="Riddle"></textarea>
					</div>
					<div class="form-group">
						<label for="solution">Solution</label>
						<textarea type="text" class="form-control" rows="4"
							name="solution" ng-model="riddle.solution" placeholder="Solution"></textarea>
					</div>
					<div class="form-group">
						<label for="hint">Hint</label>
						<textarea type="text" class="form-control" rows="4" name="hint"
							ng-model="riddle.hint" placeholder="Hint"></textarea>
					</div>
					
					<div class="form-group">
						<label for="other_information">Other Information</label>
						<textarea name="other_information" class="form-control" rows="4">{{riddle.other_information}}</textarea>
					</div>
					
<!-- 					<div class="form-group"> -->
<!-- 						<label for="weight">Weight</label> <input type="number" -->
<!-- 							class="form-control" name="weight" ng-model="riddle.weight" -->
<!-- 							placeholder="Weight" /> -->
<!-- 					</div> -->
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
app.controller("RiddleEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setRiddle = function(riddle){
		$scope.riddle = riddle;
		$scope.riddle.weight = Number($scope.riddle.weight);
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
		}

	$scope.setById($scope.setRiddle);
	$scope.saveOrUpdate = "Save";
	$scope.addOrEdit = "Add";
	
}]);

</script>