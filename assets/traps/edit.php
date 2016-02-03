<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_post.php';

if (! empty ( $_POST )) {
	$table = "traps";
	$data = [ 
			"name" => $_POST ['name'],
			"description" => $_POST ['description'],
			"weight" => $_POST ['weight'],
			"rolls" => $_POST ['rolls'] 
	];
	// If updating existing trap
	if (! empty ( $_GET ['id'] )) {
		$id = $_GET ['id'];
		update ( $table, $data );
	} 	// Create new trap
	else {
		// Will insert new trap and return the id of the one created
		$id = insertAndReturnId ( $table, $data );
	}
	// Redirect to show.php
	header ( "Location: show.php?id=" . $id );
	die ( "Redirecting to show.php" );
}

include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="TrapEditController">
	<form action method="post">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} Trap</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Name</label> <input type="text" class="form-control"
							required="required" name="name" ng-model="trap.name"
							placeholder="Name" />
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textArea type="text" class="form-control" rows="6"
							name="description" ng-model="trap.description"
							placeholder="Description"></textArea>
					</div>
				<?php include_once $serverPath.'resources/templates/rolls/roll_display_panel.php';?>
				<input type="text" style="display: none;" name="rolls"
						ng-model="trap.rolls" />
					<div class="form-group">
						<label>Weight</label> <input type="number"
							form-control" class="form-control" name="weight"
							ng-model="trap.weight" placeholder="Weight" />
						<p class="help-block">Will determine how often trap will appear
							randomly when making dungons</p>
					</div>
					
					<div class="form-group">
							<label for="public">Public or Private</label>
							<select class="form-control" id="public" name="public" ng-model="trap.public">
								<option ng-selected="trap.public=='1'" value="1">Public</option>
								<option  ng-selected="trap.public=='0'" value="0">Private</option>
							</select>
						</div>
					
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
app.controller("TrapEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	angular.extend(this, $controller('rollDisplayController', {$scope: $scope}));

	$scope.trap = {};
	
	$scope.setTrap = function(trap){
		$scope.trap = trap;
		$scope.trap.weight = Number($scope.trap.weight);
		if($scope.trap.rolls){
			$scope.rollValues = getDiceValues($scope.trap.rolls);
		}
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
	}

	$scope.$watch("rollValues", function(){
		if($scope.rollValues){
			if($scope.trap){
				$scope.trap.rolls = getStringValues($scope.rollValues);
				}
			}
		},true);

	$scope.setById($scope.setTrap, function(){
		$scope.saveOrUpdate = "Save";
		$scope.addOrEdit = "Add";

		$scope.getDefaultAccess(function(n){$scope.trap['public'] = n;});
	});
	
}]);
</script>