<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['mid2'];

$sql = "UPDATE team SET mid2=null WHERE mid2='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
