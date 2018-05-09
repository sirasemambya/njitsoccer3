<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$id = $_GET['def2'];

$sql = "UPDATE team SET def2=null WHERE def2='$id'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: index.php");

?>
