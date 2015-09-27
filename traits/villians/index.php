
<?php include_once '../../resources/templates/head.php'; ?>
<div ng-controller="CharacterTraitIndexController">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
				<div class="panel panel-default">
					<a class="btn btn-primary" href="edit.php">Add</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Villain Traits</h3>
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
app.controller("CharacterTraitIndexController", ['$scope', "$http" , function($scope, $http){

	$scope.gridModel = {enableFiltering: true, enableColumnResizing: true, showColumnFooter: true , enableSorting: false, showGridFooter: true, enableRowHeaderSelection: false, rowHeight: 42};
	$scope.gridModel.columnDefs = [	{field: 'edit', enableColumnMenu: false, enableFiltering: false, width: 53, cellTemplate: '<a class="btn btn-primary" role="button" ng-href="edit.php?id={{row.entity.id}}">Edit</a>'},
	                               	{field: 'type',  enableColumnMenu: false}, {field: 'kind', enableColumnMenu: false},{field: 'description', enableColumnMenu: false},
	                           		{field: 'delete', enableColumnMenu: false, enableFiltering: false, width: 67, cellTemplate: '<button class="btn btn-danger" ng-click="grid.appScope.deleteTrait(row.entity.id,row.entity.kind);">Delete</button>'}
	                               ];

	
	$scope.reloadGrid = function(){
		$http.get('data.php').
			then(function(response){
				$scope.gridModel.data = response.data;
				
			});
	}

	$scope.deleteTrait =function(id,kind){
		if(window.confirm("Are you sure you want to delete "+kind+"?")){
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
<?php include_once '../../resources/templates/footer.php';?>
