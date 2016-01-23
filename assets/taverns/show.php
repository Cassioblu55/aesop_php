<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_get.php';

if (! empty ( $_GET ['id'] )) {
	$table = "tavern";
	$owner_table = "character";
	$s = findById ( $table, $_GET ['id'] );
	$tavern = json_encode ( $s );
	$owner = json_encode ( findById ( $owner_table, $s ['owner_id'] ) );
} else {
	header ( "Location: index.php" );
	
	// Remember that this die statement is absolutely critical. Without it,
	// people can view your members-only content without logging in.
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
								<a
									ng-href="<?php echo $baseURL;?>assets/characters/show.php?id={{owner.id}}">{{owner.name}}
							
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
	<div id="owner" style="display: none;"><?php echo $owner?></div>
</div>

<script type="text/javascript">
var tavern = JSON.parse(document.getElementById("tavern").textContent);
var owner = JSON.parse(document.getElementById("owner").textContent);
app.controller("tavernController", ['$scope', "$http", "$window" , function($scope, $http, $window){
	$scope.tavern = tavern;
	$scope.owner = owner;
	$scope.owner.name = $scope.owner.first_name +" "+$scope.owner.last_name; 
	
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
