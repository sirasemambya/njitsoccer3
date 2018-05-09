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
							<th>Position</th>
						</tr>
					</thead>
					<tbody>

						<?php  $con=mysqli_connect("localhost","root","root","NJITsoccer");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						$result = mysqli_query($con,"SELECT * FROM team WHERE ID = 2 ");

						while($row = mysqli_fetch_array($result))
						{
							if ($row['start'] == 1) {
								echo "<tr>";
								echo "<td>" . $row['gk'] . "</td>";
								echo "<td>" . $row['pos'] . "</td>";
								echo "</tr>";
							}

							if ($row['def1s'] == 1) {
								echo "<tr>";
								echo "<td>" . $row['def1'] . "</td>";
								echo "<td>" . $row['pos1'] . "</td>";
								echo "</tr>";
							}

					if ($row['def2s'] == 1) {
						echo "<tr>";
						echo "<td>" . $row['def2'] . "</td>";
						echo "<td>" . $row['pos2'] . "</td>";
						echo "</tr>";
					}

					if ($row['def3s'] == 1) {
						echo "<tr>";
						echo "<td>" . $row['def3'] . "</td>";
						echo "<td>" . $row['pos3'] . "</td>";
						echo "</tr>";
					}
					if ($row['mid1s'] == 1) {
						echo "<tr>";
						echo "<td>" . $row['mid1'] . "</td>";
						echo "<td>" . $row['pos4'] . "</td>";
						echo "</tr>";
					}
					if ($row['mid2s'] == 1) {
						echo "<tr>";
						echo "<td>" . $row['mid2'] . "</td>";
						echo "<td>" . $row['pos5'] . "</td>";
						echo "</tr>";
					}
					if ($row['mid3s'] == 1) {
						echo "<tr>";
						echo "<td>" . $row['mid3'] . "</td>";
						echo "<td>" . $row['pos6'] . "</td>";
						echo "</tr>";
					}
					if ($row['for1s'] == 1) {
						echo "<tr>";
						echo "<td>" . $row['for1'] . "</td>";
						echo "<td>" . $row['pos7'] . "</td>";
						echo "</tr>";
					}
					if ($row['for2s'] == 1) {
						echo "<tr>";
						echo "<td>" . $row['for2'] . "</td>";
						echo "<td>" . $row['pos8'] . "</td>";
						echo "</tr>";
					}
					if ($row['frs'] == 1) {
						echo "<tr>";
						echo "<td>" . $row['fr'] . "</td>";
						echo "<td>" . $row['pos9'] . "</td>";
						echo "</tr>";
					}
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
