<?php
include_once '../config/config.php';
include_once $serverPath.'utils/security/requireAdmin.php';

include_once $serverPath.'resources/templates/head.php';
?>
<div ng-controller="AdminIndexController">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h4 class="panel-title pull-left" style="padding-top: 7.5px;">Users</h4>
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
app.controller("AdminIndexController", ['$scope', "$controller" , function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.gridModel = {enableFiltering: true, enableColumnResizing: true, enableColumnMenus: false, showColumnFooter: true , enableSorting: false, showGridFooter: true, enableRowHeaderSelection: false, rowHeight: 42};
	$scope.gridModel.columnDefs = [	{field: 'username'},{field: 'email'},
	                               	{field: 'assestDefaultAccessDisplay', displayName: 'Assest Default Access'},
	                               	{field: 'adminDisplay', displayName: 'Admin'},
	                               	{field: 'adminControl', enableFiltering: false, width: 125, cellTemplate: '<button class="btn btn-default center-block cellButton" ng-click="grid.appScope.toggleAdmin(row.entity.id)">{{(row.entity.admin == \'1\') ? \'Remove\' : \'Add\'}} Admin</button>'},
	                           		{field: 'delete', enableFiltering: false, width: 67,  cellTemplate: '<button class="btn btn-danger center-block cellButton" ng-click="grid.appScope.deleteUser(row.entity.id,row.entity.username);">Delete</button>'}
	                           	];

	$scope.updateGrid = function(){
		$scope.setFromGet("data.php?get=users", function(data){
			angular.forEach(data, function(row) {
				  row.adminDisplay = (row.admin == '1') ? 'Yes' : 'No';
				  row.assestDefaultAccessDisplay = (row.assestDefaultAccess == '1') ? 'Public' : 'Private'; 
			});
			$scope.gridModel.data = data;
		});
	}

	$scope.toggleAdmin = function(id){
		$scope.runPost("toggleAdmin.php", {'id': id}, function(data){
			$scope.updateGrid();
		});
	}

	$scope.deleteUser = function(id, username){
		if(window.confirm("Are you sure you want to delete "+username+"?")){
			$scope.runPost("deleteUser.php", {'id': id}, function(data){
				$scope.updateGrid();
			});
		}
	}

	$scope.updateGrid();
	

}]);
</script>
