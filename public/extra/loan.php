
  <?php 
   include('user/session.php');
   if (!ismember()) {
  $_SESSION['msg'] = "You must log in first";
  header('location:login.php');
    }
  include("config.php"); ?>
  <?php include 'includes/layouts/header.php' ;?>
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
     Success! Your Order has been received.
    </div>';   
     } 
     if(isset($_POST['apply'])){  
        $mobile=$_POST['mobile'];      
        $period=$_POST['period'];                 
        $description=$_POST['description'];
         $result=mysqli_query($conn,"INSERT INTO `applications` (origin,destination,urgency,packing,weight,length,wide,sender_name,sender_mobile,recipient_name,recipient_mobile,description) 
         VALUES('$period','$description')") or die(mysqli_error($conn));
         if($result){
          
           echo '<script> window.location="online_booking.php?success=True" </script>';
         }else{
           
            echo' <div class="alert alert-danger alert-dismissable">
             <button type="button" class="close" data-dismiss="alert"
             aria-hidden="true">
             &times;
             </button>
             Sorry! something went wrong.Please try again.
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
      <h3 class="panel-title text-center text-warning">Loan Application</h3>
</div>
<div class="panel-body">
    <form  method="POST" action="loan.php">
    <div class="col-md-12 col-sm-12">
      
       <div class="form-group col-md-8">
            <label class="labelstaff">Mobile Number:</label>
            <input name="mobile" class="form-control input-sm" id="mobile" required="required" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile']?>"> 
        </div>
        <div class="form-group col-md-8">
             <label  class="labelstaff">Period:</label>
            <select name="period" class="form-control" required="required">
            <option value="">Select Period...</option>
            <option value="1">1 month</option>
            <option value="2">2 months</option>
            <option value="3">3 months</option>
            <option value="6">6 months</option>
            <option value="12">1 Year and Above</option>
           </select>
        </div>
        <div class="form-group col-md-8">
             <label  class="labelstaff">Outstanding loan</label>
            <select name="status" class="form-control" required="required">
            <option value="">Select loan Status...</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
            
           </select>
        </div>

        <div class="form-group col-md-8">
            <label class="labelstaff">Short Description About Loan Purpose:</label>
            <textarea type="text" class="form-control input-sm" name="description" required="required"></textarea> 
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