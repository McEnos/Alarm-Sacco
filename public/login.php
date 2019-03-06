<?php include("config.php"); ?>
<?php include '../includes/layouts/header.php' ;?>
  <body>
  <!-- Navigation -->
   <?php include '../includes/layouts/navigation.php' ;?>  
        <!--Navigation ends-->
<?php
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
      // username and password sent from form 
      
        $code = mysqli_real_escape_string($conn,$_POST['code']);
        $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
        $user_level = mysqli_real_escape_string($conn,$_POST['userLevel']); 
        $result=mysqli_query($conn,"SELECT * FROM `users` WHERE `membership_number`='".$code."' and `password`='".$mypassword."' and `level` ='". $user_level."'  ");
if (mysqli_num_rows($result) > 0) {
  
        while($row = mysqli_fetch_assoc($result)) {
          $code=$row['membership_number'];
          $userLevel=$row['level'];
          $id = $row['user_id'];
          $username = $row['fname'];
         if($userLevel == 1){
          session_start();
          $_SESSION['membership_number'] = $row['membership_number'];
          $_SESSION['user_level'] = $row['level'];
          $_SESSION['username'] = $row['fname'];
          $_SESSION['id'] = $row['user_id'];
          header("location:admin/dashboard.php");
          exit();         
         }
         else{
           session_start();
            $_SESSION['membership_number'] = $row['membership_number'];
            $_SESSION['user_level'] = $row['level'];
            $_SESSION['username'] = $row['fname'];
            $_SESSION['id'] = $row['user_id'];
            header("location:user/index.php");
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
 Your Login Code or Password is invalid.
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
<div class="panel-heading "><h3 class="panel-title text-center">Login</h3></div>
<div class="panel-body">
  <form  method="POST" action="login.php">
    <div class="col-md-12 col-sm-12">
      
       <div class="form-group col-md-8">
            <label class="labelstaff">Membership Number:</label>
            <input name="code" required="required" class="form-control input-sm" id="code" value="<?php if(isset($_POST['code'])) echo $_POST['code']?>"> 
        </div>
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Password:</label>
            <input  type="password" required="required" class="form-control input-sm" name="password" >
        </div>
        <div class="form-group col-md-8">
             <label for="mobile" class="labelstaff">Login as:</label>
            <select class="form-control" id="userLevel" name="userLevel" type="text">
            <option value="1">Admin</option>
            <option value="0">Member</option>
           </select>
        </div>
      
       <div class="col-md-12">
        <div class="form-group col-md-8 col-sm-3 " >
            <input type="submit"  name="login" class="btn btn-primary" value="Login"/>
        </div>
        <div class="col-md-4">
       <p><a href="forgot_password.php">Forgot Password?</a>   <a href="request_code.php">Forgot Membership Number?</a></p>
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