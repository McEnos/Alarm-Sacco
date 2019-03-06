<?php
 session_start();
 require_once('config.php');
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 1))
   {
      header('Location: ../login.php');
      exit();
   }
 ?>
 <!DOCTYPE html>
<html lang="en">
    <head>

        <title>Loan Applications</title>

        <link href="includes/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
     
        <link rel="stylesheet" type="text/css" href="includes/css/DT_bootstrap.css">
		
        <link href="modal/css1/bootstrap1.css" rel="stylesheet" type="text/css" media="screen">
     


</head>
<script src="modal/js1/jquery1.js" type="text/javascript"></script>
<script src="modal/js1/bootstrap1.js" type="text/javascript"></script>



<script src="includes/js/jquery.js" type="text/javascript"></script>
<script src="includes/js/bootstrap.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8" language="javascript" src="includes/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="includes/js/DT_bootstrap.js"></script>
<body>
	<?php include 'layouts/admin_navigation.php' ;?> 
    <div class="row-fluid">
        <div class="span12">
            <div class="container">

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><i class="icon-user icon-large"></i>&nbsp;Pending Loan Applications</strong>
                            </div>
                            <thead>
                                <tr>
                                   
                                    <th style="text-align:center;">Application Code</th>
                                    <th style="text-align:center;">Loan Type</th>
                                    <th style="text-align:center;">Amount</th>
                                    <th style="text-align:center;">Application Date</th>
									<th style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
								
								$result = mysqli_query($conn,"SELECT application_id,code,type,amount,membership_number,DATE_FORMAT(application_date, '%M %d, %Y') AS application_date FROM applications  ORDER BY application_id ASC") or die(mysqli_error($conn));
								$type = '';
								while($row = mysqli_fetch_assoc($result)){
									$id=$row['application_id'];
									$loan_type = $row['type'];

									switch($loan_type)
									{
										case 1:
										$type = 'Instant';
										break;

										case 2:
										$type = 'Normal';
										break;

										case 3:
										$type = 'School Fees';
										break;

										case 4:
										$type = 'Item';
										break;

										case 5:
										$type = 'Top Up Loan';
										break;

									}
							?>
								<tr>
								<!-- <td style="text-align:center; word-break:break-all; width:300px;"></td> -->
								<td style="text-align:center; word-break:break-all; width:150px;"> <?php echo $row ['code']; ?></td>
								<td style="text-align:center; word-break:break-all; width:200px;"><?php echo $type;?></td>
								<td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['amount']; ?></td>
								<!-- <td style="text-align:center; word-break:break-all; width:200px;"></td> -->
								<td style="text-align:center; word-break:break-all; width:450px;"> <?php echo $row ['application_date']; ?></td>
								<td style="text-align:center; width:600px;">
									<a href="#details<?php echo $id;?>"  data-toggle="modal" class="btn btn-info">Details</a>
								
									<a href="approve_loan.php<?php echo '?id='.$id; ?>" class="btn btn-info">Approve</a>
									 <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-danger" >Dissaprove </a>
								</td>
								<div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
								<h3 class="text-center" id="myModalLabel">Dissaprove Loan Application</h3>
								</div>
								<div class="modal-body">
								<p><div style="font-size:larger;" class="alert alert-danger">Are you Sure you want dissaprove loan application <b style="color:red;"><?php echo $row['code'];?></b>?</p>
								</div>
								<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
								<a href="dissaprove_loan.php?loan_id=<?php echo $id;?>"class="btn btn-danger">Yes</a>
								</div>
								</div>
								</div>
								</tr>
								<?php } ?>
                            </tbody>
                        </table>


          
        </div>
        </div>
        </div>
    </div>


</body>
</html>