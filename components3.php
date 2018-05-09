<?php
	# Adds all the links to each page of the website
	function head($pageName,$filepath) { ?>
	<head>
		<title><?php echo $pageName?></title>
		<link href="<?php echo $filepath;?>css/flatly.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $filepath;?>css/style.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $filepath;?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="<?php echo $filepath;?>jQuery/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?php echo $filepath;?>js/jquery.color.min.js"></script>
		<script type="text/javascript" src="<?php echo $filepath;?>js/script.js"></script>
	  	<script type="text/javascript" src="<?php echo $filepath;?>js/bootstrap.min.js"></script>
	  	<script type="text/javascript" src="<?php echo $filepath;?>js/jquery.validate.min.js"></script>
	  	<script type="text/javascript" src="<?php echo $filepath;?>js/moment.min.js"></script>
	  	<script type="text/javascript" src="<?php echo $filepath;?>js/bootstrap-datetimepicker.min.js"></script>
	</head>
<?php }

	# Adds the navigation bar to each webpage
	function navbar($type,$filepath,$homelink,$name) {?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
	<?php if($type!=='plain') {?>
	  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-to-collapse" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
	  			</button>
	<?php }?>
				<a class="navbar-brand" href="<?php echo $homelink;?>">
					<img src="<?php echo $filepath;?>images/logo.png"/>
				</a>
			</div>
	<?php if($type!=='plain') {?>
			<div class="navbar-collapse collapse" id="navbar-to-collapse" aria-expanded="false">
	<?php if($type=='school') {?>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo $filepath;?>team2.php">Team List</a></li>
					<li><a href="<?php echo $filepath;?>teams2.php">Rosters</a></li>
					<li><a href="<?php echo $filepath;?>players3.php">Statistics</a></li>
					<li><a href="<?php echo $filepath;?>schedule2.php">Schedule</a></li>
					<!-- <li><a href="<?php echo $filepath;?>standings.php">Standings</a></li> -->
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $name;?> <span class="caret"></span></a>
					</li>
					<li><a href="<?php echo $filepath;?>logout.php">Log Out</a></li>
				</ul>
	<?php } elseif($type=='player') {?>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo $filepath;?>myteams.php">My Teams</a></li>
					<!-- <li><a href="<?php echo $filepath;?>standings.php">Standings</a></li> -->
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;<?php echo $name;?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#" data-toggle="tooltip" data-placement="left" title="PHASE II Functionality">Account Information</a></li>
							<li><a href="<?php echo $filepath;?>account/availability.php">Availability</a></li>
						</ul>
					</li>
					<li><a href="<?php echo $filepath;?>logout.php">Log Out</a></li>
				</ul>
	<?php } elseif($type=='referee') {?>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo $filepath;?>schedule.php">Schedule</a></li>
					<!-- <li><a href="<?php echo $filepath;?>standings.php">Standings</a></li> -->
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;<?php echo $name;?></a>
					<li><a href="<?php echo $filepath;?>logout.php">Log Out</a></li>
				</ul>
	<?php } elseif($type=='home') {?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="" data-toggle="modal" data-target="#login">Log In</a></li>
					<li><a href="signup.php">Sign Up</a></li>
				</ul>
	<?php }?>
			</div>
	<?php }?>
		</div>
	</nav>

<?php }



?>
