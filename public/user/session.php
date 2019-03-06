<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   //$user_level = $_SESSION['login_user_level'];
   
   $ses_sql = mysqli_query($conn,"SELECT * FROM `users` WHERE `mobile` = '".$user_check."' ") or die(mysqli_error($conn));
   
   $row = mysqli_fetch_assoc($ses_sql);
   
   $login_session = $row['fname'];
   $login_session_password = $row['password'];
   // $login_session_matatu = $row['status'];
   $login_session_mobile = $row['mobile'];
   $_SESSION['login_user_level']= $row['level'];
   $_SESSION['username'] = $row['fname'];
   if(!isset($_SESSION['login_user'])){
      header("location:../login.php");
   }
    
    function ismember()
{
	if (isset($_SESSION['login_user']) && $_SESSION['login_user_level'] == 0 ) {
		return true;
	}else{
		return false;
	}
}

?>