
  <?php 
   session_start();
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 0))
   {
      header('Location: ../login.php');
      exit();
   }
    
  include("config.php"); 
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
     Success! Your Loan Application has been received.
    </div>';   
     } 
     $applicant_id = $_SESSION['id'];
     // print_r($_SESSION);
     if(isset($_GET['quit']) && isset($_GET['number']) && $_GET['number'] == $_SESSION['membership_number'])
     {
        $number = $_SESSION['membership_number'];
        $query_loan = mysqli_query($conn,"SELECT membership_number FROM loans WHERE membership_number = '$number'") or die(mysqli_error($conn));
        if(mysqli_num_rows($query_loan) == 0)
        {
            $query_application = mysqli_query($conn,"SELECT membership_number FROM applications WHERE membership_number='$number'") or die(mysqli_error($conn));
            if(mysqli_num_rows($query_application) == 0)
            {
                $query_item = mysqli_query($conn,"SELECT membership_number FROM items WHERE membership_number='$number'") or die(mysqli_error($conn));
                if(mysqli_num_rows($query_item) == 0)
                {
                    echo' <div class="alert alert-success alert-dismissable">
                     <button type="button" class="close" data-dismiss="alert"
                     aria-hidden="true">
                     &times;
                     </button>
                     Success! Your  Application has been received successfuly.
                    </div>';   
                }
                else
                {
                    echo' <div class="alert alert-danger alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert"
                          aria-hidden="true">
                          &times;
                          </button>
                          Sorry! Cant quit the sacco while still paying Item borrowed.
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
                          Sorry! You have a pending loan application,wait untill its decision is made
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
                          Sorry!You cant quit a sacco while servicing a loan
                         </div>';
        }
     }
     else
     {
        header("Location:index.php");
        exit();
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