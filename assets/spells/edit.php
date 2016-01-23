<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_post.php';

$table = "spell";
if (! empty ( $_POST )) {
	if (empty ( $_GET ['id'] )) {
		$id = insertFromPostWithIdReturn ( $table );
	}

	else {
		updateFromPost ( $table );
		$id = $_GET ['id'];
	}
	header ( "Location: edit.php");
	die ( "Redirecting to edit.php" );
}

include_once $serverPath.'resources/templates/head.php';
?>
<div class="container-fluid" ng-controller="SpellEditController">
	<form action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>" method="post">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} {{spell.name || 'Spell'}}</div>
				</div>
				<div class="panel-body">
					<!-- name -->
					<div class="form-group">
						<label for="name">Name</label>
						<input class="form-control" name="name" ng-model="spell.name"  id='name' type="text" required="required" placeholder="Name"/>
					</div>
					<!-- name ends -->
					<!-- class level -->
					<div class="row">
						<!-- class -->
						<div class="col-md-6 form-group">
							<label for="class">Class</label>
							<select class="form-control" required="required" name="class" ng-model="spell.class">
								<option value=''>Select One</option>
								<option ng-repeat="class in classes">{{class}}</option>
							</select>
						</div>
						<!-- class ends -->
						<!-- level -->
						<div class="col-md-6 form-group">
							<label for="level">Level</label>
							<select class="form-control" required="required" name="level" ng-model="spell.level">
								<option value=''>Select One</option>
								<option ng-repeat="level in levels">{{level}}</option>
							</select>
						</div>
						<!-- level ends -->
					</div>
					<!-- class level ends-->
					
					<!-- Casting Time, Range -->
					<div class="row">
						<!-- Casting Time -->
						<div class="col-md-6  form-group">
							<label for="casting_time">Casting Time</label>
							<input type="text" class="form-control" name='casting_time' id ="casting_time" ng-model="spell.casting_time" placeholder="Casting Time" />
							
						</div>
						<!-- Casting Time ends-->
						<!-- Range -->
						<div class="col-md-6  form-group">
							<label for="range">Range</label>
							<div class="input-group">
								<input type="number" id="range" class="form-control" name="range" ng-model="spell.range" placeholder="Range" /> 
								<span class="input-group-addon">ft</span>
							</div>
						
						</div>
						<!-- Range ends-->
					</div>
					
					<!-- Casting Time, Range ends-->
					
					<!--Components Duration -->
					<div class="row">
						<!-- Components -->
						<div class="col-md-6  form-group">
								<label for="components">Components</label>
								<input type="text" class="form-control" name='components' id ="components" ng-model="spell.components" placeholder="Components" />
						</div>
						<!-- Components ends-->
						<!-- Components -->
						<div class="col-md-6 form-group">
								<label for="duration">Duration</label>
								<input type="text" class="form-control" name='duration' id ="duration" ng-model="spell.duration" placeholder="Duration" />
						</div>
						<!-- Duration ends-->
					</div>
					<!--Components Duration ends-->
					
					<!-- description -->
					<div class="row">
						<div class="col-md-12 form-group">
							<label for="description">Description</label>
							<textarea id="description" rows="5" name="description" class="form-control" ng-model="spell.description">{{spell.description}}</textarea>
						</div>
					
					</div>
					
					<!-- description ends  -->
					
					
				</div>
				<div class="panel-footer">
					<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
					<a href="index.php" class="btn btn-danger">Cancel</a>
				</div>
				
			</div>
		</div>
	</form>
</div>


<script> 

app.controller("SpellEditController", ['$scope', "$controller", function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	$scope.saveOrUpdate = "Save";
	$scope.addOrEdit = "Add";

	$scope.classes = ['Fighter', 'Rouge', 'Ranger', 'Paladin', 'Bard', 'Monk', 'Warlock', 'Sorcerer', 'Cleric', 'Druid', 'Barbarian','Wizard'];
	$scope.levels = ["Cantrip (0th)", "1st", '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th'];

	
	$scope.setById(function(data){
		$scope.spell = data;
		$scope.spell.range = Number($scope.spell.range);
		
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
	});

	
}]);
</script>