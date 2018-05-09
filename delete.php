<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['Coach'];

$sql = "UPDATE team SET Coach=null WHERE Coach='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
