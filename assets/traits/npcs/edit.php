<?php
include_once '../../config/config.php';

$table = "npc_traits";
include_once $serverPath.'utils/db/fullTemplates/secureEdit.php';

include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="TraitController">
     <form action="{{editAction()}}" method="post">
          <div class="container-fluid">
                    <div class="col-md-6">

               <div class="panel panel-default">
                    <div class="panel-heading">
                         <h3 class="panel-title">{{addOrEdit}} {{assestName}} {{trait.trait || 'Trait'}}</h3>
                    </div>
               <div class="panel-body">
	                 <div class="form-group">
						 <label for="trait">Trait</label>
						 <input type="text" class="form-control" required="required" name="trait" ng-model="trait.trait" placeholder="Trait" />
					</div>
					<div class="form-group">
						<label for="type">Type</label>
						 <input type="text"class="form-control" required="required" name="type" ng-model="trait.type" placeholder="Type" />
					</div>
					
					<div class="form-group">
						<label for="public">Public or Private</label>
						<select class="form-control" id="public" name="public" ng-model="trait.public">
							<option ng-selected="trait.public=='1'" value="1">Public</option>
							<option  ng-selected="trait.public=='0'" value="0">Private</option>
						</select>
					</div>

                </div>
                    <div class="panel-footer">
                         <button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>

                         <a class="btn btn-danger" href="index.php">Cancel</a>
                    </div>
              </div>
          </div>
          </div>
     </form>
</div>

<script>

app.controller("TraitController", ['$scope', "$controller", function($scope, $controller){

angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.assestName = "Non-player Charctaer";
	$scope.trait = {};

	$scope.setById(function(data){
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update"
		$scope.trait = data;
		
	},function(){
		$scope.addOrEdit = "Add";
		$scope.saveOrUpdate = "Save";

		$scope.getDefaultAccess(function(n){$scope.trait['public'] = n;});
	});

}]);

</script>



