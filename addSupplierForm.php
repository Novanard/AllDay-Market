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
         mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $uploadError = '';
         if (isset($_POST['submit'])) {
         include 'db.php';
         $sID = $_POST['sID'];
         $sName = $_POST['sName'];
         $company = $_POST['sCmp'];
         $phone = $_POST['sNumber'];
         $avatarr = NULL;
         $sql = "INSERT INTO suppliers (sID,name,company,phone) VALUES (?,?,?,?);";
          $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"issi",$sID,$sName,$company,$phone);
           mysqli_stmt_execute($stmt);
           $sql = "SELECT avatar FROM suppliers WHERE sID =? ";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results=mysqli_stmt_get_result($stmt);
           while($row=mysqli_fetch_assoc($results))
           {
              $avatarr=$row['avatar'];
           }
           if(is_null($avatarr))
           {
             $sql = "UPDATE suppliers set avatar = 'assets/images/suppliers/noPic.jpg' WHERE sID = ?; ";
             $stmt= mysqli_stmt_init($conn);
             mysqli_stmt_prepare($stmt,$sql);
             mysqli_stmt_bind_param($stmt,"i",$sID);
             mysqli_stmt_execute($stmt);
             echo('executed');
           
           }
          }
         
         else if (isset($_POST['delSubmit'])) {
            	include 'db.php';
            	$name = $_POST['name'];
            	$sql= "DELETE FROM suppliers WHERE name = ?;";
            	$stmt= mysqli_stmt_init($conn);
            	mysqli_stmt_prepare($stmt,$sql);
            	mysqli_stmt_bind_param($stmt,"s",$name);
            	mysqli_stmt_execute($stmt);	
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
				include($basedir . '/navbars/nav.php');
            }
            
            ?>
      </header>
      <!-- Page Content -->
      <?php
     if(isset($_SESSION['email'])&& $_SESSION['userType']== 1){
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
                     <h2>Admin Panel ~ Add a Supplier</h2>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="contact-form">
                     <form action="addSupplier.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-sm-12">
                              <fieldset>
                                 <input name="sID" type="number" class="form-control" id="name" placeholder="Supplier ID" required="">
                              </fieldset>
                           </div>
                           <div class="col-lg-12 col-md-12 col-sm-12">
                              <fieldset>
                                 <input name="sName" type="text" class="form-control" id="name" placeholder="Supplier Name" required="">
                              </fieldset>
                           </div>
                           <div class="col-lg-12 col-md-12 col-sm-12">
                              <fieldset>
                                 <input name="sCmp" type="text" class="form-control" id="name" placeholder="Company Name" required="">
                              </fieldset>
                           </div>
                           <div class="col-lg-12 col-md-12 col-sm-12">
                              <fieldset>
                                 <input type="number" name="sNumber" id="perhour" placeholder="Phone Number" required="">
                              </fieldset>
                           </div>
                           <br><br>
                           <div class="col-lg-12">
                              <fieldset>
                                 <br>
                                 <button type="submit" name="submit" class="filled-button" value="Submit">Add Supplier</button>
                              </fieldset>
                              <br>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-md-4">
                  <br><br><br><br><br><br><br>
                  <a href="adminCp.php"><button class="btn btn-danger" type="submit">Back to Control Panel</button></a>
                  </h5>
                  <br>
               </div>
               <br>
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