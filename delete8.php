<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['for1'];

$sql = "UPDATE team SET for1=null WHERE for1='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
