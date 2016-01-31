<?php
	include_once '../config/config.php';
	include_once $serverPath.'utils/security/requireLogin.php';
	include_once $serverPath.'utils/db/db_post.php';

	$table = "users";
	if (! empty ( $_POST )) {
		$data = [
				'username' => $_POST['username'],
				'assestDefaultAccess'=> $_POST['assestDefaultAccess'],
				'email' => $_POST['email']
				];
		$constraints = ['id' => $_SESSION['user']['id']];
		updateWithConstratints($table, $data, $constraints);
		header ( "Location: index.php");
		die ( "Redirecting to index.php" );
		
	}
	
	
	include_once $serverPath.'resources/templates/head.php';
?>
<div ng-controller="ProfileEditController">
	<form action="edit.php" method="post">
		<div class="container-fluid">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Edit Your Profile</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" required="required" placeholder="Username" ng-model="user.username" name="username" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="username">Email</label>
							<input type="email" required="required" placeholder="Email" ng-model="user.email" name="email" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label>Default Status of my Creations</label>
							<select class="form-control" name="assestDefaultAccess" ng-model="user.assestDefaultAccess">
								<option value="1">Public</option>
								<option value="0">Private</option>
							</select>
						</div>
					</div>
					
					<div class="panel-footer">
						<button class="btn btn-primary" type="submit">Save</button>
						<a class="btn btn-danger" href="<?php echo $baseURL?>">Cancel</a>
					</div>
					
				</div>
			</div>
		</div>
	</form>
</div>

<script> 

app.controller("ProfileEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.setFromGet("myData.php", function(data){
		$scope.user = data;
	});
	
}]);

</script>