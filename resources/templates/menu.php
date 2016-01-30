<div ng-controller="MenuController">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					aria-expanded="false">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $baseURL;?>">Aesop</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown"><a class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false">View Assets <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $baseURL;?>assets/characters/">Characters</a></li>
							<li><a href="<?php echo $baseURL;?>assets/settlements/">Settlements</a></li>
							<li><a href="<?php echo $baseURL;?>assets/taverns/">Taverns</a></li>
							<li><a href="<?php echo $baseURL;?>assets/dungeons/">Dungeons</a></li>
							<li><a href="<?php echo $baseURL;?>assets/traps/">Traps</a></li>
							<li><a href="<?php echo $baseURL;?>assets/monsters/">Monsters</a></li>
							<li><a href="<?php echo $baseURL;?>assets/villains/">Villains</a></li>
							<li><a href="<?php echo $baseURL;?>assets/encounters/riddles/">Riddles</a></li>
							<li><a href="<?php echo $baseURL;?>assets/encounters/urban/">Urban
									Encounters</a></li>
							<li><a href="<?php echo $baseURL;?>assets/encounters/forest/">Forest
									Encounters</a></li>
							<li><a href="<?php echo $baseURL;?>assets/spells/">Spells</a></li>
						</ul></li>
				</ul>
				<ul class="nav navbar-nav">
					<li class="dropdown"><a class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false">Quick Create <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $baseURL;?>assets/characters/create.php">Characters</a></li>
							<li><a href="<?php echo $baseURL;?>assets/settlements/create.php">Settlements</a></li>
							<li><a href="<?php echo $baseURL;?>assets/taverns/create.php">Taverns</a></li>
							<li><a href="<?php echo $baseURL;?>assets/dungeons/create.php">Dungeon</a></li>
							<li><a href="<?php echo $baseURL;?>assets/monsters/create.php">Monster</a></li>
							<li><a href="<?php echo $baseURL;?>assets/villains/create.php">Villains</a></li>
						</ul></li>
				</ul>
				<ul class="nav navbar-nav">
					<li class="dropdown"><a class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-haspopup="true"
						aria-expanded="false">Enounters<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a
								href="<?php echo $baseURL;?>assets/encounters/riddles/getRandom.php">Riddles</a></li>
							<li><a
								href="<?php echo $baseURL;?>assets/encounters/urban/getRandom.php">Urban</a></li>
							<li><a
								href="<?php echo $baseURL;?>assets/encounters/forest/getRandom.php">Forest</a></li>
						</ul></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li ng-hide="loggedIn"><a href="<?php echo $baseURL;?>login/">Login</a> 
					<li ng-show="loggedIn" class="dropdown" >
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, {{me.first_name || me.username}}<span class="caret"></span></a>
			          <ul class="dropdown-menu" style="background-color:foralwhite;">
			          	<li><a href="<?php echo $baseURL;?>profile/">My Profile</a></li>
			          	<li><a href="<?php echo $baseURL;?>profile/myCharacters.php">My Characters</a></li>
			          	<li><a href="<?php echo $baseURL;?>profile/myCampaigns.php">My Campaigns</a></li>
			          	<li ng-show="me.admin==1"><a href="<?php echo $baseURL;?>admin/">Admin</a></li>
				        <li><a href="<?php echo $baseURL;?>login/logout.php">Sign out</a></li>
			          </ul>
			        </li>
		        </ul>
	
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse"
					id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="dropdown"><a class="dropdown-toggle"
							data-toggle="dropdown" role="button" aria-haspopup="true"
							aria-expanded="false">Custom Create<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo $baseURL;?>assets/characters/edit.php">Characters</a></li>
								<li><a href="<?php echo $baseURL;?>assets/settlements/edit.php">Settlements</a></li>
								<li><a href="<?php echo $baseURL;?>assets/taverns/edit.php">Taverns</a></li>
								<li><a href="<?php echo $baseURL;?>assets/dungeons/edit.php">Dungeons</a></li>
								<li><a href="<?php echo $baseURL;?>assets/traps/edit.php">Traps</a></li>
								<li><a href="<?php echo $baseURL;?>assets/monsters/edit.php">Monsters</a></li>
								<li><a href="<?php echo $baseURL;?>assets/villains/edit.php">Villains</a></li>
								<li><a
									href="<?php echo $baseURL;?>assets/encounters/riddles/edit.php">Riddles</a></li>
								<li><a
									href="<?php echo $baseURL;?>assets/encounters/urban/edit.php">Urban
										Encounters</a></li>
								<li><a
									href="<?php echo $baseURL;?>assets/encounters/forest/edit.php">Forest
										Encounters</a></li>
								<li><a href="<?php echo $baseURL;?>assets/spells/edit.php">Spells</a></li>
							</ul></li>
					</ul>
					<ul class="nav navbar-nav">
						<li class="dropdown"><a class="dropdown-toggle"
							data-toggle="dropdown" role="button" aria-haspopup="true"
							aria-expanded="false">Traits<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo $baseURL;?>assets/traits/characters/">Characters</a></li>
								<li><a href="<?php echo $baseURL;?>assets/traits/settlements/">Settlements</a></li>
								<li><a href="<?php echo $baseURL;?>assets/traits/taverns/">Taverns</a></li>
								<li><a href="<?php echo $baseURL;?>assets/traits/dungeons/">Dungeon</a></li>
								<li><a href="<?php echo $baseURL;?>assets/traits/villains/">Villains</a></li>
							</ul></li>
					</ul>
				</div>
			</div>
			<input  id="myId" class="hidden" type="text" value="<?php if(!empty($_SESSION['user'])){echo $_SESSION['user']['id'];}?>">
	</nav>
</div>

<script type="text/javascript">
app.controller("MenuController", ['$scope', "$controller", function($scope, $controller){

	angular.extend(this, $controller('UtilsController', {$scope: $scope}));
	if($('#myId').val()){
		$scope.setFromGet("<?php echo $baseURL;?>login/myData.php", function(data){
			$scope.me = data[0];
			
			$scope.loggedIn = true;	
		});
	}else{
		$scope.loggedIn = false;
	}


}]);	
</script>

