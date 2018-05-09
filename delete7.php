<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['mid3'];

$sql = "UPDATE team SET mid3=null WHERE mid3='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
