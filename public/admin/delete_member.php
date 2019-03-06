<?php
require_once('config.php');

$get_id=$_GET['member_id'];

$sql = mysqli_query($conn,"DELETE FROM users WHERE user_id = '$get_id' LIMIT 1")or die(mysqli_error($conn));
header('location:members.php');
?>