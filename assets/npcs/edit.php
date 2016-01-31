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
		createCharacter ();
		$id = insertFromPostWithIdReturn ( $table );
	} 

	else {
		createCharacter ();
		updateFromPost ( $table );
		$id = $_GET ['id'];
	}
	header ( "Location: show.php?id=" . $id );
	die ( "Redirecting to show.php" );
}
include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="CharacterAddEditController">
	<form action="{{action}}" method="post">
		<div class="col-md-6">
			<div class="panel panel-default ?>">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} Character</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="first_name">First Name</label> <input type="text"
							class="form-control" name="first_name"
							ng-model="character.first_name" placeholder="First Name" />
					</div>
					<div class="form-group">
						<label for="last_name">Last Name</label> <input type="text"
							class="form-control" name="last_name"
							ng-model="character.last_name" placeholder="Last Name" />
					</div>
					<div class="form-group">
						<label for="age">Age</label> <input type="number"
							class="form-control" name="age" ng-model="character.age"
							placeholder="Age" />
					</div>

					<div class="form-group">
						<label for="sex">Sex</label> <select class="form-control"
							name="sex">
							<option value="">Any</option>
							<option ng-selected="character.sex=='M'" value="M">Male</option>
							<option ng-selected="character.sex=='F'" value="F">Female</option>
							<option ng-selected="character.sex=='O'" value="O">Other</option>
						</select>
					</div>

					<div class=" col-sm-6 form-group">
						<label for="feet">Feet</label> <input type="number"
							class="form-control" min="0" name="feet"
							ng-model="character.feet" placeholder="Feet" />
					</div>
					<div class=" col-sm-6 form-group">
						<label for="inches">Inches</label> <input type="number"
							class="form-control" min="0" max="11" name="inches"
							ng-model="character.inches" placeholder="Inches" />
					</div>

					<div class="form-group">
						<label for="weight">Weight</label>
						<div class="input-group">
							<input type="number" class="form-control" name="weight"
								ng-model="character.weight" placeholder="Weight" />
							<div class="input-group-addon">lbs</div>
						</div>
					</div>
					<div class="form-group">
						<label for="flaw">Flaw</label> <input type="text"
							class="form-control" name="flaw" ng-model="character.flaw"
							placeholder="Flaw" />
					</div>
					<div class="form-group">
						<label for="interaction">Interaction Trait</label> <input
							type="text" class="form-control" name="interaction"
							ng-model="character.interaction" placeholder="Interaction" />
					</div>
					<div class="form-group">
						<label for="mannerism">Mannerism</label> <input type="text"
							class="form-control" name="mannerism"
							ng-model="character.mannerism" placeholder="Mannerism" />
					</div>
					<div class="form-group">
						<label for="bond">Bond</label> <input type="text"
							class="form-control" name="bond" ng-model="character.bond"
							placeholder="Bond" />
					</div>
					<div class="form-group">
						<label for="appearance">Appearance</label> <input type="text"
							class="form-control" name="appearance"
							ng-model="character.appearance" placeholder="Appearance" />
					</div>
					<div class="form-group">
						<label for="talent">Talent</label> <input type="text"
							class="form-control" name="talent" ng-model="character.talent"
							placeholder="Talent" />
					</div>
					<div class="form-group">
						<label for="ideal">Ideal</label> <input type="text"
							class="form-control" name="ideal" ng-model="character.ideal"
							placeholder="Ideal" />
					</div>
					<div class="form-group">
						<label for="ability">Ability</label> <input type="text"
							class="form-control" name="ability" ng-model="character.ability"
							placeholder="Ability" />
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
app.controller("CharacterAddEditController", ['$scope', "$http" , function($scope, $http){
	var id = getID();
	$scope.action = "edit.php"
	if(id){
		$scope.action += "?id="+id;
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
		$http.get('data.php?id='+id).
			then(function(response){
				$scope.character = response.data;
				$scope.character.age = Number($scope.character.age);
				$scope.character.weight = Number($scope.character.weight);
				$scope.character.feet = Math.floor(Number($scope.character.height)/12);
				$scope.character.inches = Math.floor(Number($scope.character.height)%12);
				
			});
	}else{
		$scope.addOrEdit = "Add";
		$scope.saveOrUpdate = "Save";
			
		
	}

}]);

</script>


