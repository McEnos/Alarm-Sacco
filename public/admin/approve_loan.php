<?php
session_start();
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 1))
   {
      header('Location: ../login.php');
      exit();
   }

require_once('config.php');
$loan_id = $_GET['id'];
$loan_query = mysqli_query($conn,"SELECT application_id,code,type,total_amount,membership_number,DATE_FORMAT(application_date, '%M %d, %Y') AS application_date FROM applications WHERE application_id = '$loan_id'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($loan_query);
// $loan_code = $row['code'];
$loan_type = (int)$row['type'];
$amount = $row['total_amount'];
$membership_number = $row['membership_number'];
$amount_remaining = $amount;
//update loans table
mysqli_query($conn,"INSERT INTO loans(type_id,amount_borrowed,amount_remaining,membership_number) VALUES('$loan_type','$amount','$amount_remaining','$membership_number')") or die(mysqli_error($conn));
//delete from applications table
mysqli_query($conn,"DELETE FROM applications WHERE application_id = '$loan_id' LIMIT 1") or die(mysqli_error($conn));
header("Location:manage_loan.php");
exit();

?>