<?php 
include_once '../../config/config.php';
include_once $serverPath.'resources/templates/head.php';
?>

<div ng-controller="MonsterShow">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{{monster.name}}</h3>
		</div>
		<div class="panel-body">
			<!-- Hit points, armor, speed -->
			<div class="panel panel-default">
				<div class="panel-body">
					<!-- Hit points -->
					<div class="col-md-4">
						<div><b>Hit Points:</b> {{hit_points}} ({{monster.hit_points.stringValue}})</div>
						<div><b>Average:</b> {{(monster.hit_points != null) ? getDiceAverage(monster.hit_points) : ''}}</div>
					</div>
					<!-- armor -->
					<div class="col-md-4">
						<div><b>Armor:</b> {{monster.armor}}</div>
					</div>
					<!-- speed -->
					<div class="col-md-4">
						<div><b>Speed:</b> {{monster.speed}}ft</div>
					</div>
				</div>
			</div>
			<!-- Challenge, found -->
			<div class="panel panel-default">
				<div class="panel-body">
					<!-- found -->
					<div class="col-md-6">
						<div><b>Found:</b> {{hashArrayValueToString(found_places, 'found')}}</div>
					</div>
					<!-- found ends -->
					<!-- Challenge -->
					<div class="col-md-6">
						<div><b>Challenge:</b> {{challenge}} ({{monster.xp}} XP)</div>
						
					</div>
					<!-- Challenge ends -->
				</div>
			</div>
			<!-- Challenge, found end-->
			
			<!-- Hit points, armor, speed ends -->
			<!-- Stats -->
			<div class="panel panel-default">
				<div class="panel-body">
					<div ng-repeat="(key, value) in monster.stats">
						<div ng-class="columnSizeByHash(monster.stats, 'md', 6)"
							<label><b>{{capitalizeFirstLetter(key)}}</b></label>
							<p>{{value}}</p>
						</div>
					</div>
				</div>
			</div>
		<!-- Stats ends -->
		<!-- Skills, Senses, Languages -->
			<div class="panel panel-default">
				<div class="panel-body">
					<!-- skills -->
					<div class="col-md-4">
						<b>Skills:</b>
						<div ng-repeat="skill in skills track by $index">
							<div ng-class="columnSizeByArray(skills, 'md', 2)">
								{{skill.skill}}: <b> {{(skill.modifier >=0) ? '+' : ''}}{{skill.modifier}}</b>
							</div>
						</div>
					</div>
					<!-- skills end -->
					<!-- Senses -->
					<div class="col-md-4">
						<b>Senses:</b>
						<div ng-repeat="sense in senses track by $index">
							<div ng-class="columnSizeByArray(senses, 'md', 2)">
								{{sense.sense}}
							</div>
						</div>
					</div>
					<!-- Senses end -->
					<!-- Languages -->
					<div class="col-md-4">
						<b>Languages:</b>
						<div ng-repeat="language in languages track by $index">
							<div ng-class="columnSizeByArray(languages, 'md', 3)">
								{{language.language}}
							</div>
						</div>
					</div>
					<!-- Senses end -->
				</div>
			</div>
			<!-- Skills, Senses, Languages end-->
			
			<!-- Abilites, actions -->
			<div class="row">
				<!-- Abilties -->
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Abilites</h3>
						</div>
						<div class="panel-body">
							<div ng-repeat="ability in abilities">
								<div><b>{{ability.name}}</b></div>
								<div>{{ability.description}}</div>
							</div>
						</div>
					</div>
				</div>
				<!-- actions -->
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Actions</h3>
						</div>
						<div class="panel-body">
							<div ng-repeat="action in actions">
								<div><b>{{action.name}}</b></div>
								<div>{{action.description}}</div>
							</div>
						</div>
					</div>
				</div>
				<!-- actions ends -->
							
			
			</div>
			<!-- Abilites, actions end-->
			<!-- description -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Description</h3>
				</div>
				<div class="panel-body">
					<div>
					 	{{monster.description}}
					</div>
				</div>
				
			</div>
			
	</div>
	<!-- Panel body ends -->
	<!-- panel footer -->
	<div class="panel-footer">
		<a href="index.php" class="btn btn-info">Show All</a>
		<a href="{{edit}}" class="btn btn-primary">Edit</a>
		<button ng-click="deleteWithRedirect(monster.id, monster.name)" class="btn btn-danger">Delete</button>
	</div>

</div>

<script src="<?php echo $baseURL;?>resources/roll.js"></script>
<script>
app.controller('MonsterShow', ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	angular.extend(this, $controller('rollDisplayController', {$scope: $scope}));

	$scope.setMonster = function(monster){
		$scope.monster = monster;
		$scope.monster.stats = (monster.stats) ? JSON.parse(convertValuesToNumbers($scope.monster.stats, Object.keys($scope.monster.stats))) : {};
		$scope.skills = (monster.skills) ? convertListHashValuesToNumbers(JSON.parse($scope.monster.skills), ['modifer']) : [];
		var statsKeys = Object.keys($scope.monster.stats);
		for(var i=0; i<statsKeys.length; i++){
			var modifer = $scope.getModifer($scope.monster.stats[statsKeys[i]]);
			$scope.monster.stats[statsKeys[i]] = $scope.monster.stats[statsKeys[i]]+ " ("+ modifer+")";
		}
		$scope.languages = (monster.languages) ? JSON.parse($scope.monster.languages) : [];
		$scope.senses = (monster.senses) ? JSON.parse($scope.monster.senses) : [];
		$scope.abilities = (monster.abilities) ? JSON.parse($scope.monster.abilities) : [];
		$scope.actions = (monster.actions) ? JSON.parse($scope.monster.actions) : [];
		$scope.challenge = getFractionString(monster.challenge);
		$scope.found_places = (monster.found) ? JSON.parse($scope.monster.found) : [];
		$scope.monster.hit_points = (monster.hit_points) ? getDiceValue(monster.hit_points) : {};
		$scope.hit_points = rollDice($scope.monster.hit_points);
		$scope.edit = "edit.php?id="+getID();
		
	}
	
	$scope.setById($scope.setMonster);
	
}]);

</script>
