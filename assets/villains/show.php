<?php
include_once '../../config/config.php';
include_once $serverPath.'resources/templates/head.php';
?>
	<div ng-controller="VillianShowController">
	
	</div>

<script>
app.controller("VillianShowController", ['$scope', "$http", "$location", function($scope, $http){
	$scope.id = getID();
	if($scope.id){
		$http.get('data.php?id='+$scope.id).
			then(function(response){
				console.log(response);
				$scope.villian = response.data;
				$scope.villian.age = Number($scope.villian.age);
				$scope.villian.weight = Number($scope.villian.weight);
				$scope.villian.feet = Math.floor(Number($scope.villian.height)/12);
				$scope.villian.inches = Math.floor(Number($scope.villian.height)%12);
				
		});
	}
		
}]);

</script>
