<?php
  session_start();
   include("config.php"); 
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 0))
   {
      header('Location: ../login.php');
      exit();
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Loan management services</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script type="text/javascript" src="../bootstrap/js/jquery-3.3.1.min.js"></script>
    <link href="../css/sidebar.css" rel="stylesheet" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

    .bg {
        /* The image used */
        background-image: url("images/main_banner.jpg");

        /* Full height */
        height: 80%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
   </head>

 <body>     
<?php include 'includes/layouts/navigation.php' ;?>  
<div class="container"> 
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <?php
      if(isset($_GET['success']))
      {
         echo' <div class="alert alert-success alert-dismissable">
         <button type="button" class="close" data-dismiss="alert"
         aria-hidden="true">
         &times;
         </button>
         Success! You have succesfully updated your monthly deductions.
        </div>';   
     } 
      if(isset($_POST['declare']))
      {
        $amount = $_POST['amount'];
        $number = $_SESSION['membership_number'];
        if($amount > 15000)
        {

            echo' <div class="alert alert-warning alert-dismissable">
             <button type="button" class="close" data-dismiss="alert"
             aria-hidden="true">
             &times;
             </button>
             Sorry!The maximum amount that can be deducted is 15000 per month.
            </div>';  
        }
        elseif($amount < 1500)
        {
          echo' <div class="alert alert-warning alert-dismissable">
             <button type="button" class="close" data-dismiss="alert"
             aria-hidden="true">
             &times;
             </button>
             Sorry!The minimum amount that can be deducted is 1500 per month.
            </div>';  
        }
        else
        {
          //check if member is having declarations of deductions
          $query_deductions = mysqli_query($conn,"SELECT * FROM monthly_deductions WHERE membership_number = '$number'") or die(mysqli_error($conn));
          if(mysqli_num_rows($query_deductions) > 0)
          {
            if(mysqli_query($conn,"UPDATE monthly_deductions SET amount = '$amount' WHERE membership_number = '$number' LIMIT 1"))
            {
               echo '<script> window.location="declare_deduction.php?success=True" </script>';
            }
          }
          else
          {
            $result = mysqli_query($conn,"INSERT INTO monthly_deductions(membership_number,amount) VALUES('$number','$amount')") or die(mysqli_error($conn));
            echo '<script> window.location="declare_deduction.php?success=True" </script>';

          }
          
        }
      }


    ?>  
<div class="panel panel-default" style="margin:40px;">
<div class="panel-heading "><h3 class="panel-title text-center">Monthly Deduction</h3></div>
<div class="panel-body">
  <form  method="POST" action="declare_deduction.php">
    <div class="col-md-12 col-sm-12">
      
       <div class="form-group col-md-8">
            <label class="labelstaff">Enter Amount To be reduced Per Month:</label>
            <input name="amount" required="required" class="form-control input-sm" id="amount" value="<?php if(isset($_POST['amount'])) echo $_POST['amount']?>"> 
        </div>
      
       <div class="col-md-12">
        <div class="form-group col-md-8 col-sm-3 " >
            <input type="submit"  name="declare" class="btn btn-primary" value="Submit"/>
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
    <!-- Footer starts-->
      <?php include 'includes/layouts/footer.php' ;?>
       <!--footer ends--> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>