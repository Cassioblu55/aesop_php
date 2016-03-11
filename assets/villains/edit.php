<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/generator/villain.php';

$table = "villain";
function makeVillain(){
	createVillain ();
	$c_table = 'npc';
	if (! empty ( $_GET ['id'] )) {
		$c_data = createDataFromPost ( $c_table );
		$constraints = [
				'id' => $_POST ['npc_id']
		];
		updateWithConstratints ( $c_table, $c_data, $constraints );
	}
	
}
$runOnSave = "makeVillain";
include_once $serverPath.'utils/db/fullTemplates/secureEdit.php';
include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="VillainEditController">
	<form
		action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
		method="post">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} Villain</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="first_name">First Name</label> <input type="text"
								class="form-control" name="first_name"
								ng-model="villain.first_name" placeholder="First Name" />
						</div>
						<div class="col-sm-6 form-group">
							<label for="last_name">Last Name</label> <input type="text"
								class="form-control" name="last_name"
								ng-model="villain.last_name" placeholder="Last Name" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="age">Age</label> <input type="number"
								class="form-control" name="age" ng-model="villain.age"
								placeholder="Age" />
						</div>
						<div class="col-sm-6 form-group">
							<label for="sex">Sex</label> <select class="form-control"
								name="sex">
								<option value="">Any</option>
								<option ng-selected="villain.sex=='M'" value="M">Male</option>
								<option ng-selected="villain.sex=='F'" value="F">Female</option>
								<option ng-selected="villain.sex=='O'" value="O">Other</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class=" col-sm-4 form-group">
							<label for="feet">Feet</label> <input type="number"
								class="form-control" min="0" name="feet" ng-model="villain.feet"
								placeholder="Feet" />
						</div>
						<div class=" col-sm-4 form-group">
							<label for="inches">Inches</label> <input type="number"
								class="form-control" min="0" max="11" name="inches"
								ng-model="villain.inches" placeholder="Inches" />
						</div>
						<div class="col-sm-4 form-group">
							<label for="weight">Weight</label>
							<div class="input-group">
								<input type="number" class="form-control" name="weight"
									ng-model="villain.weight" placeholder="Weight" />
								<div class="input-group-addon">lbs</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="method_type">Method Type</label> <input type="text"
							class="form-control" name="method_type"
							ng-model="villain.method_type" placeholder="Method Type" />
					</div>
					<div class="form-group">
						<label for="method_description">Method Description</label> <input
							type="text" class="form-control" name="method_description"
							ng-model="villain.method_description"
							placeholder="Method Description" />
					</div>
					<div class="form-group">
						<label for="scheme_type">Scheme Type</label> <input type="text"
							class="form-control" name="scheme_type"
							ng-model="villain.scheme_type" placeholder="Scheme Type" />
					</div>
					<div class="form-group">
						<label for="scheme_description">Scheme Description</label> <input
							type="text" class="form-control" name="scheme_description"
							ng-model="villain.scheme_description"
							placeholder="Scheme Description" />
					</div>
					<div class="form-group">
						<label for="weakness_type">Weakness Type</label> <input
							type="text" class="form-control" name="weakness_type"
							ng-model="villain.weakness_type" placeholder="Weakness Type" />
					</div>
					<div class="form-group">
						<label for="weakness_description">Weakness Description</label> <input
							type="text" class="form-control" name="weakness_description"
							ng-model="villain.weakness_description"
							placeholder="Weakness Description" />
					</div>
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="flaw">Flaw</label> <input type="text"
								class="form-control" name="flaw" ng-model="villain.flaw"
								placeholder="Flaw" />
						</div>
						<div class="col-sm-6 form-group">
							<label for="interaction">Interaction Trait</label> <input
								type="text" class="form-control" name="interaction"
								ng-model="villain.interaction" placeholder="Interaction" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="mannerism">Mannerism</label> <input type="text"
								class="form-control" name="mannerism"
								ng-model="villain.mannerism" placeholder="Mannerism" />
						</div>
						<div class="col-sm-6 form-group">
							<label for="bond">Bond</label> <input type="text"
								class="form-control" name="bond" ng-model="villain.bond"
								placeholder="Bond" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="appearance">Appearance</label> <input type="text"
								class="form-control" name="appearance"
								ng-model="villain.appearance" placeholder="Appearance" />
						</div>
						<div class="col-sm-6 form-group">
							<label for="talent">Talent</label> <input type="text"
								class="form-control" name="talent" ng-model="villain.talent"
								placeholder="Talent" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="ideal">Ideal</label> <input type="text"
								class="form-control" name="ideal" ng-model="villain.ideal"
								placeholder="Ideal" />
						</div>
						<div class="col-sm-6 form-group">
							<label for="ability">Ability</label> <input type="text"
								class="form-control" name="ability" ng-model="villain.ability"
								placeholder="Ability" />
						</div>
						
						
					</div>
					<div class="form-group">
						<label for="other_information">Other Information</label>
						<textarea name="other_information" class="form-control" rows="4">{{villain.other_information}}</textarea>
					</div>
					
					<div class="form-group">
							<label for="public">Public or Private</label>
							<select class="form-control" id="public" name="public" ng-model="villain.public">
								<option ng-selected="villain.public=='1'" value="1">Public</option>
								<option  ng-selected="villain.public=='0'" value="0">Private</option>
							</select>
						</div>
					
					<input style="display: none;" name="npc_id"
						ng-model="villain.npc_id"></input>
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
app.controller("VillainEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	var valueToNumberList = ['age','weight'];

	$scope.villain = {};
	
	$scope.setVillain = function(villain){
		$scope.villain = convertValuesToNumbers(villain, valueToNumberList);
		$scope.villain.feet = getFeet(Number($scope.villain.height));
		$scope.villain.inches = getInches(Number($scope.villain.height));
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
	}

	$scope.setById($scope.setVillain, function(){
		$scope.saveOrUpdate = "Save";
		$scope.addOrEdit = "Add";

		$scope.getDefaultAccess(function(n){$scope.villain['public'] = n;});
	});
	
}]);
</script>