<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$name =$_GET['name'];
$sql = "UPDATE team SET def3 = '$name' WHERE ID = 2";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: teams.php");

?>
