<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$start =$_GET['start'];
$sql = "UPDATE team SET mid1s = '$start' WHERE ID = 2";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: teamscoach.php");

?>
