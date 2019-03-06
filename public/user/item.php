<?php
	session_start();
   if(!(isset($_SESSION['membership_number'])) || ($_SESSION['user_level'] != 0))
   {
      header('Location: ../login.php');
      exit();
   }
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
   <?php include 'includes/layouts/navigation.php';?>
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
   	if(isset($_POST['apply']))
   	{
   		$number=$_POST['number'];
   		$item_type = $_POST['item_type'];
   		//check if member_number exists
   		$member_exists = mysqli_query($conn,"SELECT membership_number FROM users WHERE membership_number = '$number'") or die(mysqli_error($conn));
   		if(mysqli_num_rows($member_exists) === 1)
   		{
   			switch($item_type)
   			{
   				case "Motobike":
   				$amount_to_paid = (1.05 * 120000);
   				$months_of_payment = 12;
   				break;

   				case "Gas Cooker":
   				$amount_to_paid = (1.05 * 6000);
   				$months_of_payment = 3;
   				break;

   				case "Bike":
   				$amount_to_paid = (1.05 * 10000);
   				$months_of_payment = 4;
   				break;

   				case "TV":
   				$amount_to_paid = (1.05 * 10000);
   				$months_of_payment = 4;
   				break;

   				case "Mobile Phone":
   				$amount_to_paid = (1.05 * 15000);
   				$months_of_payment = 4;
   				break;

   			}
   				echo $amount_to_paid.'<br/>';
   				echo $months_of_payment.'<br/>';
   				//check if member is having an item application or serving an loan
   				$query_loan_status = mysqli_query($conn,"SELECT * FROM loans WHERE membership_number = '$number'") or die(mysqli_error($conn));
   				{
   					if(mysqli_num_rows($query_loan_status) > 0)
   					{
   						//check if the loan paid is 75% of total paid,
   						$row = mysqli_fetch_assoc($query_loan_status);
   						$loan_borrowed = $row['amount_borrowed'];
   						$amount_remaining = $row['amount_remaining'];
   						//check if amountremaining is more than 25% of loan borrowed i.e 75% paid or not
   						if(($amount_remaining) > (0.25 * $loan_borrowed))
   						{
   							echo' <div class="alert alert-danger alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert"
                               aria-hidden="true">
                               &times;
                               </button>
                               Sorry! You have to pay 75% of your current loan before applying for an Item.
                              </div>';
   						}
   						else
   						{	//if already serviced 75% of current loan,let the member apply for this item
   							$code = GenerateCode();

			   				$result=mysqli_query($conn,"INSERT INTO items(code,item_name,membership_number) 
			                  VALUES('$code','$item_type','$number')") or die(mysqli_error($conn));
			                     if($result)
			                        {
			                        
			                          echo '<script> window.location="item.php?success=True" </script>';
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
   					else
   					{
   						//let the member apply if no no pending loan servicing
   						$code = GenerateCode();
		   				echo $code;

		   				$result=mysqli_query($conn,"INSERT INTO items(code,item_name,membership_number) 
		                  VALUES('$code','$item_type','$number')") or die(mysqli_error($conn));
		                     if($result)
		                        {
                        
                          echo '<script> window.location="item.php?success=True" </script>';
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
   	}


   ?> 
   <div class="container">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      
     <div class="panel panel-info calculator" style="margin:20px;">
<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title text-center text-warning">Item Application</h3>
</div>
<div class="panel-body">
    <form  method="POST" action="item.php">
    <div class="col-md-12 col-sm-12">
      
       <div class="form-group col-md-8">
            <label class="labelstaff">Membership Number:</label>
            <input name="number" class="form-control input-sm" id="number" required="required" value="<?php if(isset($_POST['number'])) echo $_POST['number']?>"> 
        </div>
          <div class="form-group col-md-8">
             <label  class="labelstaff">Select Of Item:</label>
            <select name="item_type" class="form-control" required="required">
            <option></option>
            <option value="Motobike">Motobike</option>
            <option value="Gas Cooker">Gas Cooker</option>
            <option value="Bike">Bike</option>
             <option value="TV">TV Sets</option>
            <option value="Mobile Phone">Mobile Phone</option>
           </select>
          </div>
       <div class="col-md-12">
        <div class="form-group col-md-1 col-sm-3 " >
            <input type="submit"  name="apply" class="btn btn-outline-primary btn-primary btn-md" value="Request Item"/>
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