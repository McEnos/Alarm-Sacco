<?php
	session_start();
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 1))
   {
      header('Location: ../login.php');
      exit();
   } ?>
 <!DOCTYPE html>
<html lang="en">
    <head>

        <title>Online Loan management services</title>

        <link href="includes/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
     
        <link rel="stylesheet" type="text/css" href="includes/css/DT_bootstrap.css">
		
        <link href="modal/css1/bootstrap1.css" rel="stylesheet" type="text/css" media="screen">


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
<script src="modal/js1/jquery1.js" type="text/javascript"></script>
<script src="modal/js1/bootstrap1.js" type="text/javascript"></script>



<script src="includes/js/jquery.js" type="text/javascript"></script>
<script src="includes/js/bootstrap.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8" language="javascript" src="includes/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="includes/js/DT_bootstrap.js"></script>
<body>
	<?php //include 'layouts/admin_header.php' ;?>  
	<?php include 'layouts/admin_navigation.php' ;?>  


       
            <div class="container">
            		<div class="row">
            			<div class="col-md-9">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><i class="icon-user icon-large"></i>&nbsp;Registered Members</strong>
                            </div>
                            <thead>
                                <tr>
                                    <th style="text-align:center;">First Name</th>
                                    <th style="text-align:center;">Last Name</th>
                                    <th style="text-align:center;">Mobile</th>
                                    <th style="text-align:center;">ID Number</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
								require_once('config.php');
								$result = mysqli_query($conn,"SELECT * FROM users WHERE level != 1 ORDER BY user_id ASC") or die(mysqli_error($conn));
								
								while($row = mysqli_fetch_assoc($result)){
									$id=$row['user_id'];
							?>
								<tr>
								<td style="text-align:center; word-break:break-all; width:150px;"> <?php echo $row ['fname']; ?></td>
								<td style="text-align:center; word-break:break-all; width:150px;"> <?php echo $row ['lname']; ?></td>
								<td style="text-align:center; word-break:break-all; width:150px;"> <?php echo $row ['mobile']; ?></td>
								<td style="text-align:center; word-break:break-all; width:100px;"> <?php echo $row ['id_no']; ?></td>
								<!-- <td style="text-align:center; width:200px;">
									<a href="edit.php<?php echo '?id='.$id; ?>" class="btn btn-info">Edit</a>
									 <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-danger" >Suspend </a>
								</td> -->
									
										<!-- Modal -->
								<div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
								<h3 id="myModalLabel">Suspend</h3>
								</div>
								<div class="modal-body">
								<p><div style="font-size:larger;" class="alert alert-danger">Are you Sure you want Delete <b style="color:red;"><?php echo $row['fname']." ".$row['lname'] ; ?></b> Data?</p>
								</div>
								<hr>
								<div class="modal-footer">
								<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
								<a href="delete_member.php?member_id=<?php echo $id;?>"class="btn btn-danger">Yes</a>
								</div>								
								</tr>
								<?php } ?>
                            </tbody>
                        </table>
          				</div>
        		</div>
        	</div>
</body>
</html>