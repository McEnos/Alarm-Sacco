<?php include("config.php"); ?>
<?php include '../includes/layouts/header.php' ;?>
  
  <body>
  <!-- Navigation -->
   <?php include '../includes/layouts/navigation.php' ;?>  
        <!--Navigation ends-->
   
<?php    
  if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['login'])) {
      // username and password sent from form 
      
        $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
        $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
        $user_level = mysqli_real_escape_string($conn,$_POST['userLevel']); 
        $result=mysqli_query($conn,"SELECT * FROM `users` WHERE `mobile`='".$mobile."' and `password`='".$mypassword."' and `level` ='". $user_level."'  ");
if (mysqli_num_rows($result) > 0) {
  
        while($row = mysqli_fetch_assoc($result)) {
          $mobile=$row['mobile'];
          $userLevel=$row['level'];
          $id = $row['user_id'];
         if($userLevel == 1 ){
           session_start();
         $_SESSION['login_user'] = $mobile;
         $_SESSION['id'] = $id;
         $_SESSION['login_user_level'] = $userLevel;
         header("location:admin/dashboard.php");
         exit();
         }else{
           session_start();
            $_SESSION['login_user'] = $mobile;
            $_SESSION['login_user_level'] = $userLevel;
            $_SESSION['id'] = $id;
            header("location:user/dashboard.php");
            exit();
         }
         
          
        }
        //echo $data;
        
} else {
    
echo' <div class="alert alert-warning alert-dismissable">
 <button type="button" class="close" data-dismiss="alert"
 aria-hidden="true">
 &times;
 </button>
 Your Login Name or Password is invalid.
</div>';  
}

    
   }
?>
<!--Login starts-->
<div class="container"> 
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    
<div class="panel panel-default" style="margin:40px;">
<div class="panel-heading "><h3 class="panel-title text-center text-warning">Reset Password</h3></div>
<div class="panel-body">
  <form  method="POST" action="forgot_password.php">
    <div class="col-md-12 col-sm-12">
      
       <div class="form-group col-md-8">
            <label class="labelstaff">Mobile Number:</label>
            <input name="mobile" required="required" class="form-control input-sm" id="mobile" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile']?>"> 
        </div>
        <div class="form-group col-md-8">
            <label class="labelstaff">Membership Number:</label>
            <input name="code" required="required" class="form-control input-sm" id="code" value="<?php if(isset($_POST['code'])) echo $_POST['code']?>"> 
        </div>
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">New Password:</label>
            <input  type="password" required="required" class="form-control input-sm" name="pass1" >
        </div>
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Confirm Password:</label>
            <input  type="password" required="required" class="form-control input-sm" name="pass2" >
        </div>
      
       <div class="col-md-12">
        <div class="form-group col-md-8 col-sm-3 " >
            <input type="submit"  name="login" class="btn btn-primary" value="Reset Password"/>
        </div>
       
        
      </div>


    </div>

  </form><!--form ends-->
  



</div><!--panel body ends-->
  
</div><!--panel ends-->

  </div>
  <div class="col-md-3"></div>


</div><!--row ends-->
</div>
</div><!--container ends-->

<footer>
<div class="container">

       <!-- Footer starts-->
      <?php include '../includes/layouts/footer.php' ;?>
       <!--footer ends-->   

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>