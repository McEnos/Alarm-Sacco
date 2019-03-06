<?php
require_once('config.php');
$get_id=$_GET['loan_id'];

// sql to update a record
$sql = mysqli_query($conn,"UPDATE applications SET pending = 2 WHERE application_id = '$get_id' LIMIT 1")or die(mysqli_error($conn));
header('location:members.php');
?>