<?php include("config.php"); ?>
<?php include '../includes/layouts/header.php' ;?>
  <body>
  <!-- Navigation -->
   <?php include '../includes/layouts/navigation.php' ;?>  
        <!--Navigation ends-->
<?php
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {      
        $code = mysqli_real_escape_string($conn,$_POST['code']);
        $mobile = mysqli_real_escape_string($conn,$_POST['mobile']); 
        $password = $_POST['pass'];
        $member_check=mysqli_query($conn,"SELECT * FROM users WHERE employee_number='$code' AND mobile = '$mobile' AND password = '$password'") or die(mysqli_error($conn));
        if (mysqli_num_rows($member_check) === 1) {
          $number = mysqli_query($conn,"SELECT membership_number FROM users WHERE employee_number='$code' AND mobile = '$mobile' AND password = '$password'") or die(mysqli_error($conn));
          $row = mysqli_fetch_assoc($number);
          $membership_number = $row['membership_number'];

          echo' <div class="alert alert-success alert-dismissable">
           <button type="button" class="close" data-dismiss="alert"
           aria-hidden="true">
           &times;
           </button>
           <h2>Your Membership Number is:'.$membership_number.' </h2>.
          </div>';
  
        
} else {
    
echo' <div class="alert alert-warning alert-dismissable">
 <button type="button" class="close" data-dismiss="alert"
 aria-hidden="true">
 &times;
 </button>
 The Employment Number,Mobile Number or Password Provided doesnt exist.
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
<div class="panel-heading "><h3 class="panel-title text-center">Request Membership Code</h3></div>
<div class="panel-body">
  <form  method="POST" action="request_code.php">
    <div class="col-md-12 col-sm-12">
      
       <div class="form-group col-md-8">
            <label class="labelstaff">SGA Employee Number:</label>
            <input name="code" required="required" class="form-control input-sm" id="code" value="<?php if(isset($_POST['code'])) echo $_POST['code']?>"> 
        </div>
        <div class="form-group col-md-8">
            <label for="mobile" class="labelstaff">Mobile:</label>
            <input  type="text" required="required" class="form-control input-sm" name="mobile" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile']?>">
        </div>
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Password:</label>
            <input  type="password" required="required" class="form-control input-sm" name="pass" >
        </div>      
       <div class="col-md-12">
        <div class="form-group col-md-8 col-sm-3 " >
            <input type="submit"  name="request" class="btn btn-primary" value="Request Code"/>
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