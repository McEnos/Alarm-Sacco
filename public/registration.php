<?php include("config.php"); ?>
<?php include '../includes/layouts/header.php' ;?>
    
  <body>
  <!-- Navigation -->
   <?php include '../includes/layouts/navigation.php'; 
   //function to generate membership code
        function GenerateCode() {
                $code = '';
                for($i=0; $i < 5; $i++)
                {
                  $code .= (rand(0,9));
                }
                return $code;
              }
          


   ;?>  
  <?php
    if(isset($_GET['success'])){
     echo' <div class="alert alert-success alert-dismissable">
     <button type="button" class="close" data-dismiss="alert"
     aria-hidden="true">
     &times;
     </button>
     Success! You have Registered successfully <a href="login.php">Login now ?.</a>
     Your Membership Number is <h3 style="color:red;"><b>'.$_GET['code'].'</b></h3> Will be required during Login,Please Note it somewhere.
    </div>';   
     } 
     if(isset($_POST['registration']))
     {
      $employee_number = $_POST['employee'];     
       $mobile=$_POST['mobile'];
             
         //check if provided employee number exists in SGA database
             $existingEmployee = mysqli_query($conn,"SELECT * FROM SGA_employees WHERE employee_number = '$employee_number'") or die(mysqli_error($conn));   

             if(mysqli_num_rows($existingEmployee) == 1)
             {
                $row = mysqli_fetch_assoc($existingEmployee);
                //check if mobile number provided is already registered
                $similarityResult=mysqli_query($conn,"SELECT * FROM users WHERE mobile = '$mobile'") or die(mysqli_error($conn));
                if (mysqli_num_rows($similarityResult)==0) 
                {   
                    if(($_POST['pass1']) == $_POST['pass2'])
                    {
                        if(strlen($_POST['pass1']) >= 6)
                        {
                            
                              if(isset($_POST['accept']))
                              {
                                //check if employment_number is already registered
                                $query_users = mysqli_query($conn,"SELECT employee_number FROM users WHERE employee_number = '$employee_number'") or die(mysqli_error($conn));
                                if(mysqli_num_rows($query_users) == 0)
                                {
                                     //Write first_name,last_name and is_number derived from SGA employees
                                      $employee_number = $_POST['employee'];
                                      $mobile = $_POST['mobile'];
                                      $fname = $row['first_name'];
                                      $lname = $row['last_name'];
                                      $full_name = $fname.' '.$lname;
                                      $id_no = $row['id_number'];
                                      $password = $_POST['pass1'];
                                      $membership_number = GenerateCode();
                                      ?>
                                        <script type="text/javascript">
                                          if(confirm(<?php
                                            
                                            echo $full_name;
                                            echo $id_no;


                                            ?>))
                                          {

                                          }
                                        </script>
                                      <?php
                                      $insert = mysqli_query($conn,"INSERT INTO users(membership_number,fname,lname,mobile,id_no,employee_number,password) VALUES('$membership_number','$fname','$lname','$mobile','$id_no','$employee_number','$password')") or die(mysqli_error($conn));
                                      if($insert)
                                      {
                                        mysqli_query($conn,"INSERT INTO shares( membership_number,amount) VALUES('$membership_number','500')") or die(mysqli_error($conn));
                                        echo '<script> window.location="registration.php?success=True&code='.$membership_number.'" </script>';
                                      }
                                }
                                else
                                {
                                     echo' <div class="alert alert-warning alert-dismissable">
                                     <button type="button" class="close" data-dismiss="alert"
                                     aria-hidden="true">
                                     &times;
                                     </button>
                                     The SGA employment number provided is already registered.
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
                                 You must accept Terms and Conditions.
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
                             Password should have atleast 6 characters.
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
                       Your passwords are not matching.
                      </div>'; 
                    }
                }
                else
                {
                    echo' <div class="alert alert-danger alert-dismissable">
                     <button type="button" class="close" data-dismiss="alert"
                     aria-hidden="true">
                     &times;
                     </button>
                     <b>That mobile Number is already registered.</b>
                    </div>';
                }
             }
             else
             {
                 echo' <div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                    &times;
                    </button>
                    <b>The Employee Number number provided is not registered with SGA.</b>
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
<div class="panel-heading "><h3 class="panel-title text-center">Member Registration</h3></div>
<div class="panel-body">
  <form method="POST" action="registration.php">
    <div class="col-md-12 col-sm-12">
       <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">SGA Employee Number:</label>
            <input type="text" class="form-control input-sm" name="employee" value="<?php if(isset($_POST['employee'])) echo $_POST['employee'];?>" required/>
        </div>
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Mobile No:</label>
            <input type="text" class="form-control input-sm" name="mobile" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile'];?>" required/>
        </div>

        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Password:</label>
            <input type="password" class="form-control input-sm" id="pass1"  name="pass1" required/>
        </div>
         <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Password:</label>
            <input type="password" class="form-control input-sm" id="pass2" name="pass2" required/>
        </div>
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Full Name:</label>
            <input type="text" class="form-control input-sm" name="mobile" disabled="disabled"value="<?php echo $full_name;?>/>
        </div>
         <div class="form-group col-md-12">
          <div class="form-group">
            <input type="checkbox" name="accept"> <a href="terms.php">I Accept Terms & Conditions</span></a><span>1,500 Will be deducted!!
          </div>
        </div>
       <div class="col-md-12">
        <div class="form-group col-md-1 col-sm-3 ">

            <input type="submit" class="btn btn-primary pull-left" name="registration" value="Register"/>

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