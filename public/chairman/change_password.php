<?php
session_start();
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 1))
   {
      header('Location: ../login.php');
      exit();
   }
   // print_r($_SESSION);
?>
<?php include("config.php"); ?>
<?php include 'layouts/admin_header.php' ;?>
  <body>
  <!-- Navigation -->
   <?php include 'layouts/admin_navigation.php' ;?>  
        <!--Navigation ends-->
<?php
 if(isset($_GET['success'])){
     echo' <div class="alert alert-success alert-dismissable">
     <button type="button" class="close" data-dismiss="alert"
     aria-hidden="true">
     &times;
     </button>
     Success!You successfully changed your password
    </div>';   
     } 
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change'])) {      
        $old_password = $_POST['pass'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_pass'];
        $membership_number = $_POST['membership_number'];
        if($new_password == $confirm_new_password)
        {
            if(strlen($new_password) >= 6)
            {
              //update password
              $update_query = mysqli_query($conn,"UPDATE users SET password = '$new_password' WHERE password = '$old_password' AND membership_number = '$membership_number' AND level='1' LIMIT 1");
              if($update_query)
              {
                  echo '<script> window.location="change_password.php?success=True"</script>';
              }
              else
              {
                 echo' <div class="alert alert-warning alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert"
                 aria-hidden="true">
                 &times;
                 </button>
                 Sorry,the password could not be updated;
                </div>';
              }

            }
            else
            {
                  echo' <div class="alert alert-warning alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert"
                 aria-hidden="true">
                 &times;
                 </button>
                 Password must have atleast 6 characters;
                </div>';
            }
        }
        else
        {
          echo' <div class="alert alert-warning alert-dismissable">
           <button type="button" class="close" data-dismiss="alert"
           aria-hidden="true">
           &times;
           </button>
           The new passwords did not match.
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
<div class="panel-heading "><h3 class="panel-title text-center">Admin Password Change</h3></div>
<div class="panel-body">
  <form  method="POST" action="change_password.php">
    <div class="col-md-12 col-sm-12">
    
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Old Password:</label>
            <input  type="password" required="required" class="form-control input-sm" name="pass" >
        </div>
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">New Password:</label>
            <input  type="password" required="required" class="form-control input-sm" name="new_password" >
        </div> 
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Confirm New Password:</label>
            <input  type="password" required="required" class="form-control input-sm" name="confirm_new_pass" >
        </div>
        <input type="hidden" name="membership_number" value="<?php $_SESSION['membership_number'];?>">     
       <div class="col-md-12">
        <div class="form-group col-md-8 col-sm-3 " >
            <input type="submit"  name="change" class="btn btn-primary" value="Change Password"/>
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
</div>
<footer>
<div class="container">

      <?php include 'layouts/footer.php' ;?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>