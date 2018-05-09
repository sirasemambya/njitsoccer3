<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['def3'];

$sql = "UPDATE team SET def3=null WHERE def3='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
