<?php
	ob_start();
	session_start();
	$filepath = "";

	include($filepath . "autoload.php");
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
				<h2><strong>Statistics</strong></h2>
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
							<th>Position</th>
							<th>Starts</th>
							<th>Goals</th>
							<th>Assist</th>
							<th>Saves</th>
							<th>Team</th>
						</tr>
					</thead>
					<tbody>

						<?php  $con=mysqli_connect("localhost","root","root","NJITsoccer");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						$result = mysqli_query($con,"SELECT * FROM team ");

						while($row = mysqli_fetch_array($result))
						{

							echo "<tr>";
							echo "<td>" . $row['gk'] . "</td>";
							echo "<td>" . "Goalkeeper" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(0, 0) . "</td>";
							echo "<td>" . rand(0, 2) . "</td>";
							echo "<td>" . rand(5, 20) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['def1'] . "</td>";
							echo "<td>" . "Defender" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(0, 5) . "</td>";
							echo "<td>" . rand(0, 4) . "</td>";
							echo "<td>" . rand(0, 0) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['def3'] . "</td>";
							echo "<td>" . "Defender" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(0, 5) . "</td>";
							echo "<td>" . rand(0, 4) . "</td>";
							echo "<td>" . rand(0, 0) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['mid1'] . "</td>";
							echo "<td>" . "Midfielder" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(2, 8) . "</td>";
							echo "<td>" . rand(4, 13) . "</td>";
							echo "<td>" . rand(0, 0) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['mid2'] . "</td>";
							echo "<td>" . "Midfielder" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(2, 8) . "</td>";
							echo "<td>" . rand(4, 13) . "</td>";
							echo "<td>" . rand(0, 0) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['mid3'] . "</td>";
							echo "<td>" . "Midfielder" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(2, 8) . "</td>";
							echo "<td>" . rand(4, 13) . "</td>";
							echo "<td>" . rand(0, 0) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['for1'] . "</td>";
							echo "<td>" . "Forward" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(5, 15) . "</td>";
							echo "<td>" . rand(3, 10) . "</td>";
							echo "<td>" . rand(0, 0) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['for2'] . "</td>";
							echo "<td>" . "Forward" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(5, 15) . "</td>";
							echo "<td>" . rand(3, 10) . "</td>";
							echo "<td>" . rand(0, 0) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
							echo "</tr>";

							echo "<tr>";
							echo "<td>" . $row['fr'] . "</td>";
							echo "<td>" . "Free Role" . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(0, 15) . "</td>";
							echo "<td>" . rand(0, 10) . "</td>";
							echo "<td>" . rand(0, 10) . "</td>";
							echo "<td>" . $row['teamname'] . "</td>";
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
