<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$option = $_GET['name'];
$sql = "UPDATE team SET pos2 = '$option' WHERE ID = 2";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: lineup2.php");

?>
