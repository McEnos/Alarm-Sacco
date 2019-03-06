
  <?php 
   session_start();
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 0))
   {
      header('Location: ../login.php');
      exit();
   }
    // function to generate code
    function GenerateCode() {
        $code = '';
        for($i=0; $i < 5; $i++)
        {
          $code .= (rand(0,9));
        }
        return $code;
      }
  
  include("config.php"); 
  include 'functions.php';
  include 'includes/layouts/header.php' ;
  ?>
    <!DOCTYPE html>
    <html>
    <head>
    <title></title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script type="text/javascript" src="../bootstrap/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <link href="../css/sidebar.css" rel="stylesheet" />

    </head>
   
  <body>
   <?php include 'includes/layouts/navigation.php' ;?>  
<?php
    if(isset($_GET['success'])){
     echo' <div class="alert alert-success alert-dismissable">
     <button type="button" class="close" data-dismiss="alert"
     aria-hidden="true">
     &times;
     </button>
     Success! Your Loan Application has been received.  <a href="form.php" class="btn btn-primary">Download Application Form</a> for approval
    </div>';   
     } 
     if(isset($_GET['type']))
     {
          echo' <div class="alert alert-success alert-dismissable">
           <button type="button" class="close" data-dismiss="alert"
           aria-hidden="true">
           &times;
           </button>
           Success! Your Loan Application has been received.
          </div>';  
     }
     if(isset($_POST['apply']))
     {  
        $number=$_POST['number'];
        $type = $_POST['loan_type'];
        $amount = $_POST['amount'];
        $applicant_id = $_SESSION['id'];      
        //Check if user has Loan
        //initialize variables
        $allowed = false;
        $amount_allowed = 0;
        $total_amount = 0;
        $number_exist = mysqli_query($conn,"SELECT membership_number FROM users WHERE membership_number = '$number'") or die(mysqli_error($conn));
        if(mysqli_num_rows($number_exist) ===1)
        {
           if($type == 1)
           {
              //check if user already has monthly deductions
              $query_deduction = mysqli_query($conn,"SELECT amount FROM monthly_deductions WHERE membership_number = '$number'") or die(mysqli_error($conn));
              if(mysqli_num_rows($query_deduction) > 0)
              {
                  //check if total monthly deductions exceed 10000
                  $row = mysqli_fetch_assoc($query_deduction);
                  if($row['amount'] < 10000)
                  {
                      if($amount <= 3000)
                      {
                          //check if member is having loan type of instant before accepting application
                          $query_loan_type = mysqli_query($conn,"SELECT type_id FROM loans WHERE membership_number = '$number' AND type_id = '1'") or die(mysqli_error($conn));
                          if(mysqli_num_rows($query_loan_type) == 0)
                          {
                            //check if member has instant pending loan application
                            $query = mysqli_query($conn,"SELECT type FROM applications WHERE membership_number = '$number' AND type = '1'") or die(mysqli_error($conn));
                            if(mysqli_num_rows($query) == 0)
                            {
                                //accept the application
                                  $total_amount = number_format(($amount * 1.15));
                                  $allowed = true;
                                  $amount_allowed = $amount;
                            }
                            else
                            {
                              //the member has a pending instant loan
                              echo' <div class="alert alert-danger alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert"
                                  aria-hidden="true">
                                  &times;
                                  </button>
                                  Sorry! Your previous Instant loan application is yet to be approved
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
                                  Sorry! Cannot apply for another Instant Loan when the previous one is not yet settled
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
                          Sorry! Instant loan cannot exceed Kshs '.number_format(3000).'
                         </div>';
                      }
                  }
                  else
                  {
                     echo '<div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert"
                      aria-hidden="true">
                     &times;
                     </button>
                     Sorry! Cannot apply for instant loan when monthly deductions exceed Ksh.10000.
                    </div>';
                  }
              }
              else
              {
                echo '<div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert"
                      aria-hidden="true">
                     &times;
                     </button>
                     Sorry!,It seems haven\'t declared monthly deductions,Please do so.
                    </div>'; 

              }

           }
           if($type == 3)
           {
              if($amount <= 100000)
              {
                //check if there is any pendind loan application of member
                $query_application = mysqli_query($conn,"SELECT membership_number FROM applications WHERE membership_number ='$number'") or die(mysqli_error($conn));
                if(mysqli_num_rows($query_application) == 0)
                {
                  //check if member has fee loan
                  $query_fees_status = mysqli_query($conn,"SELECT type_id,amount_borrowed,amount_remaining FROM loans WHERE type_id ='3' AND membership_number = '$number'") or die(mysqli_error($conn));
                  if(mysqli_num_rows($query_fees_status) > 0)
                  {
                    //check amount paid already 
                    $row = mysqli_fetch_assoc($query_fees_status);
                    if($row['amount_remaining'] >= (0.5 * $row['amount_borrowed']))
                    {
                        echo '<div class="alert alert-danger alert-dismissable">
                         <button type="button" class="close" data-dismiss="alert"
                         aria-hidden="true">
                         &times;
                         </button>
                         Sorry! You must pay 50% of previous School fees loan before applying for another one.
                        </div>';
                    }
                    else
                    {
                       //allow the member to apply if have serviced 50% of previous school fee loan
                        $total_amount = number_format($amount * 1.01);
                        $monthly_return = number_format((ceil($amount*1.01))/12);
                        $allowed = true;
                        $amount_allowed = $amount;
                    }
                   }
                  else
                  {
                    //allow the member to apply if not having school fee loan
                    $total_amount = number_format($amount * 1.01);
                    $monthly_return = number_format((ceil($amount*1.01))/12);
                    $allowed = true;
                    $amount_allowed = $amount;
                  }

              }
                else
                {
                    echo '<div class="alert alert-danger alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert"
                       aria-hidden="true">
                       &times;
                       </button>
                       Sorry! You have a pending loan application approval.
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
               Sorry! School fees loan cannot exceed Kshs ' .number_format(100000).'
              </div>';
            }
             
              
           }

           if($type == 2)
           { 
            //check the amount of shares the member is having
            $query_shares = mysqli_query($conn,"SELECT amount FROM shares WHERE membership_number = '$number'") or die(mysqli_error($conn));
            $row = mysqli_fetch_assoc($query_shares);
            $total_shares = $row['amount'];
            if($amount <= (2.5 * $total_shares))
            {

            //check if member has a pending appication
              $query = mysqli_query($conn,"SELECT membership_number FROM applications WHERE membership_number = '$number'") or die(mysqli_error($conn));
              if(mysqli_num_rows($query) == 0)
              {
                   //check is member has a normal loan being serviced
                  $query_loan = mysqli_query($conn,"SELECT * FROM loans WHERE membership_number = '$number' AND type_id = '2'") or die(mysqli_error($conn));
                  //if member has a normal laon being serviced,check percentage paid already

                  if(mysqli_num_rows($query_loan) == 0)
                  {
                      //allow application if member has  no normal loan
                    $total_amount = number_format($amount * 1.05);
                    // echo "You will pay total amount of $total_amount";
                    $allowed = true;
                    $amount_allowed = $amount;
                  }
                  else
                  {
                    //check percentage paid
                    $row = mysqli_fetch_assoc($query_loan);
                    if($row['amount_remaining'] < (0.25 * $row['amount_borrowed']))
                    {
                        $total_amount = number_format($amount * 1.05);
                        echo "You will pay total amount of $total_amount";
                        $allowed = true;
                        $amount_allowed = $amount;
                    }
                    else
                    {
                        echo' <div class="alert alert-danger alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert"
                       aria-hidden="true">
                       &times;
                       </button>
                       Sorry! You have not paid 75% of previous normal loan;
                      </div>';
                    }
                  }
              }
              else
              {
                  echo' <div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert"
                   aria-hidden="true">
                   &times;
                   </button>
                   Sorry! Your previous Loan is yet to be approved.
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
                          Sorry! The amount you apply for cannot exceed '.((2.5 * $total_shares)).'
                         </div>';
             }

           }
             if($type == 5)
              {
                  $query_normal_status = mysqli_query($conn,"SELECT amount_borrowed,amount_remaining FROM loans WHERE membership_number = '$number'") or die(mysqli_error($conn));
                  if(mysqli_num_rows($query_normal_status) > 0)
                  {
                    $row = mysqli_fetch_assoc($query_normal_status);
                    $amount_borrowed = $row['amount_borrowed'];
                    $amount_remaining = $row['amount_remaining'];
                    if($amount_remaining >= (0.75 * $amount_borrowed))
                    {
                              echo' <div class="alert alert-danger alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert"
                             aria-hidden="true">
                             &times;
                             </button>
                             Sorry! Your have not paid 75% of the normal loan you owe the sacco.
                            </div>'; 

                    }
                    elseif(($amount_remaining < (0.75*$amount_borrowed)) && ($amount > $amount_borrowed))
                    {
                         echo' <div class="alert alert-danger alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert"
                             aria-hidden="true">
                             &times;
                             </button>
                             Sorry! At the moment you can only borrow upto '. number_format($amount_borrowed).' Shillings.
                            </div>'; 

                    }
                    else
                    {
                      $allowed = true;
                      $amount_allowed = $amount;
                      $total_amount = (1.05 * $amount);
                    }

                  }
              }
        }
        else
        {
          echo' <div class="alert alert-danger alert-dismissable">
             <button type="button" class="close" data-dismiss="alert"
             aria-hidden="true">
             &times;
             </button>
             Sorry! The Membership Number Provided is not registered yet.
            </div>'; 
        }

          //Generate application code
              if($allowed == true && ($type == 2 || $type == 3 || $type == 5))
              {
                  $code = GenerateCode();
                   $result=mysqli_query($conn,"INSERT INTO applications(code,type,amount,total_amount,membership_number) 
                  VALUES('$code','$type','$amount','$total_amount','$number')") or die(mysqli_error($conn));
                     if($result)
                        {
                        
                          echo '<script> window.location="loan.php?success=True" </script>';
                          $_SESSION['loan_type'] = $type;
                          $_SESSION['application_id'] = $code;
                          $_SESSION['amount'] = $amount_allowed;
                        }
                        else
                        {
                             echo' <div class="alert alert-danger alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert"
                               aria-hidden="true">
                               &times;
                               </button>
                               Sorry! something went wrong.Please try again.
                              </div>'; 
                        }

              }
              elseif($allowed == true && $type == 1)
              {

                  $code = GenerateCode();
                   $result=mysqli_query($conn,"INSERT INTO applications(code,type,amount,total_amount,membership_number) 
                  VALUES('$code','$type','$amount','$total_amount','$number')") or die(mysqli_error($conn));
                     if($result)
                        {
                        
                          echo '<script> window.location="loan.php?type=Instant</script>';
                        }
                        else
                        {
                             echo' <div class="alert alert-danger alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert"
                               aria-hidden="true">
                               &times;
                               </button>
                               Sorry! something went wrong.Please try again.
                              </div>'; 
                        }
              }

        
        }
        ?>
<div class="container">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      
     <div class="panel panel-info calculator" style="margin:20px;">
<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title text-center text-warning">Loan Application</h3>
</div>
<div class="panel-body">
    <form  method="POST" action="loan.php">
    <div class="col-md-12 col-sm-12">
      
       <div class="form-group col-md-8">
            <label class="labelstaff">Membership Number:</label>
            <input name="number" class="form-control input-sm" id="number" required="required" value="<?php if(isset($_POST['number'])) echo $_POST['number']?>"> 
        </div>
          <div class="form-group col-md-8">
             <label  class="labelstaff">Select Of Loan:</label>
            <select name="loan_type" class="form-control" required="required">
            <option></option>
            <option value="1">Instant</option>
            <option value="2">Normal</option>
            <option value="3">School Fees</option>
             <option value="5">TopUp Loan</option>
           </select>
          </div>

        <div class="form-group col-md-8" id="item_amount">
            <label class="labelstaff">Amount in Kshs:</label>
            <input name="amount" class="form-control input-sm" id="amount" required="required" value="<?php if(isset($_POST['amount'])) echo $_POST['amount']?>"> 
        </div>
       <div class="col-md-12">
        <div class="form-group col-md-1 col-sm-3 " >
            <input type="submit"  name="apply" class="btn btn-outline-primary btn-primary btn-md" value="Apply Loan"/>
        </div>

       </div>
    </div>

  </form>
</div>
</div>
</div>
</div>
</div>
      <?php include 'includes/layouts/footer.php' ;?>
  </body>
</html>