<?php
	ob_start();
	session_start();
	$filepath = "";

	include($filepath . "autoload.php");
	autoload($filepath);

	# redirect to respective "home" pages if users are already logged on to NJITsoccer
	if(isset($_SESSION['schoolid'])) {
		header("Location: team.php");
	} elseif(isset($_SESSION['playerid'])) {
		header("Location: myteams.php");
	} elseif(isset($_SESSION['refid'])) {
		header("Location: schedule.php");
	}

	if(isset($_POST['submitschool'])) {
		$submitschool = true;
		$fan = $_POST['fan'];

		try {
			include($filepath . "connect-to-db.php");

			$sql = "SELECT COUNT(*) FROM fan";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(':fan', $fan);
			$statement->execute();
			$rowCount = $statement->fetchColumn(0);

			if($rowCount > 0) {
				$duplicateschool = true;
				$pdo = null;
			}

			$pdo = null;
		}
		catch (PDOException $e) {
			die($e->getMessage());
		}
	} elseif(isset($_POST['accountsubmit'])) {
		$fan = $_POST['fan'];
		$first = $_POST['firstname'];
		$last = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['phonenumber'];
		$password = $_POST['cpassword'];

		try {
			include($filepath . "connect-to-db.php");

			$sql = "SELECT COUNT(*) FROM schoolaccount WHERE Email=:email";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(':email', $email);
			$statement->execute();
			$rowCount = $statement->fetchColumn(0);

			if($rowCount > 0) {
				$duplicateemail = true;
				$pdo = null;
			} else {
				try {
					#begin the Insert transaction
					$pdo->beginTransaction();

					# Insert school account fields into database
					$isql = "INSERT INTO fan (first, last, email, password) VALUES ('$first', '$last', '$email', '$password')";
					$istatement = $pdo->prepare($isql);
					$istatement->bindValue(':first', $first);
					$istatement->bindValue(':last', $last);
					$istatement->bindValue(':email', $email);
					$istatement->bindValue(':password', $password);
					$istatement->execute();
					$lastID = $pdo->lastInsertId();

					#commit the transaction
					$pdo->commit();
				} catch (Exception $e) {
					#rollback if there were any failures
					$pdo->rollback();
				}

				$pdo = null;

				$_SESSION['schoolid'] = $lastID;
				$_SESSION['fan'] = $fan;
				header("Location: teamscoach.php?ac=1");
			}
		}
		catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	if(isset($duplicateemail)) {
		$de=true;
	} else {
		$de=false;
	}

?>

<!DOCTYPE html>
<html>

<?php
	head("LeagueShark: Sign Up",$filepath);
?>

<body>
	<div class="container-fluid">
		<?php navbar('plain',$filepath,'index.php','');?>
	</div>
	<div class="container page-content">
		<div class="row">
			<div class="col-md-6 col-md-push-3">
				<div class="panel panel-primary shadow">
		  			<div class="panel-heading">
		    			<h3 class="panel-title">Create a player account</h3>
		  			</div>
		  			<div class="panel-body">
						<form class="form-horizontal" method="post" action="team2.php" id="signup-form">

							<?php if(isset($not_valid)) {?>
							<p class="text-danger"><strong>According to <?php echo $fan;?>'s records, you are not an eligible participant for intramural sports. Contact their intramural office with questions.</strong></p>
							<?php }?>

							<fieldset>
								<div class="form-group">
									<label for="firstname" class="col-md-4 control-label">First Name</label>
									<div class="col-md-8">
										<input class="form-control" id="firstname" name="firstname" type="text" value="<?php if(isset($duplicate_email)){echo $firstname;}?>" required>
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-md-4 control-label">Last Name</label>
									<div class="col-md-8">
										<input class="form-control" id="lastname" name="lastname" type="text" value="<?php if(isset($duplicate_email)){echo $lastname;}?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-md-4 control-label">Email</label>
									<div class="col-md-8">
										<input class="form-control" id="email" name="email" type="email" data-toggle="tooltip" data-placement="top" title="Use your school email" required>

										<?php if(isset($duplicate_email)) {?>
										<p class="text-danger">*The email address <?php echo $email;?> already has an account.</p>
										<?php }?>

									</div>
								</div>


								<hr>
								<div class="form-group">
									<label for="password" class="col-md-4 control-label">Password</label>
									<div class="col-md-8">
										<input class="form-control" id="password" name="password" type="password" required>
									</div>
								</div>
								<div class="form-group">
									<label for="cpassword" class="col-md-4 control-label">Confirm Password</label>
									<div class="col-md-8">
										<input class="form-control" id="cpassword" name="cpassword" type="password" required>
										<p id="password-error" class="text-danger"></p>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-8 col-md-push-4">
										<button type="submit" class="btn btn-primary" id="accountsubmit" name="accountsubmit">Create Account</button>
									</div>
								</div>
								<input type="hidden" id="ac" name="ac" value="true">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
