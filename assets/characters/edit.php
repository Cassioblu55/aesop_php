<?php
include_once '../../config/config.php';
include_once $serverPath.'utils/db_get.php';
include_once $serverPath.'utils/db_post.php';
require_once $serverPath.'utils/generator/character.php';

$table = "character";
if (! empty ( $_POST )) {
		
	if (empty ( $_GET ['id'] )) {
		createCharacter();
		insertFromPost($table);
		$added = true;
	} 

	else {
		createCharacter();
		updateFromPost($table);
		header ( "Location: index.php" );
		die ( "Redirecting to index.php" );
	}
	
} 
include_once $serverPath.'resources/templates/head.php'; ?>

<div ng-controller="CharacterAddEditController">
<form
	action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
	method="post">
	<div class="col-md-6">
		<div
			class="panel <?php if($added){echo "panel-success";} else{echo "panel-default";} ?>">
			<div class="panel-heading">
				<div class="panel-title">{{addOrEdit}} Character</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="first_name">First Name</label> <input type="text"
						class="form-control"  name="first_name"
						ng-model="character.first_name" placeholder="First Name" />
				</div>
				<div class="form-group">
					<label for="last_name">Last Name</label> 
					<input type="text" class="form-control"  name="last_name" ng-model="character.last_name" placeholder="Last Name" />
				</div>
				<div class="form-group">
					<label for="age">Age</label> 
					<input type="number" class="form-control"  name="age" ng-model="character.age" placeholder="Age" />
				</div>

				<div class="form-group">
					<label for="sex">Sex</label> 
					<select class="form-control"  name="sex">
						<option value="">Any</option>
						<option ng-selected="character.sex=='M'" value="M">Male</option>
						<option ng-selected="character.sex=='F'" value="F">Female</option>
						<option ng-selected="character.sex=='O'" value="O">Other</option>
					</select>
				</div>
				
				<div class=" col-sm-6 form-group">
					<label for="feet">Feet</label>
					<input type="number" class="form-control" min="0" name="feet" ng-model="character.feet" placeholder="Feet"/>
				</div>
				<div class=" col-sm-6 form-group">
					<label for="inches">Inches</label>				
					<input type="number" class="form-control" min="0" max="11" name="inches" ng-model="character.inches" placeholder="Inches"/>
				</div>
				
				<div class="form-group">
					<label for="weight">Weight</label>
					<div class="input-group">
						<input type="number" class="form-control"  name="weight" ng-model="character.weight" placeholder="Weight"/>
						<div class="input-group-addon">lbs</div> 
					</div>
				</div>
				<div class="form-group">
					<label for="flaw">Flaw</label>
					<input type="text" class="form-control"  name="flaw" ng-model="character.flaw" placeholder="Flaw"/>
				</div>
				<div class="form-group">
					<label for="interaction">Interaction Trait</label>
					<input type="text" class="form-control"  name="interaction" ng-model="character.interaction" placeholder="Interaction"/>
				</div>
				<div class="form-group">
					<label for="mannerism">Mannerism</label>
					<input type="text" class="form-control"  name="mannerism" ng-model="character.mannerism" placeholder="Mannerism"/>
				</div>
				<div class="form-group">
					<label for="bond">Bond</label>
					<input type="text" class="form-control"  name="bond" ng-model="character.bond" placeholder="Bond"/>
				</div>
				<div class="form-group">
					<label for="appearance">Appearance</label>
					<input type="text" class="form-control"  name="appearance" ng-model="character.appearance" placeholder="Appearance"/>
				</div>
				<div class="form-group">
					<label for="talent">Talent</label>
					<input type="text" class="form-control"  name="talent" ng-model="character.talent" placeholder="Talent"/>
				</div>
				<div class="form-group">
					<label for="ideal">Ideal</label>
					<input type="text" class="form-control"  name="ideal" ng-model="character.ideal" placeholder="Ideal"/>
				</div>
				<div class="form-group">
					<label for="ability">Ability</label>
					<input type="text" class="form-control"  name="ability" ng-model="character.ability" placeholder="Ability"/>
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
					<a class="btn btn-danger" href="index.php">Cancel</a>
				</div>
				<div style='<?php if($added){echo "color:#5cb85c";}else{echo "display:none";}?>'>Added
					Character</div>
			</div>
		</div>
	</div>

</form>
<div id="character" style="display: none"><?php if(!empty($_GET['id'])){echo json_encode(findById($table, $_GET['id']));}?></div>
</div>

<script type="text/javascript">
var characterData =  document.getElementById("character").textContent
if(characterData){var character =JSON.parse(characterData)};
app.controller("CharacterAddEditController", ['$scope', "$http" , function($scope, $http){
	if(character){
		$scope.character = character;
		$scope.character.age = Number($scope.character.age);
		$scope.character.weight = Number($scope.character.weight);
		$scope.character.feet = Math.floor(Number($scope.character.height)/12);
		$scope.character.inches = Math.floor(Number($scope.character.height)%12);
	}
		$scope.addOrEdit = (!character) ? "Add" : "Edit";
		$scope.saveOrUpdate = (!character) ? "Save" : "Update"
	
}]);

</script>


