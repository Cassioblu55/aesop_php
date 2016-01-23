<?php
include_once '../../../config/config.php';
include_once $serverPath . 'resources/templates/head.php';
?>
<div ng-controller="SettlementTraitsIndexController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
				<div class="panel panel-default">
					<a class="btn btn-primary" href="edit.php">Add</a>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3>Settlement Traits</h3>
						</div>
						<div class="panel-body">
							<div ui-grid="gridModel" external-scopes="$scope"
								style="height: 400px;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
app.controller("SettlementTraitsIndexController", ['$scope', "$http" , function($scope, $http){

	$scope.gridModel = {enableFiltering: true, enableColumnResizing: true, showColumnFooter: true , enableSorting: false, showGridFooter: true, enableRowHeaderSelection: false, rowHeight: 42};
	$scope.gridModel.columnDefs = [	{field: 'edit', enableColumnMenu: false, enableFiltering: false, width: 53, cellTemplate: '<a class="btn btn-primary" role="button" ng-href="edit.php?id={{row.entity.id}}">Edit</a>'},
	                               	{field: 'trait',  enableColumnMenu: false}, {field: 'type', enableColumnMenu: false},
	                           		{field: 'delete', enableColumnMenu: false, enableFiltering: false, width: 67, cellTemplate: '<button class="btn btn-danger" ng-click="grid.appScope.deleteTrait(row.entity.id,row.entity.trait);">Delete</button>'}
	                               ];

	$scope.reloadGrid = function(){
		$http.get('data.php').
			then(function(response){
				$scope.gridModel.data = response.data;
				
			});
	}

	$scope.deleteTrait =function(id,trait){
		if(window.confirm("Are you sure you want to delete "+trait+"?")){
			$http.post('delete.php?id='+id).
				then(function(response){
					$scope.reloadGrid();
					}).then(function(response){
						console.log(response);
					});
		}
	}
	
	$scope.reloadGrid();
	
}]);
</script>