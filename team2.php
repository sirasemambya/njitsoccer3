<?php
	ob_start();
	session_start();
	$filepath = "";

	include($filepath . "autoload3.php");
	autoload($filepath);



	try {
		include($filepath . "connect-to-db.php");

		if(isset($_POST['lc'])) {
			$lc = true;
			$teamname = $_POST['teamname'];
			$Coach = $_POST['Coach'];
			$gk = $_POST['gk'];
			$def1 = $_POST['def1'];
			$def2 = $_POST['def2'];
			$def3 = $_POST['def3'];
			$mid1 = $_POST['mid1'];
			$mid2 = $_POST['mid2'];
			$mid3 = $_POST['mid3'];
			$for1 = $_POST['for1'];
			$for2 = $_POST['for2'];
			$fr = $_POST['fr'];


			try {
				#begin the Insert transaction
				$pdo->beginTransaction();

				# Insert school account fields into database
				$insert_sql = "INSERT INTO team (teamname, Coach, gk, def1, def2, def3, mid1, mid2, mid3, for1, for2, fr) VALUES ('$teamname', '$Coach', '$gk', '$def1', '$def2', '$def3', '$mid1', '$mid2', '$mid3', '$for1', '$for2', '$fr')";
				$insert_statement = $pdo->prepare($insert_sql);
				$insert_statement->bindValue(':teamname', $teamname);
				$insert_statement->bindValue(':Coach', $Coach);
				$insert_statement->bindValue(':gk', $gk);
				$insert_statement->bindValue(':def1', $def1);
				$insert_statement->bindValue(':def2', $def2);
				$insert_statement->bindValue(':def3', $def3);
				$insert_statement->bindValue(':mid1', $mid1);
				$insert_statement->bindValue(':mid2', $mid2);
				$insert_statement->bindValue(':mid3', $mid3);
				$insert_statement->bindValue(':for1', $for1);
				$insert_statement->bindValue(':for2', $for2);
				$insert_statement->bindValue(':fr', $fr);
				$insert_statement->execute();

				#commit the transaction
				$pdo->commit();
			} catch (Exception $e) {
				#rollback if there were any failures
				$pdo->rollback();
			}
		} else {
			$lc = false;
		}
		$lg_sql = "SELECT * FROM team";
		$insert_statement = $pdo->prepare($lg_sql);
		$insert_statement->execute();

		$pdo = null;
	}
	catch (PDOException $e) {
		die($e->getMessage());
	}
?>

<!DOCTYPE html>
<html>

<?php
	head("team",$filepath);
?>

<body>
	<div class="container-fluid">
		<?php navbar('school',$filepath,$filepath . 'index.php',$schoolname);?>
	</div>
	<div class="container page-content">
		<?php if($lc){?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-dismissible alert-info pull-left form-alert">
		  			<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
		  			<p><strong><?php echo $teamname;?></strong> has been added.</p>
				</div>
			</div>
		</div>
		<?php }?>
		<div class="row">
			<div class="col-md-6">
				<h2><strong>Teams</strong></h2>
			</div>
			<div class="col-md-6">

			</div>
		</div>
		<div id="addleague" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
						<h4 class="modal-title">Add Team</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-10 col-xs-push-1 col-sm-10 col-sm-push-1 col-md-10 col-md-push-1">
								<form class="form-horizontal" method="post" action="team.php">
									<fieldset>
										<div class="form-group">
											<label class="control-label col-md-4" for="teamname">Team Name</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="teamname" name="teamname" required data-toggle="tooltip" data-placement="bottom" title="Make sure to provide an unique name"/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="Coach">Coach</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="Coach" name="Coach" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="gk">Goalkeeper</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="gk" name="gk" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="def1">Defender #1</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="def1" name="def1" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="def2">Defender #2</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="def2" name="def2" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="def2">Defender #3</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="def3" name="def3" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="mid1">Midfielder #1</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="mid1" name="mid1" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="mid2">Midfielder #2</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="mid2" name="mid2" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="mid3">Midfielder #3</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="mid3" name="mid3" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="for1">Forward #1</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="for1" name="for1" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="for2">Forward #2</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="for2" name="for2" required/>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4" for="fr">Free Role</label>
											<div class="col-md-8">
												<input type="text" class="form-control" id="fr" name="fr" required/>
											</div>
										</div>
										<div class="col-md-8 col-md-push-4">
											<button type="submit" class="btn btn-success">Add Team</button>
										</div>
										<input type="hidden" id="lc" name="lc" value="true"/>
									</fieldset>
								</form>
							</div>
						</div>
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
							<th>Team Name</th>
							<th>Coach</th>
						</tr>
					</thead>
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
echo "<td>" . $row['teamname'] . "</td>";
echo "<td>" . $row['Coach'] . "</td>";
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
