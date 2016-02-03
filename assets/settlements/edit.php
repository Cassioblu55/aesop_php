<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/settlement.php';

$table = "settlement";
if (! empty ( $_POST )) {
	if (empty ( $_GET ['id'] )) {
		createSettelment ();
		$id = insertFromPostWithIdReturn( $table );
		$added = true;
	} 

	else {
		createSettelment ();
		$id = $_GET ['id'];
		updateFromPost ( $table );
	}
		header ( "Location: show.php?id=$id" );
		die ( "Redirecting to show.php" );
}
include_once $serverPath . 'resources/templates/head.php';
?>

<script type="text/javascript">
app.controller("settlementAddEditController", ['$scope', "$controller" , function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	$scope.settlement = {};
	
	$scope.setById(setSettlement, function(){
		$scope.getDefaultAccess(function(n){$scope.settlement['public'] = n;});
		$scope.addOrEdit =  "Add";
		$scope.saveOrUpdate = "Save";
	});

	function setSettlement(data){
		$scope.settlement = data;		
		$scope.settlement.age = Number($scope.settlement.age);
		$scope.settlement.population = Number($scope.settlement.population);
		$scope.settlement.weight = Number($scope.settlement.weight);
		$scope.settlement.feet = Math.floor(Number($scope.settlement.height)/12);
		$scope.settlement.inches = Math.floor(Number($scope.settlement.height)%12);
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update"
	}

	$scope.setFromGet('<?php echo $baseURL;?>assets/npcs/data.php?column=name', function(data){
		$scope.npcs = data;
		angular.forEach($scope.npcs, function(npc){
			npc.name = npc.first_name+" "+npc.last_name
		});
		
	});
	
}]);

</script>

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
						<label for="ruler_id">Ruler</label>
						<select class="form-control" name="ruler_id" ng-model="settlement.ruler_id">
							<option value="">Any</option>
							<option ng-repeat="npc in npcs" value="{{npc.id}}" ng-selected="settlement.ruler_id == npc.id">{{npc.name}}</option>
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
							<option ng-selected="settlement.size== 'S'" value="S">Smalll</option>
							<option ng-selected="settlement.size== 'M'" value="M">Medium</option>
							<option ng-selected="settlement.size== 'L'" value="L">Large</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="other_information">Other Information</label>
						<textarea name="other_information" class="form-control" rows="4">{{settlement.other_information}}</textarea>
					</div>
					
					<!-- public private -->
					<div class="form-group">
						<label for="public">Public or Private</label>
						<select class="form-control" id="public" name="public" ng-model="settlement.public">
							<option ng-selected="settlement.public=='1'" value="1">Public</option>
							<option  ng-selected="settlement.public=='0'" value="0">Private</option>
						</select>
					</div>
					<!-- public private ends-->

					<div class="form-group">
						<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
						<a class="btn btn-danger" href="index.php">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>