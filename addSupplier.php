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
    $sName = $_POST['sName'];
    $company = $_POST['sCmp'];
    $phone = $_POST['sNumber'];
    $type = isset($_FILES['sPhoto']) ? (explode('.', $_FILES['sPhoto']['name'])) : null;
    if (!empty($type)) { //a file was upload
        $type = end($type); //get the extension
        $allowed = ['png', 'jpg'];
        if (in_array($type, $allowed)) { //type is allowed
            $tmp_name = $_FILES['sPhoto']['tmp_name'];
            $name = $_FILES['sPhoto']['name'];
            $target_dir = 'assets/images/suppliers/';

            //move the file to the target location
            $target_file = $target_dir . basename($_FILES["sPhoto"]["name"]);
            move_uploaded_file($tmp_name, $target_file);

        }else { //not allowed so we set error message
            $uploadError = 'This type isnt allowed!';
            echo($uploadError);
        }

    }else { //no file was passed in so we let it continue to insert
        $target_file = null;
    }

    if (empty($uploadError)) { //no errors, so we insert
        $sql = "INSERT INTO suppliers (name,company,phone,avatar) VALUES (?,?,?,COALESCE(?, avatar, DEFAULT(avatar)));";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ssis", $sName, $company, $phone, $target_file);
        mysqli_stmt_execute($stmt);
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
            		include 'navadmin.php';
            	}
            	else{
            		include 'navuser.php';
            	}
            }
            else{
            	include 'nav.php';
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
                     <h2>Admin Panel ~ Add a Supplier</h2>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="contact-form">
                     <form action="addSupplier.php" method="post" enctype="multipart/form-data">
                        <div class="row">
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
                           <div class="col-lg-12 col-md-12 col-sm-12">
                              <fieldset>
                                 <input type="file" name="sPhoto" id="Image">
                              </fieldset>
                           </div>
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
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <fieldset>
                        <br>
                        <form action="addSupplier.php" method="post">
                           <input type="text" name="name" placeholder="Supplier Name To Delete">
                           <input  class="btn btn-danger"type="submit" name="delSubmit" value="Delete">
                           <br>
                        </form>
                     </fieldset>
                     <br>
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