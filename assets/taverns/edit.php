<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/db/db_get.php';
include_once $serverPath . 'utils/db/db_post.php';
require_once $serverPath . 'utils/generator/tavern.php';

$table = "tavern";
if (! empty ( $_POST )) {
	createTavern ();
	if (empty ( $_GET ['id'] )) {
		$id = insertFromPostWithIdReturn( $table );
		$added = true;
	} 

	else {
		$id = $_GET ['id'];
		updateFromPost ( $table );
	}
		header ( "Location: show.php?id=" . $id );
		die ( "Redirecting to show.php" );
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
							placeholder="Tavern Name" />
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
							<option ng-repeat="npc in npcs"
								value={{npc.id}}
								ng-selected="tavern.owner_id == npc.id">{{npc.name}}</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="other_information">Other Information</label>
						<textarea name="other_information" class="form-control" rows="4">{{tavern.other_information}}</textarea>
					</div>
					
					<div class="form-group">
						<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
						<a class="btn btn-danger" href="index.php">Cancel</a>
					</div>
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

		$http.get('<?php echo $baseURL;?>assets/npcs/data.php?column=name').
		then(function(response){
			var npcs = response.data
			for(var i=0; i<npcs.length; i++){
				var character = npcs[i]
				character.name = character.first_name+" "+character.last_name
				character.id = Number(character.id);
			}
			$scope.npcs = npcs;
		});
	
}]);

</script>


