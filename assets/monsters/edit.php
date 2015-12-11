<?php 
	include_once '../../config/config.php';
	include_once $serverPath.'utils/db_post.php';
	
	include_once $serverPath.'resources/templates/head.php';
	?>
	
<div ng-controller="MonsterEditController">
	<form action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>" method="post">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">{{addOrEdit}} {{monster.name || 'Monster'}}</div>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<!-- Name -->
					<div class="row form-group">
						<label for="name">Name</label>
						<input type="text" id="name" class="form-control"  name="name" ng-model="monster.name" placeholder="Name" />
					</div>
					<!-- Hit points, speed and armor -->
					<div class="row form-group">
						<div class="col-md-4">
							<label for="hit_points">Hit Points</label>
							<input type="text" id="hit_points" class="form-control"  name="hit_points" ng-model="monster.hit_points" placeholder="Hit Points" />
						</div>
						<div class="col-md-4">
							<label for="armor">Armor</label>
							<input type="number" id="armor" class="form-control"  name="armor" ng-model="monster.armor" placeholder="Armor" />
						</div>
						<div class="col-md-4">
							<label for="speed">Speed</label>
							<div class="input-group">
								<input type="number" id="speed" class="form-control"  name="speed" ng-model="monster.speed" placeholder="Speed" />
								<span class="input-group-addon">ft</span>
							</div>
						</div>
					</div>
					<!-- Stats -->
					<div class="row">
						<div ng-repeat="stat in statsValues">
							<div class="col-md-2 form-group">
								<label for="{{stat}}">{{capitalizeFirstLetter(stat)}}</label>
								<div class="input-group">
									<input type="number" id="{{stat}}" class="form-control" ng-model="monster.stats[stat]" min=0 max=30>
									<span class="input-group-addon">{{getModifer(monster.stats[stat])}}</span>
								</div>
							</div>
						</div>	
					</div>
					<!-- Skill, lauanges, senses -->	
					<div class="row">
						<!-- Skills -->
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Skills</div>
									<button type="button" class="btn btn-primary btn-sm pull-right" ng-click="skills.push({})">Add</button>
								</div>
								<div class="panel-body" ng-hide="skills.length >0">No Skills</div>
								<div class="panel-body" ng-show="skills.length >0">
									<div class="row">
										<div class="col-md-4"><label>Skill</label></div>
										<div class="col-md-4"><label>Modifer</label></div>
									</div>
									<div class="row" ng-repeat="skill in skills track by $index">
										<div class="col-md-4 form-group">
											<select ng-model="skill.skill" class="form-control">
												<option value="">Select One</option>
												<option ng-repeat="value in possible_skills" value={{value}}>{{value}}</option>
											</select>
										</div>
										<div class="col-md-4 form-group">
											<input ng-model="skill.modifier" type="number" class="form-control">
										</div>
										<div class="col-md-4 form-group">
											<button type="button" class="btn btn-primary btn-sm" ng-click="skills.splice($index,1)">Remove</button>
										</div>
									</div>
								
								</div>
							</div>
						</div>
						<!-- Languages -->
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Languages</div>
									<button type="button" class="btn btn-primary btn-sm pull-right" ng-click="languages.push({})">Add</button>
								</div>
								<div class="panel-body" ng-hide="languages.length >0">No languages</div>
								<div class="panel-body" ng-show="languages.length >0">
									<div class="row">
										<div class="col-md-6"><label>Language</label></div>
									</div>
									<div class="row" ng-repeat="language in languages track by $index">
										<div class="col-md-6 form-group">
										<select ng-model="language.language" class="form-control">
												<option value="">Select One</option>
												<option ng-repeat="value in possible_languages" value={{value}}>{{value}}</option>
										</select>
										</div>
										<div class="col-md-6 form-group">
											<button type="button" class="btn btn-primary btn-sm" ng-click="languages.splice($index,1)">Remove</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Senses -->
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Senses</div>
									<button type="button" class="btn btn-primary btn-sm pull-right" ng-click="senses.push({})">Add</button>
								</div>
								<div class="panel-body" ng-hide="senses.length >0">No Senses</div>
								<div class="panel-body" ng-show="senses.length >0">
									<div class="row">
										<div class="col-md-6"><label>Sense</label></div>
									</div>
									<div class="row" ng-repeat="sense in senses track by $index">
										<div class="col-md-6 form-group">
											<input type="text" class="form-control"  name="name" ng-model="sense.sense" placeholder="Sense" />
										</div>
										<div class="col-md-6 form-group">
											<button type="button" class="btn btn-primary btn-sm" ng-click="senses.splice($index,1)">Remove</button>
										</div>
									</div>
									
								</div>
							</div>
						</div>					
					</div>
					<!-- Callenge, xp -->
					<div class="row">
					<!-- Challenge -->
						<div class="col-md-6 form-group">
							<label for="challenge">Challenge Level</label>
							<input id="challenge" name="challenge" type="number" class="form-control" ng-model="monster.challenge" placeholder="Challenge">
						</div>
					<!-- XP -->
						<div class="col-md-6 form-group">
							<label for="xp">Experiance</label>
							<div class="input-group">
								<input id="xp" type="number" class="form-control" ng-model="monster.xp" name="xp" min=0>
								<span class="input-group-addon">XP</span>
							</div>
						</div>
					</div>
					<!-- Abilities, Actions, found -->
					<div class="row">
					<!-- Abilities -->
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Abilities</div>
									<button type="button" class="btn btn-primary btn-sm pull-right" ng-click="abilities.push({})">Add</button>
								</div>
								<div class="panel-body" ng-hide="abilities.length >0">No Abilities</div>
								<div class="panel-body" ng-show="abilities.length >0">
									<div class="row">
										<div class="col-md-6"><label>Ability</label></div>
									</div>
									<div class="row" ng-repeat="ability in abilities track by $index">
									</div>
								</div>
							</div>
						</div>
					<!-- Actions -->
						<div class="col-md-4">
						</div>
					<!-- found -->
						<div class="col-md-4">
						</div>
					</div>
					<!-- description -->
					
					
					
				</div>
			</div>
		</div>
	<input name="skills" class="hidden" ng-model="skills_text", type="text">
	<input name="stats" class="hidden" ng-model="stats_text", type="text">
	<input name="languages" class="hidden" ng-model="languages_text", type="text">
	<input name="senses" class="hidden" ng-model="senses_text", type="text">
	</form>

</div>

<script> 
app.controller("MonsterEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));

	$scope.possible_skills = ["Acrobatics", "Animal Handling", "Arcana","Athletics","Deception","History","Insight","Intimidation","Investigation",
	                      	  "Medicine","Nature","Perception","Performance","Persuasion","Religion","Sleight of Hand","Stealth","Survival"];

	$scope.possible_languages = ['Abyssal','Aquan','Auran','Celestial','Common','Draconic','Druidic','Dwarven','Elven','Giant',
								 'Gnome','Goblin','Gnoll','Halfling','Ignan','Infernal','Orc','Sylvan','Terran','Undercommon'];
	
	var valueToNumberList = ["speed","armor"];
	$scope.statsValues =["strength","dexterity","constitution","intelligence","wisdom","charisma"];

	$scope.monster = {};
	$scope.skills=[];
	$scope.languages = [];
	$scope.senses = [];
	$scope.abilities = [];
	
	$scope.setMonster = function(monster){
		$scope.monster = convertValuesToNumbers(monster, valueToNumberList);
		$scope.monster.stats = convertValuesToNumbers($scope.monster.stats, $scope.statsValues);
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
	}
	
	$scope.setById($scope.setMonster);
	$scope.saveOrUpdate = "Save";
	$scope.addOrEdit = "Add";

	$scope.getModifer = function(stat){
		if(!stat){return "";}
		var modifer = (stat) ? Math.floor((stat-10)/2): 0;
		return (modifer >0) ? "+"+modifer : modifer;
	}
	
	$scope.$watch("monster.stats", function(val){
		$scope.stats_text = JSON.stringify(val);
	},true);

	$scope.$watch("skills", function(val){
		$scope.skills_text = JSON.stringify(val);
	}, true);

	$scope.$watch('languages', function(val){
		$scope.languages_text = JSON.stringify(val);
	}, true);

	$scope.$watch('senses', function(val){
		$scope.senses_text = JSON.stringify(val);
	}, true);
	
	
}]);

</script>