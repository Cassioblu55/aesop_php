<?php
	include_once $serverPath.'utils/db_post.php';	
	if(!empty($_POST)){
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

<div ng-controller="encounterEditController">
	<form action="{{::post_to}}" method="post">
		<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">{{addOrEdit}} {{name}} Encounter</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="title">Title</label> 
					<input type="text" class="form-control"  name="title" ng-model="encounter.title" placeholder="Title" />
				</div>
				<div class="form-group">
					<label for="description">Description</label> 
					<textArea type="text" class="form-control" rows="6" name="description" ng-model="encounter.description" placeholder="Description"></textArea>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h3 class="panel-title pull-left">Rolls</h3>
						<button class="btn btn-primary btn-sm pull-right" type="button" data-toggle="modal" data-target="#addRollModal">Add</button>
					</div>
					<div class="panel-body" ng-show="rollValues.length >0">
							<div class="row">
								<div class="col-md-3">
									<label>Amount</label>
								</div>
								<div class="col-md-3">
									<label>Kind</label>
								</div>
								<div class="col-md-3">
									<label>Modifer</label>
								</div>
							</div>
						<div data-ng-repeat="dice in rollValues">
							<div class="row">
								<div class="form-group col-md-3">
									<input type="number" class="form-control" min=0 ng-model="dice.amount">
								</div>
								<div class="form-group col-md-3">
									<input type="number" class="form-control" min=0 ng-model="dice.kind">
								</div>
								<div class="form-group col-md-3">
									<input type="number" class="form-control" min=0 ng-model="dice.modifer">
								</div>
								<div class="form-group col-md-3">
									<button class="btn btn-danger" type="button" ng-click="deleteRoll(dice.id)">Delete</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									Text: {{dice.amount+"d"+dice.kind+"+"+dice.modifer}}
								</div>
								<div class="col-md-3">
									Min: {{dice.amount+dice.modifer}}
								</div>
								<div class="col-md-3">
									Max: {{(dice.amount*dice.kind)+dice.modifer}}
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="text" style="display: none;" name="roll" ng-model="encounter.roll" placeholder="Roll" />
				<div class="form-group">
					<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
					<a class="btn btn-danger" href="index.php">Cancel</a>
				</div>
			</div>
		</div>
	</div>
	</form>

	<!-- Add Roll Modal -->
	<div id="addRollModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Roll</h4>
				</div>
				<div class="modal-body">
					<label>Amount</label>
					<input type="number" class="form-control" min=0 ng-model="newDice.amount">
					<label>Kind</label>
					<input type="number" class="form-control" min=0 ng-model="newDice.kind">
					<label>Modifer</label>
					<input type="number" class="form-control" min=0 ng-model="newDice.modifer">
					<div class='row'>
						<div class="col-md-4" >Text: {{newDice.displayText}}</div>
						<div class="col-md-4" >Mininum: {{newDice.minRoll}}</div>
						<div class="col-md-4" >Maximum: {{newDice.maxRoll}}</div>
					</div>
	      		</div>
	      		<div class="modal-footer">
					<button class="btn btn-primary" ng-click="addRoll(newDice)" type="button" >Add</button>
	       			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo $baseURL;?>resources/roll.js"></script>
<script>
app.controller("encounterEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	$scope.newDice = {};
	$scope.rollValues = [];
	$scope.name = (name || '');
	
	$scope.setEncounter = function(encounter){
		$scope.encounter = encounter;
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
		if($scope.encounter.roll){
			$scope.rollValues = getDiceValues($scope.encounter.roll);
		}
	}

	$scope.$watch('[newDice,newDice.amount,newDice.kind,newDice.modifer]', function(){
		$scope.newDice.displayText = getDiceDisplay($scope.newDice);
		$scope.newDice.minRoll = getDiceMin($scope.newDice);
		$scope.newDice.maxRoll = getDiceMax($scope.newDice);
	}, true);

	$scope.$watch("rollValues", function(){
		if($scope.rollValues){
			if($scope.encounter){
				$scope.encounter.roll = getStringValues($scope.rollValues);
				}
			}
		},true);
	
	$scope.addRoll = function(newDice){
		newDice.id = $.guid++;
		$scope.rollValues.push(newDice);
		$('#addRollModal').modal('hide')
	}

	$scope.deleteRoll = function(id){
		for(var i=0; i<$scope.rollValues.length; i++){
			if($scope.rollValues[i].id == id){
				 $scope.rollValues.splice(i, 1);
				}
		}
	}
	
	$scope.setById($scope.setEncounter);
	$scope.saveOrUpdate = "Save";
	$scope.addOrEdit = "Add";
	
}]);
</script>