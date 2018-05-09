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
						echo "<td><a href='delete.php?Coach=".$row['Coach']."'>Delete</a></td>";
						echo "<form action=update10.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Goalkeeper" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['gk'] . "</td>";
						echo "<td><a href='delete1.php?gk=".$row['gk']."'>Delete</a></td>";
						echo "<form action=update.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Defender" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['def1'] . "</td>";
						echo "<td><a href='delete2.php?def1=".$row['def1']."'>Delete</a></td>";
						echo "<form action=update1.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['def2'] . "</td>";
						echo "<td><a href='delete3.php?def2=".$row['def2']."'>Delete</a></td>";
						echo "<form action=update2.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['def3'] . "</td>";
						echo "<td><a href='delete4.php?def3=".$row['def3']."'>Delete</a></td>";
						echo "<form action=update3.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Midfielder" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['mid1'] . "</td>";
						echo "<td><a href='delete5.php?mid1=".$row['mid1']."'>Delete</a></td>";
						echo "<form action=update4.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['mid2'] . "</td>";
						echo "<td><a href='delete6.php?mid2=".$row['mid2']."'>Delete</a></td>";
						echo "<form action=update5.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['mid3'] . "</td>";
						echo "<td><a href='delete7.php?mid3=".$row['mid3']."'>Delete</a></td>";
						echo "<form action=update6.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Forward" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['for1'] . "</td>";
						echo "<td><a href='delete8.php?for1=".$row['for1']."'>Delete</a></td>";
						echo "<form action=update7.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>" . $row['for2'] . "</td>";
						echo "<td><a href='delete9.php?for2=".$row['for2']."'>Delete</a></td>";
						echo "<form action=update8.php method=get>";
						echo "<td>" . "<input type=text name=name> <input type=submit name=Submit value=update />" . "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<td>" . "" . "</td>";
						echo "</tr>";

						echo "<tr>";
						echo "<td>" . "<font size='4'>" . "Free Role" . "</td>" . "</font>";
						echo "<tr>";
						echo "<td>" . $row['fr'] . "</td>";
						echo "<td><a href='delete10.php?fr=".$row['fr']."'>Delete</a></td>";
						echo "<form action=update9.php method=get>";
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
