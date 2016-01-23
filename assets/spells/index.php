<?php
include_once '../../config/config.php';
include_once $serverPath . "resources/templates/head.php";
?>
<div ng-controller="SpellsIndexController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						 <h3 class="panel-title pull-left" style="margin-top: 5px">Spells</h3>
					     <div class="form-inline">
					     <a href="edit.php"  class="btn btn-primary pull-right">Add</a>
					
					     <select class="form-control pull-right" style="margin-right: 10px;" ng-model='class' ng-options="c as c for c in classes">
					          <option value="">Show All</option>
					     </select>
					     <label class="pull-right" style="margin-right: 5px; margin-top: 5px">Classes</label>
					</div>
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
app.controller("SpellsIndexController", ['$scope', "$controller" , function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.gridModel = {enableFiltering: true, enableColumnResizing: true, showColumnFooter: true , enableSorting: false, showGridFooter: true, enableRowHeaderSelection: false, rowHeight: 42};
	$scope.gridModel.columnDefs = [	{field: 'show', enableColumnMenu: false, enableFiltering: false, width: 65, cellTemplate: '<a class="btn btn-info" role="button" ng-href="show.php?id={{row.entity.id}}">Show</a>'},
	                           		{field: 'edit', enableColumnMenu: false, enableFiltering: false, width: 53, cellTemplate: '<a class="btn btn-primary" role="button" ng-href="edit.php?id={{row.entity.id}}">Edit</a>'},
	                               	{field: 'name',  enableColumnMenu: false},{field: 'class'},
	                           		{field: 'delete', enableColumnMenu: false, enableFiltering: false, width: 67,  cellTemplate: '<button class="btn btn-danger" ng-click="grid.appScope.deleteById(row.entity.id,row.entity.name, grid.appScope.updateGrid);">Delete</button>'}
	                           	];

	$scope.updateGrid = function(){
		$scope.setFromGet("data.php?get=grid", function(data){
			$scope.gridModel.data = data;
			$scope.classes = listByProperty($scope.gridModel.data, 'class', true);
			
		});
	}

	$scope.updateGrid();

	


}]);
</script>