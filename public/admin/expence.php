<?php include("config.php"); ?>
<?php include 'layouts/admin_header.php' ;?>
    
  <body>
  <!-- Navigation -->
   <?php include 'layouts/admin_navigation.php'; 
   
          


   ;?>  
  <?php
    if(isset($_GET['success'])){
     echo' <div class="alert alert-success alert-dismissable">
     <button type="button" class="close" data-dismiss="alert"
     aria-hidden="true">
     &times;
     </button>
     Success! project added successfully.
    </div>';   
     } 
     if(isset($_POST['registration']))
     {
      
           $type = $_POST['expence'];
           $cost = $_POST['cost'];

           $insert_query = mysqli_query($conn,"INSERT INTO expence(type,cost)VALUES('$type','$cost')") or die(mysqli_error($conn));
           if(insert_query)
           {
              echo '<script> window.location="expence.php?success=True&code='.$membership_number.'" </script>';
           }             
                          
     }
    ?>
<!--Login starts-->
<div class="container"> 
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    
<div class="panel panel-default" style="margin:40px;">
<div class="panel-heading "><h3 class="panel-title text-center">Sacco Expenditure</h3></div>
<div class="panel-body">
  <form method="POST" action="expence.php">
    <div class="col-md-12 col-sm-12">
      <div class="form-group col-md-8">
             <label for="mobile" class="labelstaff">Expence Type:</label>
            <select class="form-control" id="userLevel" name="expence" type="text" required="required">
              <option></option>
            <option value="rent">Rent</option>
            <option value="electricity">Electricity</option>
            <option value="miscellaneous">Miscellaneous</option>
           </select>
        </div>
       <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Expence Amount</label>
            <input type="text" class="form-control input-sm" name="cost" required/>
        </div>       
       <div class="col-md-12">
        <div class="form-group col-md-1 col-sm-3 ">

            <input type="submit" class="btn btn-primary pull-left" name="registration" value="Add Expence"/>

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
</div><!--container ends-->
<footer>
<div class="container">

       <!-- Footer starts-->
      <?php include 'layouts/footer.php' ;?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>