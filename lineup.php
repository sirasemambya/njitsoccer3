<?php
	ob_start();
	session_start();
	$filepath = "";

	include($filepath . "autoload2.php");
	autoload($filepath);

	include($filepath . "session-status.php");
	include($filepath . "session-school-redirect.php");

	try {
		include($filepath . "connect-to-db.php");

		# Gets the players to display
		if(isset($league_selected) and !isset($team_selected)) {
			$pl_sql = "SELECT CONCAT(First,' ',Last) AS name,StudentEmail FROM eligibility AS e INNER JOIN players AS p ON e.PlayerID=p.PlayerID INNER JOIN jointeam AS j ON p.PlayerID=j.PlayerID INNER JOIN teams AS t ON j.TeamID=t.TeamID WHERE SchoolID=:schoolid AND LeagueID=:leagueid ORDER BY Last;";
			$pl_statement = $pdo->prepare($pl_sql);
			$pl_statement->bindValue(':leagueid', $leagueid);
		} elseif(isset($league_selected) and isset($team_selected)) {
			$pl_sql = "SELECT CONCAT(First,' ',Last) AS name,StudentEmail FROM eligibility AS e INNER JOIN players AS p ON e.PlayerID=p.PlayerID INNER JOIN jointeam AS j ON p.PlayerID=j.PlayerID INNER JOIN teams AS t ON j.TeamID=t.TeamID WHERE SchoolID=:schoolid AND LeagueID=:leagueid AND t.TeamID=:teamid ORDER BY Last;";
			$pl_statement = $pdo->prepare($pl_sql);
			$pl_statement->bindValue(':leagueid', $leagueid);
			$pl_statement->bindValue(':teamid', $teamid);
		} else {
			$pl_sql = "SELECT CONCAT(First,' ',Last) AS name,StudentEmail FROM eligibility AS e INNER JOIN players AS p ON e.PlayerID=p.PlayerID WHERE SchoolID=:schoolid ORDER BY Last;";
			$pl_statement = $pdo->prepare($pl_sql);
		}

		$pl_statement->bindValue(':schoolid', $schoolid);
		$pl_statement->execute();

		$pdo = null;
	}
	catch (PDOException $e) {
		die($e->getMessage());
	}

	if(isset($_POST['playeremail'])) {
		$playeremail = true;
		$message = $_POST['message'];
		$league = $_POST['hleague'];
		$team = $_POST['hteam'];
	} else {
		$playeremail = false;
	}
?>

<!DOCTYPE html>
<html>

<?php
	head("Players",$filepath);
?>

<body>
	<div class="container-fluid">
		<?php navbar('school',$filepath,$filepath . 'index.php',$schoolname);?>
	</div>
	<div class="container page-content">
		<?php if($playeremail){?>
		<div class="row">
			<div class="col-md-12">


				</div>
			</div>
		</div>
		<?php }?>

		<div class="row">
			<div class="col-md-2">
				<h2><strong>Starting Lineup</strong></h2>
			</div>

				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-hover table-responsive">
					<thead>
						<tr>
							<th>Name</th>
							<th>Players Preferred Position</th>
							<th>Change Position</th>
						</tr>
					</thead>
					<tbody>

						<?php  $con=mysqli_connect("localhost","root","root","NJITsoccer");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						$starters = 'CALL starters()';
						$result = mysqli_query($con, $starters);

						while($row = mysqli_fetch_array($result))
						{

							echo "<tr>";
							echo "<td>" . $row['gk'] . "</td>";
							echo "<td>" . "Goalkeeper" . "</td>";
							echo "<form action=starts.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";



							echo "<tr>";
							echo "<td>" . $row['def1'] . "</td>";
							echo "<td>" . "Defender" . "</td>";
							echo "<form action=start1s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['def2'] . "</td>";
							echo "<td>" . "Defender" . "</td>";
							echo "<form action=start2s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['def3'] . "</td>";
							echo "<td>" . "Defender" . "</td>";
							echo "<form action=start3s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['mid1'] . "</td>";
							echo "<td>" . "Midfielder" . "</td>";
							echo "<form action=start4s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['mid2'] . "</td>";
							echo "<td>" . "Midfielder" . "</td>";
							echo "<form action=start5s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['mid3'] . "</td>";
							echo "<td>" . "Midfielder" . "</td>";
							echo "<form action=start6s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['for1'] . "</td>";
							echo "<td>" . "Forward" . "</td>";
							echo "<form action=start7s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['for2'] . "</td>";
							echo "<td>" . "Forward" . "</td>";
							echo "<form action=start8s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['fr'] . "</td>";
							echo "<td>" . "Free Role" . "</td>";
							echo "<form action=start9s.php method=get>";
							echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
							echo "</form>";
							echo "</tr>";

						}
						echo "</table>";
						mysqli_close($con);
						?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
