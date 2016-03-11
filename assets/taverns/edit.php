<?php
include_once '../../config/config.php';

$table = "tavern";
$runOnSave = "createTavern";
require_once $serverPath . 'utils/generator/tavern.php';
include_once $serverPath.'utils/db/fullTemplates/secureEdit.php';

include_once $serverPath . 'resources/templates/head.php';
?>
<div ng-controller="TavernAddEditController">
	<form
		action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
		method="post">
		<div class="col-md-6">
			<div
				class="panel <?php if($added){echo "panel-success";} else{echo "panel-default";} ?>">
				<div class="panel-heading">
					<div class="panel-title">{{addOrEdit}} Tavern</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="name">Tavern Name</label> <input type="text"
							class="form-control" name="name" ng-model="tavern.name"
							placeholder="Tavern Name" />
					</div>
					<div class="form-group">
						<label for="type">Type</label> <input type="text"
							class="form-control" name="type" ng-model="tavern.type"
							placeholder="Type" />
					</div>
					<div class="form-group">
						<label for="tavern_owner_id">Owner</label> <select class="form-control" ng-model="tavern.tavern_owner_id"
							name="tavern_owner_id">
							<option value="">Any</option>
							<option ng-repeat="npc in npcs"
								value="{{npc.id}}"
								ng-selected="tavern.tavern_owner_id == npc.id">{{npc.name}}</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="other_information">Other Information</label>
						<textarea name="other_information" class="form-control" rows="4">{{tavern.other_information}}</textarea>
					</div>
					
					<div class="form-group">
						<label for="public">Public or Private</label>
						<select class="form-control" id="public" name="public" ng-model="tavern.public">
							<option ng-selected="tavern.public=='1'" value="1">Public</option>
							<option  ng-selected="tavern.public=='0'" value="0">Private</option>
						</select>
					</div>
					
					<div class="form-group">
						<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
						<a class="btn btn-danger" href="index.php">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
app.controller("TavernAddEditController", ['$scope', "$controller" , function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.tavern = {};
	
	$scope.setById(function(data){
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update"
		$scope.tavern = data;
		
	},function(){
		$scope.addOrEdit = "Add";
		$scope.saveOrUpdate = "Save";

		$scope.getDefaultAccess(function(n){$scope.tavern['public'] = n;});
	});


	$scope.setFromGet('<?php echo $baseURL;?>assets/npcs/data.php?column=name', function(data){
			$scope.npcs = data;
			angular.forEach($scope.npcs, function(npc){
				npc.name = npc.first_name+" "+npc.last_name
			});
	});

}]);

</script>


