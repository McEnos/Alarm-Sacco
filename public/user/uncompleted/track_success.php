<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   //$user_level = $_SESSION['login_user_level'];
   
   $ses_sql = mysqli_query($conn,"select * from `user` where `username` = '".$user_check."' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $login_session_password = $row['password'];
   //$login_session_email = $row['email'];
   $_SESSION['login_user_level']= $row['level'];
   $level="1";
   if(!isset($_SESSION['login_user'])){
      header("location:../public/login.php");
   }
   

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Online courier management system</title>

    <!-- Bootstrap -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
   </head>
    
  <body>
          <!-- Navigation -->
   <!-- Navigation-->
 <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="track.php"><span class="fa fa-plane"></span> Track order</a>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="navbar-brand" href="dashboard.php" style="color:;font-size:20px;"><span class="glyphicon glyphicon-user"></span><i class="fa fa-fw fa-user"></i><b><?php echo $login_session;?></b></a>
            </li> 
            <li class="nav-item">
    
          <a class="nav-link" href="logout.php" style="color:white">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
         
        </div>
      </nav>
        <!--Navigation ends-->
<!-- <div class="col-md-1"></div> -->
<div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Shipments List</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                      <thead>
                      <th>Sender Name </th> 
                      <th>Recipient Name</th>
                      <th>Package No </th>  
                      <th>Payment</th> 
                      <th>Destination</th> 
                      <th>Urgency</th>
                      <th>Delivery Time</th>
                      <th>Status</th>
                      <th>Description</th> 
                      </thead>
                      <tbody>
                        
                   <?php
                   $package_no = $_POST["package_no"];
                   $count=1;
                   $sel_query="SELECT * FROM shipments_tbl WHERE package_no='{$package_no}' ";
                   $result = mysqli_query($conn, $sel_query);
                           // confirm_query($result);
                   while($row = mysqli_fetch_assoc($result)) 
                    { ?>
                          <tr>                         
                          <td><?php echo $row["sender_name"] ; ?></td>
                          <td><?php echo $row["recipient_name"] ; ?></td>        
                          <td><?php echo $row["package_no"] ; ?></td>
                          <td><?php echo $row["payment"] ; ?></td>
                          <td><?php echo $row["destination"] ; ?></td>
                          <td><?php echo $row["urgency"] ; ?></td>
                          <td><?php echo $row["pickup_datetime"] ; ?></td>
                          <td><?php echo $row["status"] ; ?></td>
                          <td><?php echo $row["description"] ; ?></td>
                          </tr>
                          
                         <?php $count++; } 
                                           ?> 

                      </tbody>
                    </table>
                       
                  
                   
                </div>
              </div>
             </div>
<!--  <div class="col-md-1"></div> -->
   </div><!--row ends-->
    </div> <!--container ends-->


    


    <!-- Footer starts-->
     <footer>
<div class="container">
<div class="row">
<div class="col-md-4"></div>
<div class="col-lg-6"> <hr style="border-top: 1px solid #e8e1e1;"><p class="labelstaff"; style="color: black;">Copyright 2018 &copy; Online Courier Management System </p></div>
<div class="col-md-2"></div>
</div>

</div>
<!-- /.container -->
</footer><!--footer ends-->



       <!--footer ends--> 

     <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
      </body>
</html>