<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Dashboard</title>
    <!-- Bootstrap core CSS -->
     <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
     <link href="../css/fontawesome-all.min.css" rel="stylesheet" />
     <link href="../css/styles.css" rel="stylesheet" />
       <script src="../bootstrap/js/jquery.min.js"></script>
     <!-- <script type="../text/javascript" src="bootstrap/js/jquery-3.3.1.min.js"></script> -->
     <link href="../css/jquery.datetimepicker.css" rel="stylesheet" />
        <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
  </head>