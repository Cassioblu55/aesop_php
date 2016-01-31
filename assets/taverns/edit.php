<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';
include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/tavern.php';

$table = "tavern";
if (! empty ( $_POST )) {
	createTavern ();
	if (empty ( $_GET ['id'] )) {
		insertFromPost ( $table );
		$added = true;
	} 

	else {
		updateFromPost ( $table );
		header ( "Location: show.php?id=" . $_GET ['id'] );
		die ( "Redirecting to show.php" );
	}
}
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
							placeholder="tavern Name" />
					</div>
					<div class="form-group">
						<label for="type">Type</label> <input type="text"
							class="form-control" name="type" ng-model="tavern.type"
							placeholder="Type" />
					</div>
					<div class="form-group">
						<label for="tavern_owner_id">Owner</label> <select class="form-control"
							name="owner_id">
							<option value="">Any</option>
							<option ng-repeat="character in characters"
								value={{character.id}}
								ng-selected="tavern.owner_id == character.id">{{character.name}}</option>
						</select>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
						<a class="btn btn-danger" href="index.php">Cancel</a>
					</div>
					<div style='<?php if($added){echo "color:#5cb85c";}else{echo "display:none";}?>'>Added
						tavern</div>
				</div>
			</div>
		</div>

	</form>
	<div id="tavern" style="display: none"><?php if(!empty($_GET['id'])){echo json_encode(findById($table, $_GET['id']));}?></div>
</div>

<script type="text/javascript">
var tavernData =  document.getElementById("tavern").textContent
if(tavernData){var tavern =JSON.parse(tavernData)};
app.controller("TavernAddEditController", ['$scope', "$http" , function($scope, $http){
	if(tavern){
		$scope.tavern = tavern;
		$scope.tavern.tavern_owner_id = Number($scope.tavern.tavern_owner_id);
	}
		$scope.addOrEdit = (!tavern) ? "Add" : "Edit";
		$scope.saveOrUpdate = (!tavern) ? "Save" : "Update"

			$scope.getCharacters = function(){
			$http.get('<?php echo $baseURL;?>assets/ncps/data.php?column=name').
			then(function(response){
				var characters = response.data
				for(var i=0; i<characters.length; i++){
					var character = characters[i]
					character.name = character.first_name+" "+character.last_name
					character.id = Number(character.id);
				}
				$scope.characters = characters;
			});
		}
		$scope.getCharacters();
	
}]);

</script>


