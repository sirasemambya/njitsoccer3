<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['mid1'];

$sql = "UPDATE team SET mid1=null WHERE mid1='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
