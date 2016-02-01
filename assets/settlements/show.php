<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';

if (! empty ( $_GET ['id'] )) {
	$table = "settlement";
	$ruler_table = "npc";
	$s = findById ( $table, $_GET ['id'] );
	$settlement = json_encode ( $s );
	$ruler = json_encode ( findById ( $ruler_table, $s['ruler_id'] ) );
} else {
	header ( "Location: index.php" );
	
	// Remember that this die statement is absolutely critical. Without it,
	// people can view your members-only content without logging in.
	die ( "Redirecting to index" );
}

include_once $serverPath . 'resources/templates/head.php';
?>
<div ng-controller="SettlementController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{settlement.name}}</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								Population: <b>{{settlement.population}}</b>
							</div>
							<div class="col-md-6">
								Size: <b>{{sizeDisplay}}</b>
							</div>
						</div>
						<div class="col-md-12">
							<h4>Known For</h4>
							<div>{{settlement.known_for}}</div>
						</div>
						<div class="col-md-12">
							<h4>Current Calamity</h4>
							<div>{{settlement.current_calamity}}</div>
						</div>
						<div class="col-md-12">
							<h4>Notable Trait</h4>
							<div>{{settlement.notable_traits}}</div>
						</div>
						<div class="col-md-12">
							<h4>Ruler Status</h4>
							<div>
								<a
									ng-href="<?php echo $baseURL;?>assets/npcs/show.php?id={{ruler.id}}">{{ruler.name}}</a>:
								{{settlement.ruler_status}}
							</div>
						</div>
						<div class="col-md-12">
							<h4>Race Relations</h4>
							<div>{{settlement.race_relations}}</div>
						</div>
						
						<div class="col-md-12" ng-show="settlement.other_information">
							<h4>Other Information</h4>
							<div class="showDisplay">{{settlement.other_information}}</div>
						</div>
						
					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a> <a
							ng-href="edit.php?id={{settlement.id}}" class="btn btn-primary">Edit</a>
						<button
							ng-click="deleteSettlement(settlement.id, settlement.name)"
							class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="settlement" style="display: none;"><?php echo $settlement?></div>
	<div id="ruler" style="display: none;"><?php echo $ruler?></div>
</div>

<script type="text/javascript">
var settlement = JSON.parse(document.getElementById("settlement").textContent);
var ruler = JSON.parse(document.getElementById("ruler").textContent);
app.controller("SettlementController", ['$scope', "$http", "$window" , function($scope, $http, $window){
	$scope.settlement = settlement;
	$scope.ruler = ruler;
	$scope.ruler.name = $scope.ruler.first_name +" "+$scope.ruler.last_name; 
	$scope.sizeDisplay = ($scope.settlement.size=="S") ? "Small" : ($scope.settlement.size=="M") ? "Medium" : "Large";
	
	$scope.deleteSettlement =function(id,name){
		if(window.confirm("Are you sure you want to delete "+name+"?")){
			$http.post('delete.php?id='+id).
				then(function(response){
					$window.location.href ="/aesop/settlements/";
					}).then(function(response){
						console.log(response);
					});
		}
	}
		
}]);

</script>
