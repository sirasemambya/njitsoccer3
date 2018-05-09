<?php
	ob_start();
	session_start();
	$filepath = "";


	include($filepath . "autoload3.php");
	autoload($filepath);


	try {
		include($filepath . "connect-to-db.php");

		# Get the leagues associated with the school account to populate the select input
		include($filepath . "queries/select_leagues.php");

		# Determine the league to display teams from
		if(isset($_POST['league'])) {
			$leagueid = $_POST['league'];
		} else {
			$first_league_row = $first_league_statement->fetch();
			$leagueid = $first_league_row['LeagueID'];
		}

		# Gets the teams to display
		$lg_sql = "SELECT TeamName,SignUpDateTime,Type,CONCAT(First,' ',Last) AS name FROM teams AS t INNER JOIN players AS p ON t.ManagerID=p.PlayerID WHERE LeagueID=:leagueid ORDER BY SignUpDateTime;";
		$lg_statement = $pdo->prepare($lg_sql);
		$lg_statement->bindValue(':leagueid', $leagueid);
		$lg_statement->execute();

		# Get the count of players for each team
		$pcount_sql = "SELECT t.TeamID,COUNT(PlayerID) AS pcount FROM jointeam AS j INNER JOIN teams AS t ON j.TeamID=t.TeamID WHERE LeagueID=:leagueid GROUP BY t.TeamID ORDER BY SignUpDateTime;";
		$pcount_statement = $pdo->prepare($pcount_sql);
		$pcount_statement->bindValue(':leagueid', $leagueid);
		$pcount_statement->execute();

		$pdo = null;
	}
	catch (PDOException $e) {
		die($e->getMessage());
	}
?>

<!DOCTYPE html>
<html>

<?php
	head("Teams",$filepath);
?>

<body>
	<div class="container-fluid">
		<?php navbar('school',$filepath,$filepath . 'index.php',$schoolname);?>
	</div>
	<div class="container page-content">
		<div class="row">
			<div class="col-md-6">
				<h2><strong>Teams</strong></h2>
			</div>
			<div class="col-md-6">
				<form class="form-horizontal pull-right" id="teams-select-league" method="post" action="teams.php">
					<fieldset>
						<div class="form-group menu-form-group">

							<div class="col-md-8">

							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-hover table-responsive">

					<tbody>


							<?php  $con=mysqli_connect("localhost","root","root","NJITsoccer");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						$result = mysqli_query($con,"SELECT * FROM team");

						while($row = mysqli_fetch_array($result))
						{
						echo "<tr>";
						echo "<th>" . "<font size='6'>" . $row['teamname'] . "</th>" . "</font>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Coach" . "</td>" . "</font>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['Coach'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Goalkeeper" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['gk'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Defender" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['def1'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['def2'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['def3'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Midfielder" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['mid1'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['mid2'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['mid3'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Forward" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['for1'] . "</td>";

						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['for2'] . "</td>";

						echo "</tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Free Role" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['fr'] . "</td>";

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
