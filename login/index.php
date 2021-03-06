<?php session_start();
	include_once '../config/config.php';
	include_once $serverPath.'utils/db/db_get.php';
	
	$login_ok = false;
	if(!empty($_POST)){
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$table = "users";
			$query = "SELECT * FROM ".getTableQuote($table)." WHERE (username='".$_POST['username']."' OR email='".$_POST['username']."')";
			$user = runQuery($query);
			if(count($user) == 1){
				$user = $user[0];
			}
			if(isset($user['salt']) && isset($user['password']) && isset($user['username']) ){
				$check_password = hash ( 'sha256', $_POST ['password'] . $user['salt'] );
				for($round = 0; $round < 65536; $round ++) {
					$check_password = hash ( 'sha256', $check_password . $user['salt'] );
				}
				
				if ($check_password === $user['password']) {
					// If they do, then we flip this to true
					$login_ok = true;
				}
				
				if ($login_ok) {
					unset ( $user['salt'] );
					unset ( $user ['password'] );
					$_SESSION['user'] = $user;
					
					header ( "Location: ".$baseURL);
					die ( "Redirecting to: admin page" );
					
				}
				else{
					sendErrorMessage("Username not found or password is incorrect");
				}
			
			}else{
				sendErrorMessage("Username not found or password is incorrect");
			}
			
		}
	}
	
	include_once $serverPath.'resources/templates/header.php';
	
?>
<div class="container-fluid">
	<form action="index.php" method="post">
		<div class="row">
			<div class="col-md-6 col-md-offset-3" style="margin-top: 20px">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Login</div>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="username">Username Or Email</label>
							<input class="form-control" id='username' pattern="[a-zA-Z0-9_@.]+" title="Must be a vaild username" type="text" name='username' ng-model='username' required="required" placeholder="Username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input class="form-control" id='password' type="password" name='password' ng-model='password' required="required" placeholder="Password">
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Login</button>
							<a class="btn btn-danger" href="<?php echo $baseURL;?>">Cancel</a>
						</div>
						<div class="form-group">
							<a href="createAccount.php">Create Account</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

