<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$start =$_GET['name'];
$sql = "UPDATE team SET pos5 = '$start' WHERE ID = 2";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: lineup2.php");

?>
