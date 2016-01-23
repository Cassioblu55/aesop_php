<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_get.php';
include_once $serverPath . 'utils/db_post.php';
require_once $serverPath . 'utils/generator/settlement.php';

$table = "settlement";
if (! empty ( $_POST )) {
	if (empty ( $_GET ['id'] )) {
		createSettelment ();
		insertFromPost ( $table );
		$added = true;
	} 

	else {
		createSettelment ();
		updateFromPost ( $table );
		header ( "Location: show.php?id=" . $_GET ['id'] );
		die ( "Redirecting to show.php" );
	}
}
include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="settlementAddEditController">
	<form
		action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
		method="post">
		<div class="col-md-6">
			<div
				class="panel <?php if($added){echo "panel-success";} else{echo "panel-default";} ?>">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} Settlement</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="name">Settlement Name</label> <input type="text"
							class="form-control" name="name" ng-model="settlement.name"
							placeholder="Settlement Name" />
					</div>
					<div class="form-group">
						<label for="known_for">Known For</label> <input type="text"
							class="form-control" name="known_for"
							ng-model="settlement.known_for" placeholder="Known For" />
					</div>
					<div class="form-group">
						<label for="notable_traits">Notable Trait</label> <input
							type="text" class="form-control" name="notable_traits"
							ng-model="settlement.notable_traits" placeholder="Notable Trait" />
					</div>
					<div class="form-group">
						<label for="ruler_status">Ruler Status</label> <input type="text"
							class="form-control" name="ruler_status"
							ng-model="settlement.ruler_status" placeholder="Ruler Status" />
					</div>
					<div class="form-group">
						<label for="race_relations">Race Relations</label> <input
							type="text" class="form-control" name="race_relations"
							ng-model="settlement.race_relations" placeholder="Race Relations" />
					</div>
					<div class="form-group">
						<label for="current_calamity">Current Calamity</label> <input
							type="text" class="form-control" name="current_calamity"
							ng-model="settlement.current_calamity"
							placeholder="Current Calamity" />
					</div>
					<div class="form-group">
						<label for="ruler_id">Ruler</label> <select class="form-control"
							name="ruler_id">
							<option value="">Any</option>
							<option ng-repeat="character in characters"
								value={{character.id}}
								ng-selected="settlement.ruler_id == character.id">{{character.name}}</option>
						</select>
					</div>
					<div class="form-group">
						<label for="population">Population</label> <input type="number"
							class="form-control" name="population"
							ng-model="settlement.population" placeholder="Population" />
					</div>
					<div class="form-group">
						<label for="size">Size</label> <select class="form-control"
							name="sex">
							<option value="">Any</option>
							<option ng-selected={{settlement.size== "S"}} value="S">Smalll</option>
							<option ng-selected={{settlement.size== "M"}} value="M">Medium</option>
							<option ng-selected={{settlement.size== "L"}} value="L">Large</option>
						</select>
					</div>

					<div class="form-group">
						<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
						<a class="btn btn-danger" href="index.php">Cancel</a>
					</div>
					<div style='<?php if($added){echo "color:#5cb85c";}else{echo "display:none";}?>'>Added
						Settlement</div>
				</div>
			</div>
		</div>

	</form>
	<div id="settlement" style="display: none"><?php if(!empty($_GET['id'])){echo json_encode(findById($table, $_GET['id']));}?></div>

</div>

<script type="text/javascript">
var settlementData =  document.getElementById("settlement").textContent
if(settlementData){var settlement =JSON.parse(settlementData)};
app.controller("settlementAddEditController", ['$scope', "$http" , function($scope, $http){
	if(settlement){
		$scope.settlement = settlement;
		$scope.settlement.ruler_id = Number($scope.settlement.ruler_id);
		$scope.settlement.age = Number($scope.settlement.age);
		$scope.settlement.population = Number($scope.settlement.population);
		$scope.settlement.weight = Number($scope.settlement.weight);
		$scope.settlement.feet = Math.floor(Number($scope.settlement.height)/12);
		$scope.settlement.inches = Math.floor(Number($scope.settlement.height)%12);
	}
		$scope.addOrEdit = (!settlement) ? "Add" : "Edit";
		$scope.saveOrUpdate = (!settlement) ? "Save" : "Update"

			$scope.getCharacters = function(){
			$http.get('<?php echo $baseURL;?>assets/characters/data.php?column=name').
			then(function(response){
				var characters = response.data
				for(var i=0; i<characters.length; i++){
					var character = characters[i]
					character.name = character.first_name+" "+character.last_name
					character.id = Number(character.id);
				}
				$scope.characters = characters;
			});
		}
		$scope.getCharacters();
	
}]);

</script>


