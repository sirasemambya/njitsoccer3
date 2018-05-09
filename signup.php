<?php
	ob_start();
	include("autoload.php");
	autoload('');
?>

<!DOCTYPE html>
<html>

<?php head("NJITsoccer: Sign Up",""); ?>

<body>
	<div class="container-fluid">
		<?php navbar('plain','','index.php','');?>
	</div>
	<div class="container page-content">
		<div class="row">
			<div class="col-md-6 col-md-push-3">
				<div class="panel panel-primary shadow">
		  			<div class="panel-heading">
		    			<h3 class="panel-title">What type of account?</h3>
		  			</div>
		  			<div class="panel-body">
		    			<div class="row">
		    				<div class="col-md-6">
			    				<div class="panel panel-primary signup-choice pointer">
			    					<div class="panel-body text-center">
				    					<h4><strong>Administrator</strong></h4>
				    					<p>Create League</p>
			    					</div>
		    					</div>
	    					</div>
	    					<div class="col-md-6">
			    				<div class="panel panel-primary signup-choice pointer">
			    					<div class="panel-body text-center">
				    				<h4 style="color:white;">	<font size="1">Player</font></h4>
											<h3><strong>Coach</strong></h3>
				    					<p>Manage Team</p>
			    					</div>
		    					</div>
	    					</div>
	    				</div>
		  			</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<p class="text-danger">
			<em>
				<a href='fan2.php'>Are you a fan?</a>
			</em>
		</p>
	</div>
</body>
</html>
