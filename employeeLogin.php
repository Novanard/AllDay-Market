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
  <?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   	include "db.php";
   	$eID=$_POST['eID'];
   	$PIN=$_POST['PIN'];
  	$sql = "SELECT * FROM employees WHERE eID = ? AND PIN = ? LIMIT 1";
    $stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"is",$eID,$PIN);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result)>0){
    	$row = mysqli_fetch_assoc($result);
    		session_start();
            $_SESSION['eID']=$row['eID'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['avatar'] = $row['avatar'];
    		 header('Location:employeeCp.php');
    	}
    	else{
    		echo "Incorrect Details";
    		exit();
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
				include($basedir . '/navbars/navbar.php');
            }
            
            ?>
</header>


    <div class="page-heading contact-heading header-text" style="background-image: url(assets/images/heading-4-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>AllDay ~ Market</h4>
              <h2>Log-in</h2>
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
              <h2>User Panel - Login</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div class="contact-form">
              <form action="employeeLogin.php" method="post" enctype="multipart/form-data">
                      <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="eID" type="number" class="form-control"  placeholder="Employee ID Number" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="PIN" type="password" class="form-control" maxlength="4" placeholder="Enter Your PIN" pattern="[0-9]+" title="Must be 4Digit Number only" required="">
                    </fieldset>
                  </div>
					<br>
                      <button type="submit" name="submit" class="filled-button" value="Submit" style="padding: 5px 10px;">Log-in</button>
                    </fieldset>
					<br>
                  </div>
                </div>
              </form>
			  <br><br>
            </div>
          </div>
		 <div>
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