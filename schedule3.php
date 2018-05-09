<?php
	ob_start();
	session_start();
	$filepath = "";

	include($filepath . "autoload.php");
	autoload($filepath);

	include($filepath . "session-status.php");
	if($playeraccount) {
		header("Location: index.php?error=session_rs");
	}

	try {
		include($filepath . "connect-to-db.php");

		if(isset($_POST['submitgame'])) {
			$addgame = true;
			$addlocation = false;

			$hometeam = $_POST['hometeam'];
			$awayteam = $_POST['awayteam'];
			$time = date_format(date_create($_POST['time']),'Y-m-d H:i:s');
			$location = $_POST['location'];

			try {
				#begin the Insert transaction
				$pdo->beginTransaction();

				# Insert new record into games table
				$insert_game_sql = "INSERT INTO games (GameDateTime, LocationID) VALUES (:time, :location)";
				$insert_game_statement = $pdo->prepare($insert_game_sql);
				$insert_game_statement->bindValue(':time', $time);
				$insert_game_statement->bindValue(':location', $location);
				$insert_game_statement->execute();
				$gameid = $pdo->lastInsertId();

				# Insert new records into gameassignment table
				$insert_ga_sql = "INSERT INTO gameassignment (GameId, TeamID, HomeAway) VALUES (:gameid, :teamid, :homeaway)";
				$insert_ga_statement = $pdo->prepare($insert_ga_sql);
				$insert_ga_statement->bindValue(':gameid', $gameid);

				$insert_ga_statement->bindValue(':teamid', $hometeam);
				$insert_ga_statement->bindValue(':homeaway', 'home');
				$insert_ga_statement->execute();

				$insert_ga_statement->bindValue(':teamid', $awayteam);
				$insert_ga_statement->bindValue(':homeaway', 'away');
				$insert_ga_statement->execute();

				#commit the transaction
				$pdo->commit();
			} catch (Exception $e) {
				#rollback if there were any failures
				$pdo->rollback();
			}

		} elseif(isset($_POST['submitlocation'])) {
			$addlocation = true;
			$addgame = false;

			$lname = $_POST['lname'];
			$street1 = $_POST['street1'];
			$street2 = $_POST['street2'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			$description = $_POST['description'];

			try {
				#begin the Insert transaction
				$pdo->beginTransaction();

				# Insert new record into locations table
				$insert_location_sql = "INSERT INTO locations (SchoolID, LocationName, Street1, Street2, City, State, Zip, Description)
					VALUES (:schoolid, :lname, :street1, :street2, :city, :state, :zip, :description)";
				$insert_location_statement = $pdo->prepare($insert_location_sql);
				$insert_location_statement->bindValue(':schoolid', $schoolid);
				$insert_location_statement->bindValue(':lname', $lname);
				$insert_location_statement->bindValue(':street1', $street1);
				$insert_location_statement->bindValue(':street2', $street2);
				$insert_location_statement->bindValue(':city', $city);
				$insert_location_statement->bindValue(':state', $state);
				$insert_location_statement->bindValue(':zip', $zip);
				$insert_location_statement->bindValue(':description', $description);
				$insert_location_statement->execute();

				#commit the transaction
				$pdo->commit();
			} catch (Exception $e) {
				#rollback if there were any failures
				$pdo->rollback();
			}

		} else {
			$addgame = false;
			$addlocation = false;
		}

		# Populate the league and team select inputs

		# Get the leagues associated with the school account to populate the select input
		include($filepath . "queries/select_leagues.php");

		# Create array for leagues result set
		$leagues = array();
		while($l_row = $leagues_statement->fetch()) {
			$leagues[] = $l_row;
		}

		if(isset($_POST['league'])) {
			$leagueid = $_POST['league'];
			$teamid = $_POST['team'];

			if($leagueid!=='all') {
				$league_selected = true;

				# Get the name of the league
				$leaguename_sql = "SELECT LeagueName FROM leagues WHERE LeagueID=:leagueid";
				$leaguename_statement = $pdo->prepare($leaguename_sql);
				$leaguename_statement->bindValue(':leagueid', $leagueid);
				$leaguename_statement->execute();
				$leaguename_row = $leaguename_statement->fetch();
				$leaguename = $leaguename_row['LeagueName'];

				# Get the teams in the league to populate the team select input
				$teams_sql = "SELECT TeamID,TeamName FROM teams AS t INNER JOIN leagues AS l ON t.LeagueID=l.LeagueID WHERE l.LeagueID=:leagueid ORDER BY TeamName;";
				$teams_statement = $pdo->prepare($teams_sql);
				$teams_statement->bindValue(':leagueid', $leagueid);
				$teams_statement->execute();

				# Create array for teams result set
				$teams = array();
				while($t_row = $teams_statement->fetch()) {
					$teams[] = $t_row;
				}

				if($teamid!=='all') {
					$teamid = $_POST['team'];
					$team_selected = true;
				}

				# Get the locations
				$locations_sql = "SELECT LocationID,LocationName FROM locations WHERE SchoolID=:schoolid ORDER BY LocationName;";
				$locations_statement = $pdo->prepare($locations_sql);
				$locations_statement->bindValue(':schoolid', $schoolid);
				$locations_statement->execute();
			}
		}

		# Get the games to display
		if(isset($league_selected)) {
			$games_sql = "SELECT th.TeamName AS Home,th.TeamID AS HomeID,ta.TeamName AS Away,ta.TeamID AS AwayID,l.LocationName,GameDateTime,th.LeagueID
				FROM games AS g, locations AS l, gameassignment AS ah, teams AS th, gameassignment AS aa, teams AS ta
				WHERE g.LocationID=l.LocationID AND g.GameID=ah.GameID AND g.GameID=aa.GameID AND ah.TeamID=th.TeamID AND aa.TeamID=ta.TeamID
				AND ah.HomeAway='home' AND aa.HomeAway='away' AND th.LeagueID=:leagueid ORDER BY GameDateTime;";
			$games_statement = $pdo->prepare($games_sql);
			$games_statement->bindValue(':leagueid', $leagueid);
		} else {
			$games_sql = "SELECT l.SchoolID,th.TeamName AS Home,th.TeamID AS HomeID,ta.TeamName AS Away,ta.TeamID AS AwayID,l.LocationName,GameDateTime
				FROM games AS g, locations AS l, gameassignment AS ah, teams AS th, gameassignment AS aa, teams AS ta
				WHERE g.LocationID=l.LocationID AND g.GameID=ah.GameID AND g.GameID=aa.GameID AND ah.TeamID=th.TeamID AND aa.TeamID=ta.TeamID
				AND ah.HomeAway='home' AND aa.HomeAway='away' AND SchoolID=:schoolid ORDER BY GameDateTime;";
			$games_statement = $pdo->prepare($games_sql);
			$games_statement->bindValue(':schoolid', $schoolid);
		}

		$games_statement->execute();

		$pdo = null;
	}
	catch (PDOException $e) {
		die($e->getMessage());
	}

	$states=array("AL","AK","AZ","AR","CA","CO","CT","DE","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WV","WI","WY");
?>

<!DOCTYPE html>
<html>

<?php
	head("Schedule",$filepath);
?>
<body>
	<div class="container-fluid">
		<?php
			if($schoolaccount) {
				navbar('school',$filepath,$filepath . 'index.php',$schoolname);
			} elseif($refaccount) {
				navbar('referee',$filepath,$filepath . 'index.php',$reffirst);
			}
		?>
	</div>
	<div class="container page-content">
		<?php if($addgame){?>
		<div class="row">
			<div class="col-md-12">

			</div>
		</div>

		<?php }?>
		<div class="row">
			<div class="col-md-2">
				<h2><strong>Schedule</strong></h2>
			</div>


		<hr>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-hover table-responsive">
					<thead>
						<tr>
							<th>Team</th>
							<th>New Result</th>
							<th>Points</th>
							<th>Date</th>
							<th>Time</th>
							<!-- <th>Winner</th>
							<th>Score</th>
							<th></th> -->
						</tr>
					</thead>
					<tbody>

						<?php  $con=mysqli_connect("localhost","root","root","NJITsoccer");
						// Check connection
						if (mysqli_connect_errno())
						{
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						$result = mysqli_query($con,"SELECT * FROM team ORDER BY teamname DESC, RAND()");
						$result2 = mysqli_query($con,"SELECT * FROM team");


						while($row = mysqli_fetch_array($result))
						{
							$row2 = mysqli_fetch_array($result2);

						echo "<tr>";
						echo "<td>" . $row['teamname'] . "</td>";
						echo "<td>" . "<form action=pos.php method=post>"
						 . "<select name=points>
						<option value='' disabled selected style='display:none;'>Position Options</option>
						<option value=3>Win</option>
						<option value=1>Tie</option>
						<option value=0>Lost</option>
		</select>" . "<input type=submit>" . "</td>";
		echo "<td>" . $row['points'] . "</td>";



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
