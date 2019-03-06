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
      
           $project_name = $_POST['project_name'];
           $project_cost = $_POST['project_cost'];
           $description = $_POST['description'];

           $insert_query = mysqli_query($conn,"INSERT INTO projects(name,cost,description)VALUES('$project_name','$project_cost','$description')") or die(mysqli_error($conn));
           if(insert_query)
           {
              echo '<script> window.location="add_project.php?success=True&code='.$membership_number.'" </script>';
           }             
                          
     }
    ?>
<!--Login starts-->
<div class="container"> 
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    
<div class="panel panel-default" style="margin:40px;">
<div class="panel-heading "><h3 class="panel-title text-center">Project Registration</h3></div>
<div class="panel-body">
  <form method="POST" action="add_project.php">
    <div class="col-md-12 col-sm-12">
       <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Project Name</label>
            <input type="text" class="form-control input-sm" name="project_name" required/>
        </div>
        <div class="form-group col-md-8">
            <label for="Password" class="labelstaff">Project Cost:</label>
            <input type="text" class="form-control input-sm" name="project_cost" required/>
        </div>
        <div class="form-group col-md-8">
           <textarea cols="45" rows="5" name="description" required="required">
             
           </textarea>
        </div>
       <div class="col-md-12">
        <div class="form-group col-md-1 col-sm-3 ">

            <input type="submit" class="btn btn-primary pull-left" name="registration" value="Add Project"/>

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