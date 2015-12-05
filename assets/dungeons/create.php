<?php 
include_once '../../config/config.php';
include_once $serverPath . 'utils/db_post.php';
require_once $serverPath . 'utils/generator/dungeon.php';
if(!empty($_GET['map']) && !empty($_GET['size']) && !empty($_GET['traps'])){
		createDungeon();
		$_POST['map'] = $_GET['map'];
		$_POST['size'] = $_GET['size'];
		$_POST['traps'] = $_GET['traps'];
		$table = "dungeon";
		header("Location: ".$baseURL."assets/dungeons/show.php?id=".insertFromPostWithIdReturn($table));
		
	}
	
?>
<!-- Super weird and aweful but create works-->

<html ng-app="app">
<?php include_once $serverPath.'resources/templates/header.php';?>
<div ng-controller='DungeonCreateController'></div>
<script src="<?php echo $baseURL;?>resources/mapGenerator.js"></script>
<script type="text/javascript">
	app.controller("DungeonCreateController", ['$scope', "$window", '$controller' , function($scope, $window, $controller){

		angular.extend(this, $controller('TrapController', {$scope: $scope}));
		$scope.test = "testy";
		$scope.dungeon = {};
		$scope.dungeon.size = getRandomSize(); 
		$scope.generateMap();
		$scope.trapNumber = randomRange(1,3);
		function loadTraps(traps){
			$scope.trapOptions = traps;
			$scope.traps = [];
			for(var i=0; i<$scope.trapNumber; i++){
				$scope.traps.push({});
			}
			$scope.setRandomTraps();
			
			for(var i=0; i<$scope.traps.length; i++){
				$scope.map.setTrap($scope.traps[i].column,$scope.traps[i].row);
			}
			$scope.stringifyMap($scope.map.getTiles());
			$scope.trapString = getTrapSting($scope.traps);
			$window.location.href = '<?php echo $baseURL;?>assets/dungeons/create.php?map='+$scope.dungeon.map+"&size="+$scope.dungeon.size+"&traps="+$scope.trapString;
			}
		$scope.setFromGet("data.php?column=traps",loadTraps);

		//console.log('/aesop/dungeons/create.php?map='+$scope.map+"&size="+size);
	}]);
</script>
</html>