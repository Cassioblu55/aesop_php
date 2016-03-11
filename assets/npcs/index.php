<?php
include_once '../../config/config.php';
include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="CharacterIndexController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title pull-left" style="padding-top: 7.5px;">{{data | capitalize}} Characters</h4>
						<a href="edit.php" class="btn btn-primary pull-right">Add</a>
					</div>
					<div class="panel-body">
						<div ui-grid="gridModel" external-scopes="$scope"
							style="height: 400px;"></div>
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
app.controller("CharacterIndexController", ['$scope', "$controller", function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	
	$scope.gridModel = {enableFiltering: true, enableColumnResizing: true, showColumnFooter: true , enableSorting: false, showGridFooter: true, enableRowHeaderSelection: false, rowHeight: 42};
	$scope.gridModel.columnDefs = [	{field: 'show', enableColumnMenu: false, enableFiltering: false, width: 65, cellTemplate: '<a class="btn btn-info" role="button" ng-href="show.php?id={{row.entity.id}}">Show</a>'},
	                           		{field: 'edit', enableColumnMenu: false, enableFiltering: false, width: 53, cellTemplate: '<a class="btn btn-primary" role="button" ng-href="edit.php?id={{row.entity.id}}">Edit</a>'},
	                               	{field: 'first_name',  enableColumnMenu: false}, {field: 'last_name', enableColumnMenu: false},{field: 'age',  enableColumnMenu: false}, {field: 'sex', enableColumnMenu: false}, {field: 'height',  enableColumnMenu: false}, {field: 'weight', enableColumnMenu: false},
	                           		{field: 'delete', enableColumnMenu: false, enableFiltering: false, width: 67, cellTemplate: '<button class="btn btn-danger" ng-click="grid.appScope.deleteById(row.entity.id,row.entity.first_name, grid.appScope.reloadGrid);">Delete</button>'}
	                               ];

	$scope.setGrid = function(data){$scope.gridModel.data = data;}

	$scope.data =  (getUrlParam("get")) ? getUrlParam("get") : 'public'; 
	
	$scope.reloadGrid = function(){
		var get = 'data.php?get='+$scope.data;
		$scope.setFromGet(get, $scope.setGrid);
	}
	
	$scope.reloadGrid();
	
}]);
</script>
