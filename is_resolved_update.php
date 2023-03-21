<?php
include 'conn.php';

$uid = $_GET['uid'];

$q1 = "UPDATE bot_data_collection SET is_resolved='yes' WHERE uid = $uid";
$query1 = mysqli_query($con,$q1);
header('location:dashboard.php');

?>

