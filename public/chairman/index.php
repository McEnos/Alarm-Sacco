<?php 
 session_start();
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 2))
   {
      header('Location: ../login.php');
      exit();
   }
include('config.php');?>
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
<?php include 'layouts/admin_header.php' ;?>  
<?php include 'layouts/admin_navigation.php' ;?>  


    <header id="admin_header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><i class="fa fa-cog fa-spin fa-fw"></i> Alarm Sacco Chairman Dashboard</h1>
          </div>
          <div class="col-md-2">
            <div class="create">
             <b><h5><span class="" aria-hidden="true"></span>Logged in as, <b><?php echo ucfirst($_SESSION['username']);?></b></h5></b>
              
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="" class="list-group-item active main-color-bg">
                <span class="fas fa-truck" aria-hidden="true"></span> Manage Sacco Data
              </a>
                <a href="addshipment.php" class="list-group-item"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Suspended  members <span class="badge">0</span></a>
                <?php
                  $sql = mysqli_query($conn,"SELECT application_id FROM applications") or die(mysqli_error($conn));
                  $loan = mysqli_num_rows($sql);

                ?>
              <a href="manage_loan.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> List Loan Applications <span class="badge"><?php echo $loan;?></span></a>
           
              <a href="manage_shipments.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Manage Shipments <span class="badge">0</span></a>
            </div>
           
          </div>

          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-primary">
              <div class="panel-heading main-color-bg">
              <a href="" class="list-group-item active main-color-bg">
                   <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Data Master
              </a>
               
              </div>
              <div class="panel-body">
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <?php echo $loan;?></h2>
                    <h4>Total Loan Applications</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <?php 
                    $approved_sql = mysqli_query($conn,"SELECT * FROM loans") or die(mysqli_error($conn));
                    $approved = mysqli_num_rows($approved_sql);

                  ?>
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> <?php echo $approved; ?></h2>
                    <h4>Approved</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <?php 
                    $dissaprove_sql = mysqli_query($conn,"SELECT application_id FROM applications") or die(mysqli_error($conn));
                    $dissaprove = mysqli_num_rows($dissaprove_sql);

                  ?>
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> <?php echo $dissaprove; ?></h2>
                    <h4>Dissaproved</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <?php 
                    $pending_sql = mysqli_query($conn,"SELECT application_id FROM applications") or die(mysqli_error($conn));
                    $pending = mysqli_num_rows($pending_sql);

                  ?>
                  <div class="well dash-box">
                    <h2><span class="fas fa-fighter-jet" aria-hidden="true"></span> <?php echo $pending;?></h2>
                    <h4>Pending</h4>
                  </div>
                </div>
              </div>
              </div>
         </div>
   <div class=col-md-3>
                  
              <div class="list-group">
              <a href="" class="list-group-item active main-color-bg">
                <span class="fas fa-portrait" aria-hidden="true"></span> Sacco Data
              </a>
              <?php
                $members_sql = mysqli_query($conn,"SELECT user_id FROM users WHERE level != 1") or die(mysqli_error($conn));
                $members = mysqli_num_rows($members_sql);
              ?>
              <a href="members.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> View Members <span class="badge"><?php echo $members;?></span></a>
              <a href="branches_list.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> View Sacco Projects<span class="badge">0</span></a>
              <a href="officers_list.php" class="list-group-item"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>View Loans<span class="badge">0</span></a>
              <a href="branches_list.php" class="list-group-item"><span class="glyphicon glyphicon-" aria-hidden="true"></span> Project Profit <span class="badge">0</span></a>
              <a href="branches_list.php" class="list-group-item"><span class="glyphicon glyphicon-" aria-hidden="true"></span> Loan Profit <span class="badge">0</span></a>
              <a href="branches_list.php" class="list-group-item"><span class="glyphicon glyphicon-" aria-hidden="true"></span> Total Profit <span class="badge">0</span></a>
              
            </div>


      </div>
      <div class="col-md-9">
              <div class="panel panel-primary">
                <div class="panel-heading">
              <a href="" class="list-group-item active main-color-bg">
                 <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Recent Loan Applications
              </a>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Amount</th>
                        <th>Applicant</th>                    
                        <th>Application Date</th>
                      </tr>
                    </thead>
                  <tbody>
                    <?php
                   $count=1;
                   $resent_query=mysqli_query($conn,"SELECT code,amount,membership_number,DATE_FORMAT(application_date, '%M %d, %Y') AS application_date FROM applications ORDER BY application_id DESC LIMIT 2") or die(mysqli_error($conn));
                   while($row = mysqli_fetch_assoc($resent_query)) 
                    { ?>
                          <tr>
                          <td><?php echo $row["code"] ; ?></td>
                          <td><?php echo $row["amount"] ; ?></td>
                          <td><?php echo $row["membership_number"] ; ?></td>
                          <td><?php echo $row["application_date"] ; ?></td>
                          <!-- <td><a href="manage_bookings.php">view</a></td> -->
                          </tr>
                          <tr>
                         <?php } 
                        ?>
                  </tbody>
                    </table>
                </div>
              </div>
             </div>

        </div><!--row ends-->
    </div> <!--container ends-->

<div class="container">
      <div class="row">
   
       

   </div><!--row ends-->
    </div> <!--container ends-->  
      
<!-- Footer -->
<?php include 'layouts/footer.php' ;?>
<!--footer ends--> 

  

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
  </body>
</html>