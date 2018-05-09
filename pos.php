<?php
$con=mysqli_connect("localhost","root","root","NJITsoccer");
$name =$_GET['points'];
$sql = "UPDATE team SET points = points + '$name' WHERE ID = 2";

if (mysqli_query($con, $sql)) {
    echo "Record deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header("Location: schedule3.php");

?>
