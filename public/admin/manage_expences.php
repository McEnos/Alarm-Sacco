<?php
  session_start();
   include("config.php"); 
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 1))
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
<?php include 'layouts/admin_navigation.php' ;?>  
<div class="container"> 
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <?php
      //query user information from users table
    $query_expence = mysqli_query($conn,"SELECT * FROM expence") or die(mysqli_error($conn));
      
    ?>
<div class="panel panel-default" style="margin:40px;">
<div class="panel-heading "><h3 class="panel-title text-center">Alarm Sacco Expences</h3></div>
<div class="panel-body">
  <table class="table">
    <tr>
      <td>Expence Type</td>
      <td>Amount</td>
    </tr>
    <?php
      while($row = mysqli_fetch_assoc($query_expence))
      {
        ?>
        <tr>
          <td><?php echo $row['type'];?></td>
          <td><?php echo $row['cost'];?></td>
        </tr>
        <?php
      }

    ?>
    <tr>
      <td></td>
      <td><a href="dashboard.php" class="btn btn-primary">Back</a></td>
    </tr>
  </table>
</div><!--panel body ends-->
  
</div><!--panel ends-->

  </div>
  <div class="col-md-3"></div>
</div><!--row ends-->
</div>
    <!-- Footer starts-->
      <?php include 'layouts/footer.php' ;?>
       <!--footer ends--> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>