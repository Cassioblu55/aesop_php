<?php
include_once '../../config/config.php';
include_once $serverPath.'utils/security/requireLogin.php';
include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/npc.php';

$table = "npc";
include_once $serverPath.'utils/security/canSee.php';

if (! empty ( $_POST )) {	
	if (empty ( $_GET ['id'] )) {
		$_POST['owner_id'] = $_SESSION['user']['id'];
		createNpc ();
		$id = insertFromPostWithIdReturn ( $table );
	} 

	else {
		createNpc ();
		updateFromPost ( $table );
		$id = $_GET ['id'];
	}
	header ( "Location: show.php?id=" . $id );
	die ( "Redirecting to show.php" );
}
include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="npcAddEditController">
	<form action="{{action}}" method="post">
		<div class="col-md-6">
			<div class="panel panel-default ?>">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} Non-player Character</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="first_name">First Name</label> <input type="text"
							class="form-control" name="first_name"
							ng-model="npc.first_name" placeholder="First Name" />
					</div>
					<div class="form-group">
						<label for="last_name">Last Name</label> <input type="text"
							class="form-control" name="last_name"
							ng-model="npc.last_name" placeholder="Last Name" />
					</div>
					<div class="form-group">
						<label for="age">Age</label> <input type="number"
							class="form-control" name="age" ng-model="npc.age"
							placeholder="Age" />
					</div>

					<div class="form-group">
						<label for="sex">Sex</label> <select class="form-control"
							name="sex">
							<option value="">Any</option>
							<option ng-selected="npc.sex=='M'" value="M">Male</option>
							<option ng-selected="npc.sex=='F'" value="F">Female</option>
							<option ng-selected="npc.sex=='O'" value="O">Other</option>
						</select>
					</div>

					<div class=" col-sm-6 form-group">
						<label for="feet">Feet</label> <input type="number"
							class="form-control" min="0" name="feet"
							ng-model="npc.feet" placeholder="Feet" />
					</div>
					<div class=" col-sm-6 form-group">
						<label for="inches">Inches</label> <input type="number"
							class="form-control" min="0" max="11" name="inches"
							ng-model="npc.inches" placeholder="Inches" />
					</div>

					<div class="form-group">
						<label for="weight">Weight</label>
						<div class="input-group">
							<input type="number" class="form-control" name="weight"
								ng-model="npc.weight" placeholder="Weight" />
							<div class="input-group-addon">lbs</div>
						</div>
					</div>
					<div class="form-group">
						<label for="flaw">Flaw</label> <input type="text"
							class="form-control" name="flaw" ng-model="npc.flaw"
							placeholder="Flaw" />
					</div>
					<div class="form-group">
						<label for="interaction">Interaction Trait</label> <input
							type="text" class="form-control" name="interaction"
							ng-model="npc.interaction" placeholder="Interaction" />
					</div>
					<div class="form-group">
						<label for="mannerism">Mannerism</label> <input type="text"
							class="form-control" name="mannerism"
							ng-model="npc.mannerism" placeholder="Mannerism" />
					</div>
					<div class="form-group">
						<label for="bond">Bond</label> <input type="text"
							class="form-control" name="bond" ng-model="npc.bond"
							placeholder="Bond" />
					</div>
					<div class="form-group">
						<label for="appearance">Appearance</label> <input type="text"
							class="form-control" name="appearance"
							ng-model="npc.appearance" placeholder="Appearance" />
					</div>
					<div class="form-group">
						<label for="talent">Talent</label> <input type="text"
							class="form-control" name="talent" ng-model="npc.talent"
							placeholder="Talent" />
					</div>
					<div class="form-group">
						<label for="ideal">Ideal</label> <input type="text"
							class="form-control" name="ideal" ng-model="npc.ideal"
							placeholder="Ideal" />
					</div>
					<div class="form-group">
						<label for="ability">Ability</label> <input type="text"
							class="form-control" name="ability" ng-model="npc.ability"
							placeholder="Ability" />
					</div>
					<div class="form-group">
						<label for="other_information">Other Information</label>
						<textarea name="other_information" class="form-control" rows="4">{{npc.other_information}}</textarea>
					</div>
					
					<div class="form-group">
						<label for="public">Public or Private</label>
						<select class="form-control" id="public" name="public" ng-model="npc.public">
							<option ng-selected="npc.public=='1'" value="1">Public</option>
							<option  ng-selected="npc.public=='0'" value="0">Private</option>
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
</div>

<script type="text/javascript">
app.controller("npcAddEditController", ['$scope', "$controller" , function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	
	$scope.npc = {};
	$scope.addOrEdit = "Add";
	$scope.saveOrUpdate = "Save";
	$scope.action = "edit.php"
	$scope.setById(setNPC, function(){
		$scope.getDefaultAccess(function(n){$scope.npc['public'] = n;});
	});

	function setNPC(data){
		$scope.action += "?id="+data.id;
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
		$scope.npc = data;
		$scope.npc.age = Number($scope.npc.age);
		$scope.npc.weight = Number($scope.npc.weight);
		$scope.npc.feet = Math.floor(Number($scope.npc.height)/12);
		$scope.npc.inches = Math.floor(Number($scope.npc.height)%12);	
	}

}]);

</script>


