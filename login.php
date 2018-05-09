<?php
//include config
require_once('config.php');

if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];

	if($user->login($email,$password)){
		$_SESSION['email'] = $email;
		<meta http-equiv="refresh" content="5; url=https://web.njit.edu/~sbs43/NJITsoccer2/team2.php">
		exit;

	} else {
		$error[] = 'Wrong email or password or your account has not been activated.';
	}
}//end if submit
//define page title
$title = 'Login';
//include header template
?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Please Login</h2>
				<p><a href='./'>Back to home page</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				if(isset($_GET['action'])){
					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}
				}

				?>

				<div class="form-group">
					<input type="text" name="email" id="email" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>

				<div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9">
						 <a href='reset.php'>Forgot your Password?</a>
					</div>
				</div>

				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>



</div>
