<?php
include_once '../../config/config.php';

$table = "monster";
include_once $serverPath.'utils/db/fullTemplates/secureEdit.php';

include_once $serverPath . 'resources/templates/head.php';
?>

<div ng-controller="MonsterEditController">
	<form
		action="edit.php<?php if(!empty($_GET['id'])){ echo "?id=".$_GET['id'];}?>"
		method="post">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">{{addOrEdit}} {{monster.name || 'Monster'}}</div>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<!-- Name -->
					<div class="form-group">
						<label for="name">Name</label> <input type="text" id="name"
							class="form-control" required="required" name="name"
							ng-model="monster.name" placeholder="Name" />
					</div>
					<!-- Hit points, speed and armor -->
					<div class="row form-group">
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Hit Points</div>
									<div class="pull-right">{{getDiceDisplay(monster.hit_points)}}</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<label>Amount</label> <input type="number" min=0
											class="form-control" ng-model="monster.hit_points.amount">
										<div>Min {{getDiceMin(monster.hit_points)}}</div>
									</div>
									<div class="col-md-4">
										<label>Kind</label> <input type="number" min=0
											class="form-control" ng-model="monster.hit_points.kind">
										<div>Max {{getDiceMax(monster.hit_points)}}</div>
									</div>
									<div class="col-md-4">
										<label>Modifer</label> <input type="number" min=0
											class="form-control" ng-model="monster.hit_points.modifer">
										<div>Average {{getDiceAverage(monster.hit_points)}}</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<label for="armor">Armor</label> <input type="number" id="armor"
									class="form-control" name="armor" ng-model="monster.armor"
									placeholder="Armor" />
							</div>
							<div class="row">
								<label for="speed">Speed</label>
								<div class="input-group">
									<input type="number" id="speed" class="form-control"
										name="speed" ng-model="monster.speed" placeholder="Speed" /> <span
										class="input-group-addon">ft</span>
								</div>
							</div>
						</div>

					</div>
					<!-- Stats -->
					<div class="row">
						<div ng-repeat="stat in statsValues">
							<div class="col-md-2 form-group">
								<label for="{{stat}}">{{capitalizeFirstLetter(stat)}}</label>
								<div class="input-group">
									<input type="number" id="{{stat}}" class="form-control"
										ng-model="monster.stats[stat]" min=0 max=30> <span
										class="input-group-addon">{{getModifer(monster.stats[stat])}}</span>
								</div>
							</div>
						</div>
					</div>
					<!-- Skill, lauanges, senses -->
					<div class="row">
						<!-- Skills -->
						<div class="col-md-5">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Skills</div>
									<button type="button" class="btn btn-primary btn-sm pull-right"
										ng-click="skills.push({})">Add</button>
								</div>
								<div class="panel-body" ng-hide="skills.length >0">No Skills</div>
								<div class="panel-body" ng-show="skills.length >0">
									<div class="row">
										<div class="col-md-4">
											<label>Skill</label>
										</div>
										<div class="col-md-4">
											<label>Modifer</label>
										</div>
									</div>
									<div class="row" ng-repeat="skill in skills track by $index">
										<div class="col-md-4 form-group">
											<select ng-model="skill.skill" class="form-control">
												<option value="">Select One</option>
												<option ng-repeat="value in possible_skills" value={{value}}>{{value}}</option>
											</select>
										</div>
										<div class="col-md-4 form-group">
											<input ng-model="skill.modifier" type="number"
												class="form-control">
										</div>
										<div class="col-md-4 form-group">
											<button type="button" class="btn btn-primary btn-sm"
												ng-click="skills.splice($index,1)">Remove</button>
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
									<button type="button" class="btn btn-primary btn-sm pull-right"
										ng-click="languages.push({})">Add</button>
								</div>
								<div class="panel-body" ng-hide="languages.length >0">No
									languages</div>
								<div class="panel-body" ng-show="languages.length >0">
									<div class="row">
										<div class="col-md-6">
											<label>Language</label>
										</div>
									</div>
									<div class="row"
										ng-repeat="language in languages track by $index">
										<div class="col-md-6 form-group">
											<select ng-model="language.language" class="form-control">
												<option value="">Select One</option>
												<option ng-repeat="value in possible_languages"
													value={{value}}>{{value}}</option>
											</select>
										</div>
										<div class="col-md-6 form-group">
											<button type="button" class="btn btn-primary btn-sm"
												ng-click="languages.splice($index,1)">Remove</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Senses -->
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Senses</div>
									<button type="button" class="btn btn-primary btn-sm pull-right"
										ng-click="senses.push({})">Add</button>
								</div>
								<div class="panel-body" ng-hide="senses.length >0">No Senses</div>
								<div class="panel-body" ng-show="senses.length >0">
									<div class="row">
										<div class="col-md-6">
											<label>Sense</label>
										</div>
									</div>
									<div class="row" ng-repeat="sense in senses track by $index">
										<div class="col-md-6 form-group">
											<input type="text" class="form-control"
												ng-model="sense.sense" placeholder="Sense" />
										</div>
										<div class="col-md-6 form-group">
											<button type="button" class="btn btn-primary btn-sm"
												ng-click="senses.splice($index,1)">Remove</button>
										</div>
									</div>

								</div>
							</div>
						</div>
						<!-- End Skill, lauanges, senses  -->
					</div>
					<!-- Callenge, xp -->
					<div class="row">
						<!-- Challenge -->
						<div class="col-md-6 form-group">
							<label for="challenge">Challenge Level</label> <input
								id="challenge" name="challenge" step="any" type="number"
								class="form-control" ng-model="monster.challenge"
								placeholder="Challenge">
						</div>
						<!-- XP -->
						<div class="col-md-6 form-group">
							<label for="xp">Experiance</label>
							<div class="input-group">
								<input id="xp" type="number" class="form-control"
									ng-model="monster.xp" name="xp" min=0> <span
									class="input-group-addon">XP</span>
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
									<button type="button" class="btn btn-primary btn-sm pull-right"
										data-toggle="modal" ng-click="editAbility()"
										data-target="#abilityModal">Add</button>
								</div>
								<div class="panel-body" ng-hide="abilities.length >0">No
									Abilities</div>
								<div class="panel-body" ng-show="abilities.length >0">
									<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-7">
											<label>Ability</label>
										</div>
									</div>
									<div class="row"
										ng-repeat="ability in abilities track by $index">
										<div class="col-md-2 form-group">
											<button data-toggle="modal" type="button"
												class="btn btn-primary" data-target="#abilityModal"
												ng-click="editAbility($index)">Edit</button>
										</div>
										<div class="col-md-7 form-group">
											<p>{{ability.name}}</p>
										</div>
										<div class="col-md-3 form-group">
											<button class="btn btn-danger" type="button"
												ng-click="abilities.splice($index,1)">Delete</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Actions -->
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Actions</div>
									<button type="button" class="btn btn-primary btn-sm pull-right"
										data-toggle="modal" ng-click="editAction()"
										data-target="#actionModal">Add</button>
								</div>
								<div class="panel-body" ng-hide="actions.length >0">No Actions</div>
								<div class="panel-body" ng-show="actions.length >0">
									<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-7">
											<label>Action</label>
										</div>
									</div>
									<div class="row" ng-repeat="action in actions track by $index">
										<div class="col-md-2 form-group">
											<button data-toggle="modal" type="button"
												class="btn btn-primary" data-target="#actionModal"
												ng-click="editAction($index)">Edit</button>
										</div>
										<div class="col-md-7 form-group">
											<p>{{action.name}}</p>
										</div>
										<div class="col-md-3 form-group">
											<button class="btn btn-danger" type="button"
												ng-click="actions.splice($index,1)">Delete</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- found -->
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<div class="panel-title pull-left">Found</div>
									<button type="button" class="btn btn-primary btn-sm pull-right"
										ng-click="found_places.push({})">Add</button>
								</div>
								<div class="panel-body" ng-hide="found_places.length >0">Location
									unkown</div>
								<div class="panel-body" ng-show="found_places.length >0">
									<div class="row">
										<div class="col-md-6">
											<label>Found</label>
										</div>
									</div>
									<div class="row"
										ng-repeat="found in found_places track by $index">
										<div class="col-md-6 form-group">
											<select ng-model="found.found" class="form-control">
												<option value="">Select One</option>
												<option ng-repeat="value in possible_found" value={{value}}>{{value}}</option>
											</select>
										</div>
										<div class="col-md-6 form-group">
											<button type="button" class="btn btn-primary btn-sm"
												ng-click="found_places.splice($index,1)">Remove</button>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					<!-- description -->
					<div class="form-group">
						<label for='description'>Description</label>
						<textarea id='description' class="form-control"
							placeholder="Description" name='description'>{{monster.description}}</textarea>
					</div>

					<div class="form-group">
						<label for="public">Public or Private</label>
						<select class="form-control" id="public" name="public" ng-model="monster.public">
							<option ng-selected="monster.public=='1'" value="1">Public</option>
							<option  ng-selected="monster.public=='0'" value="0">Private</option>
						</select>
					</div>
				</div>
			</div>
			<!-- Sumbit buttons -->
			<div class="panel-footer">
				<button class="btn btn-primary" type="submit">{{saveOrUpdate}}</button>
				<a href="index.php" class="btn btn-danger">Cancel</a>
			</div>
		</div>

		<!-- Abilities modal -->
		<div id="abilityModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">{{(ability_modal.index == null) ? 'Add' :
							'Edit'}} {{ability_modal.name || 'Ability'}}</h4>
					</div>
					<div class="modal-body">
						<label for="ability_name">Name</label> <input id="ability_name"
							type="text" class="form-control" placeholder="Name"
							ng-model="ability_modal.name"> <label for="ability_description">Description</label>
						<textarea id="ability_description" rows="10"
							placeholder="Description" class="form-control"
							ng-model="ability_modal.description"></textarea>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary"
							ng-click="(ability_modal.index == null) ? abilities.push(ability_modal) : abilities[ability_modal.index] = ability_modal"
							data-dismiss="modal">{{(ability_modal.index == null) ? 'Add' :
							'Save'}}</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Model end -->

		<!-- Actions modal -->
		<div id="actionModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">{{(action_modal.index == null) ? 'Add' :
							'Edit'}} {{action_modal.name || 'Action'}}</h4>
					</div>
					<div class="modal-body">
						<label for="action_name">Name</label> <input id="action_name"
							type="text" class="form-control" placeholder="Name"
							ng-model="action_modal.name"> <label for="action_description">Description</label>
						<textarea id="action_description" rows="10"
							placeholder="Description" class="form-control"
							ng-model="action_modal.description"></textarea>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary"
							ng-click="(action_modal.index == null) ? actions.push(action_modal) : actions[action_modal.index] = action_modal"
							data-dismiss="modal">{{(action_modal.index == null) ? 'Add' :
							'Save'}}</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Model end -->

		<input name="skills" class="hidden" ng-model="skills_text"
			, type="text"> <input name="stats" class="hidden"
			ng-model="stats_text" , type="text"> <input name="languages"
			class="hidden" ng-model="languages_text" , type="text"> <input
			name="abilities" class="hidden" ng-model="abilities_text"
			, type="text"> <input name="actions" class="hidden"
			ng-model="actions_text" , type="text"> <input name="senses"
			class="hidden" ng-model="senses_text" , type="text"> <input
			name="found" class="hidden" ng-model="found_text" , type="text"> <input
			name="hit_points" class="hidden"
			ng-value="getDiceDisplay(monster.hit_points)">

	</form>

</div>

<script src="<?php echo $baseURL;?>resources/roll.js"></script>
<script> 

app.controller("MonsterEditController", ['$scope', "$controller", function($scope, $controller){
	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	angular.extend(this, $controller('rollDisplayController', {$scope: $scope}));
	

	$scope.possible_skills = ["Acrobatics", "Animal Handling", "Arcana","Athletics","Deception","History","Insight","Intimidation","Investigation",
	                      	  "Medicine","Nature","Perception","Performance","Persuasion","Religion","Sleight of Hand","Stealth","Survival"];

	$scope.possible_languages = ['Abyssal','Aquan','Auran','Celestial','Common','Draconic','Druidic','Dwarven','Elven','Giant',
								 'Gnome','Goblin','Gnoll','Halfling','Ignan','Infernal','Orc','Sylvan','Worg','Terran','Undercommon'];
	
	$scope.possible_found = ['Desert','Forest','Fresh Water','Hills','Mountions','Ocean','Plains','Planer','Swamp','Underground','Urban']

	var valueToNumberList = ["speed","armor", 'challenge', 'xp'];
	$scope.statsValues =["strength","dexterity","constitution","intelligence","wisdom","charisma"];
	

	$scope.monster = {};
	$scope.monster.stats = {};
	$scope.skills=[];
	$scope.languages = [];
	$scope.senses = [];
	$scope.abilities = [];
	$scope.actions = [];
	$scope.found_places = [];
	
	$scope.editAbility = function(index){
		if(index != null){
			$scope.ability_modal = clone($scope.abilities[index]);
			$scope.ability_modal.index = index;
		}
		else{
			$scope.ability_modal = {};
		}
	}

	$scope.editAction = function(index){
		if(index != null){
			$scope.action_modal = clone($scope.actions[index]);
			$scope.action_modal.index = index;
		}
		else{
			$scope.action_modal = {};
		}
	}
	
	
	$scope.setMonster = function(monster){
		$scope.monster = convertValuesToNumbers(monster, valueToNumberList);
		$scope.monster.stats = (monster.stats) ? JSON.parse(convertValuesToNumbers($scope.monster.stats, $scope.statsValues)) : {};
		$scope.skills = (monster.skills) ? convertListHashValuesToNumbers($scope.monster.skills.parseEscape(), ['modifer']) : [];
		$scope.languages = (monster.languages) ? $scope.monster.languages.parseEscape() : [];
		$scope.senses = (monster.senses) ? $scope.monster.senses.parseEscape() : [];
		$scope.abilities = (monster.abilities) ? $scope.monster.abilities.parseEscape() : [];
		$scope.actions = (monster.actions) ? $scope.monster.actions.parseEscape() : [];
		$scope.found_places = (monster.found) ? $scope.monster.found.parseEscape() : [];
		$scope.monster.hit_points = (monster.hit_points) ? getDiceValue(monster.hit_points) : {};
		
		$scope.addOrEdit = "Edit";
		$scope.saveOrUpdate = "Update";
	}
	
	$scope.setById($scope.setMonster, function(){
		$scope.getDefaultAccess(function(n){$scope.monster['public'] = n;});
	});
	$scope.saveOrUpdate = "Save";
	$scope.addOrEdit = "Add";
	
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

	$scope.$watch('abilities', function(val){
		$scope.abilities_text = JSON.stringify(val);
	}, true);

	$scope.$watch('actions', function(val){
		$scope.actions_text = JSON.stringify(val);
	}, true);

	$scope.$watch('found_places', function(val){
		$scope.found_text = JSON.stringify(val);
	}, true);
	
	
}]);

</script>