<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';

if (! empty ( $_GET ['id'] )) {
	$table = "tavern";
	$owner_table = "npc";
	$s = findById ( $table, $_GET ['id'] );
	$tavern = json_encode ( $s );
	$tavern_owner = json_encode ( findById ( $owner_table, $s ['tavern_owner_id'] ) );
} else {
	header ( "Location: index.php" );
	die ( "Redirecting to index" );
}

include_once $serverPath . 'resources/templates/head.php';
?>
<div ng-controller="tavernController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>{{tavern.name}}</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<h4>Type</h4>
							<div>{{tavern.type}}</div>
						</div>
						<div class="col-md-12">
							<h4>Owner</h4>
							<div>
								<a ng-href="<?php echo $baseURL;?>assets/npcs/show.php?id={{tavern_owner.id}}">{{tavern_owner.name}}</a>
							
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<a ng-href="index.php" class="btn btn-info">Show All</a> <a
							ng-href="edit.php?id={{tavern.id}}" class="btn btn-primary">Edit</a>
						<button ng-click="deletetavern(tavern.id, tavern.name)"
							class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="tavern" style="display: none;"><?php echo $tavern?></div>
	<div id="tavern_owner" style="display: none;"><?php echo $tavern_owner?></div>
</div>

<script type="text/javascript">
var tavern = JSON.parse(document.getElementById("tavern").textContent);
var tavern_owner = JSON.parse(document.getElementById("tavern_owner").textContent);
app.controller("tavernController", ['$scope', "$http", "$window" , function($scope, $http, $window){
	$scope.tavern = tavern;
	$scope.tavern_owner = tavern_owner;
	$scope.tavern_owner.name = $scope.tavern_owner.first_name +" "+$scope.tavern_owner.last_name; 
	
	$scope.deletetavern =function(id,name){
		if(window.confirm("Are you sure you want to delete "+name+"?")){
			$http.post('delete.php?id='+id).
				then(function(response){
					$window.location.href ="/aesop/taverns/";
					}).then(function(response){
						console.log(response);
					});
		}
	}
		
}]);

</script>
