<?php 
include_once '../../config/config.php';
include_once $serverPath . 'utils/connect.php';
require_once $serverPath . 'utils/generator/dungeon.php';
if(!empty($_GET['map']) && !empty($_GET['size'])){
		createDungeon();
		$_POST['map'] = $_GET['map'];
		$_POST['size'] = $_GET['size'];
		$table = "dungeon";
		header("Location: ".$baseURL."assets/dungeons/show.php?id=".insertAndReturnId($table));
		
	}
	
?>
<!-- Super weird and aweful but create works -->
<html ng-app="app">
<head>
	<script src="<?php echo baseURL;?>resources/mapGenerator.js"></script>
	<script src="<?php echo baseURL;?>resources/angular/angular.min.js"></script>
		<script src="<?php echo baseURL;?>resources/underscore/underscore-min.js"></script>
	
</head>
	<div ng-controller='DungeonCreateController'></div>
</html>

<script type="text/javascript">
var app = angular.module('app',[]);
	app.controller("DungeonCreateController", ['$scope', "$window" , function($scope, $window){

		$scope.getParsedMap = function(){return JSON.parse($scope.map);}
		$scope.stringifyMap = function(map){$scope.map = JSON.stringify(map, null, '');}

		var size = getRandomSize();
		$scope.stringifyMap(generateMap(size).getTiles());

		//console.log('/aesop/dungeons/create.php?map='+$scope.map+"&size="+size);
		$window.location.href = '<?php echo baseURL;?>assets/dungeons/create.php?map='+$scope.map+"&size="+size;
	}]);
</script>