<?php
include_once $serverPath . 'utils/db/db_post.php';
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

<div ng-controller="encounterEditController">
	<form
		action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
		method="post">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} {{name}} Encounter</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="title">Title</label> <input type="text"
							class="form-control" name="title" ng-model="encounter.title"
							placeholder="Title" />
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textArea type="text" class="form-control" rows="6"
							name="description" ng-model="encounter.description"
							placeholder="Description"></textArea>
					</div>
				<?php include_once $serverPath.'resources/templates/rolls/roll_display_panel.php';?>
				<input type="text" style="display: none;" name="roll"
						ng-model="encounter.roll" />
					<div class="form-group">
						<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
						<a class="btn btn-danger" href="index.php">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</form>
	<?php include_once $serverPath.'resources/templates/rolls/roll_modal.php';?>
</div>
<script src="<?php echo $baseURL;?>resources/roll.js"></script>
<script>
app.controller("encounterEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	angular.extend(this, $controller('rollDisplayController', {$scope: $scope}));

	$scope.name = (name || '');
	
	$scope.setEncounter = function(encounter){
		$scope.encounter = encounter;
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
		if($scope.encounter.roll){
			$scope.rollValues = getDiceValues($scope.encounter.roll);
		}
	}

	$scope.$watch("rollValues", function(){
		if($scope.rollValues){
			if($scope.encounter){
				$scope.encounter.roll = getStringValues($scope.rollValues);
				}
			}
		},true);
	
	$scope.setById($scope.setEncounter);
	$scope.saveOrUpdate = "Save";
	$scope.addOrEdit = "Add";
	
}]);
</script>