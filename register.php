﻿<!DOCTYPE html>
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
  <?php 
  $isRegistered = 0;  
if ($_SERVER['REQUEST_METHOD'] === "POST" ) {
 
include 'db.php'; 
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $hashedpwd=password_hash($password, PASSWORD_DEFAULT);
  $address=$_POST['address'];
  $number=$_POST['number'];


      //Check if the user is already registered
      $sql = "SELECT * FROM users WHERE email = ?;";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"s",$email);
      mysqli_stmt_execute($stmt);
      $res = mysqli_stmt_get_result($stmt);
      if(mysqli_num_rows($res)>0)
      $isRegistered =1;
      else{
      $sql = "INSERT INTO users (name,email,password,address,number) VALUES (?,?,?,?,?);";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"sssss",$name,$email,$hashedpwd,$address,$number);
        mysqli_stmt_execute($stmt);
        //Setting default avatar
        $sql ="SELECT id FROM users ORDER BY id DESC LIMIT 1;";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($res);
        $id = $row['id'];

        $sql = "UPDATE users SET avatar = ? WHERE id =?;";
        $avatar = "assets/images/users/noPic.jpg";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"si",$avatar,$id);
        mysqli_stmt_execute($stmt);

        header('Location:login.php');
    }
  }

?>
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
            	if($_SESSION['userType'] == 1){
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
				include($basedir . '/navbars/navbar.php');
            }
            
            ?>
</header>
   
    <!-- Page Content -->
    <div class="page-heading contact-heading header-text" style="background-image: url(assets/images/items/heading-4-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>AllDay ~ Market</h4>
              <h2>Register</h2>
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
              <h2>User Panel - Register</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div class="contact-form">
              <form action="register.php" method="post" enctype="multipart/form-data">
                      <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="email" type="email" class="form-control" id="name" placeholder="Email Address" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="password" type="password" class="form-control" id="name" placeholder="Enter Your Password" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="address" type="text" class="form-control" id="name" placeholder="Full Address" required="">
                    </fieldset>
                  </div>
				<div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="number" type="text" class="form-control" id="name" placeholder="Phone No." required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
					<br>
                      <button type="submit" name="submit" class="filled-button" value="Submit">Register</button>
                    </fieldset>
					<br>
                  </div>
                </div>
              </form>
              <?php
              if($isRegistered==1){
                echo	'  <hr><div class="alert alert-warning" role="alert">
                <p class="text-center" font-weight:bold>Email is already registered</p>
               </div><hr>';

              }
              ?>
            </div>
          </div>
	</div>
		  </div>
        </div>
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
