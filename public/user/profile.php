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
    	//query user information from users table
    
    	$membership_number = $_SESSION['membership_number'];
    	$query_user = mysqli_query($conn,"SELECT membership_number,CONCAT(fname,' ',lname) AS name,mobile,id_no FROM users WHERE membership_number = '$membership_number'") or die(mysqli_error($conn));
    	$row = mysqli_fetch_assoc($query_user);
    ?>
<div class="panel panel-default" style="margin:40px;">
<div class="panel-heading "><h3 class="panel-title text-center">Name: <?=ucwords($row['name']);?></h3></div>
<div class="panel-body">
  <table class="table">
  	<tr>
  		<td><b>Membership Number</b></td>
  		<td><?=$row['membership_number'];?></td>
  	</tr>
  	<tr>
  		<td><b>Mobile Number</b></td>
  		<td><?=$row['mobile'];?>    <button>Update</button></td>

  	</tr>
  	<tr>
  		<td><b>National ID Number</b></td>
  		<td><?=$row['id_no'];?></td>
  	</tr>
  	<tr>
  		<?php
  			//get shares of the member
  			$query_shares = mysqli_query($conn,"SELECT amount FROM shares WHERE membership_number ='$membership_number'") or die(mysqli_error($conn));
  			$row = mysqli_fetch_assoc($query_shares);

  		?>
  		<td><b>Amount Of Shares</b></td>
  		<td><?=$row['amount'];?></td>
  	</tr>
  	<tr>
  		<?php
  			//check loan status
  		$query_loan_status = mysqli_query($conn,"SELECT type_id,amount_borrowed,amount_remaining FROM loans WHERE membership_number = '$membership_number'") or die(mysqli_error($conn));
  		?>
  		<td><b>Loan Status</b></td>

  		<td>
  			<?php
        // $query_item = mysqli_query($conn,"SELECT item_name FROM items WHERE membership_number='$membership_number'") or die(mysqli_error($conn));
        // if(mysqli_num_rows($query_item) > 0)
        // {
        //     $item = mysqli_fetch_assoc($query_item);
        //     $item_name = $item['item_name'];
        // }
       

  			if(mysqli_num_rows($query_loan_status) > 0)
  			{
  				while($row = mysqli_fetch_assoc($query_loan_status))
  				{
            $loan_type = $row['type_id'];
            $query_amount = mysqli_query($conn,"SELECT amount_remaining FROM loans WHERE type_id ='$loan_type' AND membership_number ='$membership_number'") or die(mysqli_error($conn));
            while($loan = mysqli_fetch_assoc($query_amount))
            {
                  $amount = $loan['amount_remaining'];
                  switch($row['type_id'])
                  {
                    case 1:
                    $type = "Instant";
                    break;

                    case 2:
                    $type = "Normal";
                    break;

                    case 3:
                    $type = "School Fees";
                    break;

                    case 4:
                    $type = "Top Up Loan";
                    break;
                  }

                  ?>
                  <ul>
                    <li><?=$type?>  Amount: <?=$amount?></li>
                  </ul>
                  <?php
                }
            }
  				
  			}
  			else
  			{
  				echo "Currently You have no Loan";
  			}

  			?>
  		</td>

  	</tr>
  </table>
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