<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>AllDay Market ~ Your Needs At One Place</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

  <!-- Header -->
      <header class="">
      <?php
      $employee=$_GET['id'];
      session_start();
      if(isset($_SESSION['email'])){
        if($_SESSION['email'] === 'admin@allday.com'){
    $basedir = realpath(__DIR__);
          include($basedir . '/navbars/navadmin.php');
        }
        else{
    $basedir = realpath(__DIR__);
          include($basedir . '/navbars/navuser.php');
        }
      }
      else{
  $basedir = realpath(__DIR__);
  include($basedir . '/navbars/nav.php');
      }
	
?>
</header>

    <!-- Page Content -->
    <div class="page-heading contact-heading header-text" style="background-image: url(assets/images/heading-4-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>AllDay ~ Market</h4>
              <h2>Admin Panel</h2>
            </div>
          </div>
        </div>
      </div>
    </div>    
    <div class="send-message">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Edit Item</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div class="contact-form">
              <form action="addEmployeeForm.php" method="post" enctype="multipart/form-data">
					 <input type="hidden" name="id" value="<?php echo $employee ?>">
                      <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                     <input name="eID" type="number" class="form-control" id="name" placeholder="Employee ID" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="eFirstname" type="text" class="form-control" id="name" placeholder="Employee Firstname" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="eLastname" type="text" class="form-control" id="name" placeholder="Employee Lastname" required="">
                    </fieldset>
                  </div>
				   <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="depNum" type="number" class="form-control" id="name" placeholder="Employee Department Number" required="">
                    </fieldset>
                  </div>
				  
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
						<input type="number" name="PerHour" id="perhour" placeholder="Employee PerHour" required="">
                    </fieldset>
                  </div>
				  <br><br>
				  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="eResidence" type="text" class="form-control" id="name" placeholder="Employee Residence" required="">
                    </fieldset>
                  </div>
					<div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                     	<input type="file" name="ePhoto" id="Image">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
					<br>
                      <button type="submit" name="submit" class="filled-button" value="Submit">Update Employee</button>
                    </fieldset>
					<br>
                  </div>
                </div>
              </form>
            </div>
          </div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
               <p>Copyright © 2021 AllDay Market</p>
            </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>

</html>
