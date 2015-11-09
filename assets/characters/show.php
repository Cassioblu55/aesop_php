<?php
include_once '../../config/config.php';
include_once $serverPath.'utils/connect.php';

if (! empty ( $_GET ['id'] )) {
	$table = "character";
	
	$character = json_encode ( findById ( $table, $_GET ['id'] ) );
} else {
	header ( "Location: index.php" );
	
	// Remember that this die statement is absolutely critical. Without it,
	// people can view your members-only content without logging in.
	die ( "Redirecting to index" );
}

include_once $serverPath.'resources/templates/head.php'; ?>

<div ng-controller="CharacterController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{full_name}}</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								Age: <b>{{character.age}}</b>
							</div>
							<div class="col-md-3">
								Sex: <b>{{displaySex()}}</b>
							</div>
							<div class="col-md-3">
								Weight: <b>{{character.weight}}</b> lbs.
							</div>
							<div class="col-md-3">
								Height: <b>{{displayHeight()}}</b>
							</div>
						</div>

						<div class="col-md-12">
							<h4>Flaw</h4>
							<div>{{character.flaw}}</div>
						</div>
						<div class="col-md-12">
							<h4>Interaction Trait</h4>
							<div>{{character.interaction}}</div>
						</div>
						<div class="col-md-12">
							<h4>Mannerism</h4>
							<div>{{character.mannerism}}</div>
						</div>
						<div class="col-md-12">
							<h4>Bond</h4>
							<div>{{character.bond}}</div>
						</div>
						<div class="col-md-12">
							<h4>Appearance</h4>
							<div>{{character.appearance}}</div>
						</div>
						<div class="col-md-12">
							<h4>Talent</h4>
							<div>{{character.talent}}</div>
						</div>
						<div class="col-md-12">
							<h4>Ideal</h4>
							<div>{{character.ideal}}</div>
						</div>
						<div class="col-md-12">
							<h4>Ability</h4>
							<div>{{character.ability}}</div>
						</div>
					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a>
						<a ng-href="edit.php?id={{character.id}}" class="btn btn-primary">Edit</a>
						<button ng-click="deleteCharacter(character.id, full_name)" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="character" style="display: none;"><?php echo $character?></div>
</div>

<script type="text/javascript">
var character = JSON.parse(document.getElementById("character").textContent);
app.controller("CharacterController", ['$scope', "$http", "$window" , function($scope, $http, $window){
	$scope.character = character;
	$scope.full_name = $scope.character.first_name+" "+$scope.character.last_name;

	$scope.displaySex = function(){
		var sex = $scope.character.sex;
		if(sex=="M"){return "Male";}
		else if(sex=="F"){return "Female";}
		else{return "Other";}
	}

	$scope.displayHeight = function(){
		var height = $scope.character.height;
		return Math.floor(height/12)+"' "+Math.floor(height%12)+'"';
	}

	$scope.deleteCharacter =function(id,name){
		if(window.confirm("Are you sure you want to delete "+name+"?")){
			$http.post('delete.php?id='+id).
				then(function(response){
					$window.location.href ="/aesop/characters/";
					}).then(function(response){
						console.log(response);
					});
		}
	}
		
}]);

</script>
