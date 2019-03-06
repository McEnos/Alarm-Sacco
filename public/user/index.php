<?php
  session_start();
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
<div class="bg">
    
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