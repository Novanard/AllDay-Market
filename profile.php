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
              <h2>Profile Page</h2>
            </div>
          </div>
        </div>
      </div>
    </div>  
<br><br>
		<div class="container">
				<?php 
		include 'db.php';
		if(isset($_SESSION['email'])){
			$email = $_SESSION['email'];
			$sql = "SELECT * FROM users WHERE email = ?";
	        $stmt= mysqli_stmt_init($conn);
	        mysqli_stmt_prepare($stmt,$sql);
	        mysqli_stmt_bind_param($stmt,"s",$email);
	        mysqli_stmt_execute($stmt);
	        $results=mysqli_stmt_get_result($stmt);
		  while ($row=mysqli_fetch_assoc($results))
	        {                  
					$name = $row['name'];
					$email = $row['email'];
					$address = $row['address'];
					$number = $row['number'];
          $img = $row['avatar'];
          echo '
         <center> <div class="col-md-6">
            <div class="product-item">
            <a href="#"><img src="'.$img.'" alt=""></a>
             <div class="down-content">
            <center><strong>Hello &nbsp ~ &nbsp '.$name.'</center>
             </div>
              <br>
              <div>
              <ul>
              <li><strong>Email:</strong>'.$email.'</li>
              <li><strong>Phone No:</strong>'.$number.'</li>
              <li><strong>Adress:</strong>'.$address.'<li>
              </div>
              <div>

              </div>
              </div>
            </div></center>
            ';

	        }
	    }			
?> 	
 <!-- 
                     <a href="editProfileForm.php?id='.$ID.'"> 
                  <button class="btn btn-secondary" type="button" class="filled-button" class="editBtn">Edit</button>
                  </a>
    -->
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