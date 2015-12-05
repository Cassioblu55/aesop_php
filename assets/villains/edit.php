<?php 
	include_once '../../config/config.php';
	include_once $serverPath.'utils/db_post.php';
	include_once $serverPath.'utils/generator/villain.php';
	
	if(!empty($_POST)){
		$table = "villain";
		$c_table = 'character';
		createVillain();
		
		//If updating existing villain
		if(!empty($_GET['id'])){
			$id = $_GET['id'];
			$c_data = createDataFromPost($c_table);
			$constraints =  ['id' => $_POST['character_id']];
			updateWithConstratints($c_table, $c_data, $constraints);
			updateFromPost($table);
		}
		//Create new villain
		else{
			//Will insert new villain and return the id of the one created 
			$id = insertFromPostWithIdReturn($table);
		}
		//Redirect to show.php
		header ( "Location: show.php?id=".$id);
		die ( "Redirecting to show.php" );
	}
	
	include_once $serverPath.'resources/templates/head.php';
?>

<div ng-controller="VillianEditController">
	<form action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>" method="post">
		<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">{{addOrEdit}} Villian</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="first_name">First Name</label> <input type="text"
							class="form-control"  name="first_name"
							ng-model="villian.first_name" placeholder="First Name" />
					</div>
					<div class="col-sm-6 form-group">
						<label for="last_name">Last Name</label> 
						<input type="text" class="form-control"  name="last_name" ng-model="villian.last_name" placeholder="Last Name" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="age">Age</label> 
						<input type="number" class="form-control"  name="age" ng-model="villian.age" placeholder="Age" />
					</div>
					<div class="col-sm-6 form-group">
						<label for="sex">Sex</label> 
						<select class="form-control"  name="sex">
							<option value="">Any</option>
							<option ng-selected="villian.sex=='M'" value="M">Male</option>
							<option ng-selected="villian.sex=='F'" value="F">Female</option>
							<option ng-selected="villian.sex=='O'" value="O">Other</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class=" col-sm-4 form-group">
						<label for="feet">Feet</label>
						<input type="number" class="form-control" min="0" name="feet" ng-model="villian.feet" placeholder="Feet"/>
					</div>
					<div class=" col-sm-4 form-group">
						<label for="inches">Inches</label>				
						<input type="number" class="form-control" min="0" max="11" name="inches" ng-model="villian.inches" placeholder="Inches"/>
					</div>
					<div class="col-sm-4 form-group">
						<label for="weight">Weight</label>
						<div class="input-group">
							<input type="number" class="form-control"  name="weight" ng-model="villian.weight" placeholder="Weight"/>
							<div class="input-group-addon">lbs</div> 
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="method_type">Method Type</label>
					<input type="text" class="form-control"  name="method_type" ng-model="villian.method_type" placeholder="Method Type"/>
				</div>
				<div class="form-group">
					<label for="method_description">Method Description</label>
					<input type="text" class="form-control"  name="method_description" ng-model="villian.method_description" placeholder="Method Description"/>
				</div>
				<div class="form-group">
					<label for="scheme_type">Scheme Type</label>
					<input type="text" class="form-control"  name="scheme_type" ng-model="villian.scheme_type" placeholder="Scheme Type"/>
				</div>
				<div class="form-group">
					<label for="scheme_description">Scheme Description</label>
					<input type="text" class="form-control"  name="scheme_description" ng-model="villian.scheme_description" placeholder="Scheme Description"/>
				</div>
				<div class="form-group">
					<label for="weakness_type">Weakness Type</label>
					<input type="text" class="form-control"  name="weakness_type" ng-model="villian.weakness_type" placeholder="Weakness Type"/>
				</div>
				<div class="form-group">
					<label for="weakness_description">Weakness Description</label>
					<input type="text" class="form-control"  name="weakness_description" ng-model="villian.weakness_description" placeholder="Weakness Description"/>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="flaw">Flaw</label>
						<input type="text" class="form-control"  name="flaw" ng-model="villian.flaw" placeholder="Flaw"/>
					</div>
					<div class="col-sm-6 form-group">
						<label for="interaction">Interaction Trait</label>
						<input type="text" class="form-control"  name="interaction" ng-model="villian.interaction" placeholder="Interaction"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="mannerism">Mannerism</label>
						<input type="text" class="form-control"  name="mannerism" ng-model="villian.mannerism" placeholder="Mannerism"/>
					</div>
					<div class="col-sm-6 form-group">
						<label for="bond">Bond</label>
						<input type="text" class="form-control"  name="bond" ng-model="villian.bond" placeholder="Bond"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="appearance">Appearance</label>
						<input type="text" class="form-control"  name="appearance" ng-model="villian.appearance" placeholder="Appearance"/>
					</div>
					<div class="col-sm-6 form-group">
						<label for="talent">Talent</label>
						<input type="text" class="form-control"  name="talent" ng-model="villian.talent" placeholder="Talent"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="ideal">Ideal</label>
						<input type="text" class="form-control"  name="ideal" ng-model="villian.ideal" placeholder="Ideal"/>
					</div>
					<div class="col-sm-6 form-group">
						<label for="ability">Ability</label>
						<input type="text" class="form-control"  name="ability" ng-model="villian.ability" placeholder="Ability"/>
					</div>
				</div>
				<input style="display: none;" name="character_id" ng-model="villian.character_id"></input>
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
app.controller("VillianEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setVillain = function(villain){
		$scope.villian = villain;
		$scope.villian.age = Number($scope.villian.age);
		$scope.villian.weight = Number($scope.villian.weight);
		$scope.villian.feet = getFeet(Number($scope.villian.height));
		$scope.villian.inches = getInches(Number($scope.villian.height));
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
	}

	$scope.setById($scope.setVillain);
	$scope.saveOrUpdate = "Save";
	$scope.addOrEdit = "Add";
	
}]);
</script>