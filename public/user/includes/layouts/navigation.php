
   <!-- Navigation -->
        <nav class="navbar navbar-default" >
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" style="color:#428bca;">Alarm Sacco</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Apply Loan: <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="loan.php">Cash</a></li>
                <li><a href="item.php">Item</a></li>
          </ul>
        </li>

       <li><a href="declare_deduction.php"><span class="glyphicon glyphicon-plane"></span>Monthly Deduction</a></li>
      <li><a href="contact.php"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "  Logged in as ". ucfirst($_SESSION['username']);?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="profile.php">View Profile</a></li>
              <li><a href="quit.php?quit=1&number=<?=$_SESSION['membership_number'];?>">Quit Sacco</a></li>
                <li><a href="../forgot_password.php">Change Password</a></li>
                 <li><a href="logout.php"> Logout </a></li>
          </ul>
        </li>
      
       
     
    </ul>
  </div>
</nav>


        <!--Navigation ends-->