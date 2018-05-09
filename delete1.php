<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['gk'];

$sql = "UPDATE team SET gk=NULL WHERE gk='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
