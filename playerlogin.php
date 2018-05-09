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
		$ID = $_POST['ID'];

		try {
			include($filepath . "connect-to-db.php");

			$sql = "SELECT COUNT(*) FROM coachaccount WHERE ID=:ID";
			$statement = $pdo->prepare($sql);
			$statement->bindValue(':ID', $ID);
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
		$ID = $_POST['ID'];
		$first = $_POST['firstname'];
		$last = $_POST['lastname'];
		$email = $_POST['email'];
		$password = md5($password);
		$email = ($email);

		try {
			include($filepath . "connect-to-db.php");

			$sql = "SELECT COUNT(*) FROM coachaccount WHERE Email=:email";
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
					$isql = "INSERT INTO coach (ID, email, password) VALUES ('$ID', '$email', '$password')";
					$istatement = $pdo->prepare($isql);
					$istatement->bindValue(':ID', $ID);
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
				$_SESSION['ID'] = $ID;
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
		    			<h3 class="panel-title">Login</h3>
		  			</div>
		  			<div class="panel-body">
						<form class="form-horizontal" method="post" action="playerlogin.php" id="signup-form">

							<?php if(isset($not_valid)) {?>
							<p class="text-danger"><strong>According to <?php echo $ID;?>'s records, you are not an eligible participant for intramural sports. Contact their intramural office with questions.</strong></p>
							<?php }?>

							<fieldset>
								<div class="form-group">
									<label for="firstname" class="col-md-4 control-label">Team</label>
									<div class="col-md-8">
										<select name="ID">
<?php  $con=mysqli_connect("localhost","root","root","NJITsoccer");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con,"SELECT * FROM team");

while($row = mysqli_fetch_array($result))
{
echo "<option value=" . $row['ID'] . ">" . $row['teamname'] . "</option>";}
?>
</select>
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
										<button type="submit" class="btn btn-primary" id="accountsubmit" name="accountsubmit">Login</button>
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
