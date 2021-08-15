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
      <?php
      if(isset($_SESSION['email'])&& $_SESSION['email']=== 'admin@allday.com'){
         echo '
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
                     <h2>Admin Control Panel </h2>
                  </div>
               </div>
               <div class="col-md-8">
                  <br><br><br><br><br>
                  <a href="addItemForm.php"><input  class="btn btn-danger"type="submit" name="delSubmit" value="Items Controls"></a>
                  <a href="addEmployeeForm.php"><input  class="btn btn-danger"type="submit" name="delSubmit" value="Employees Controls"></a>
                  <a href="addSupplierForm.php"><input  class="btn btn-danger"type="submit" name="delSubmit" value="Supplier Controls"></a>
               </div>
               <div class="col-md-4">
                  <img src="assets/images/adnan.jpeg" class="img-fluid" alt="">
                  <h5 class="text-center" style="margin-top: 15px;">
                     Website Manager <br> Adnan Hourani<br><br>
                     <form action="logout.php" method="post">
                        <button class="btn btn-danger" type="submit">Log-Out</button>
                     </form>
                  </h5>
                  <br>
               </div>
            </div>
         </div>
      </div>
      </div>
      </div>' ;
      }
      else 
      header('Location:index.php');
      ?>
 
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