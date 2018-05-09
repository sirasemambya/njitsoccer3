<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['for2'];

$sql = "UPDATE team SET for2=null WHERE for2='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
