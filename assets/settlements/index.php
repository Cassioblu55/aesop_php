<?php
include_once '../../config/config.php';
include_once $serverPath.'resources/templates/head.php'; 
?>
<div ng-controller="SettelmentIndexController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title pull-left" style="padding-top: 7.5px;">Settelments</h4>
						<a href="edit.php" class ="btn btn-primary pull-right">Add</a>
					</div>
					<div class="panel-body">
						<div ui-grid="gridModel" external-scopes="$scope"
							style="height: 400px;"></div>
					</div>
					<div class="panel-footer">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
app.controller("SettelmentIndexController", ['$scope', "$http" , function($scope, $http){

	$scope.gridModel = {enableFiltering: true, enableColumnResizing: true, showColumnFooter: true , enableSorting: false, showGridFooter: true, enableRowHeaderSelection: false, rowHeight: 42};
	$scope.gridModel.columnDefs = [	{field: 'show', enableColumnMenu: false, enableFiltering: false, width: 65, cellTemplate: '<a class="btn btn-info" role="button" ng-href="show.php?id={{row.entity.id}}">Show</a>'},
	                           		{field: 'edit', enableColumnMenu: false, enableFiltering: false, width: 53, cellTemplate: '<a class="btn btn-primary" role="button" ng-href="edit.php?id={{row.entity.id}}">Edit</a>'},
	                               	{field: 'name',  enableColumnMenu: false}, {field: 'population', enableColumnMenu: false},{field: 'known_for',  enableColumnMenu: false},
	                           		{field: 'delete', enableColumnMenu: false, enableFiltering: false, width: 67, cellTemplate: '<button class="btn btn-danger" ng-click="grid.appScope.deleteTrait(row.entity.id,row.entity.name);">Delete</button>'}
	                               ];

	
	$scope.reloadGrid = function(){
		$http.get('data.php?column=index').
			then(function(response){
				$scope.gridModel.data = response.data;
				
			});
	}

	$scope.deleteTrait =function(id,name){
		if(window.confirm("Are you sure you want to delete "+name+"?")){
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
