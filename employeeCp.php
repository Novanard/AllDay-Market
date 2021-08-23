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
         session_start();
         if(isset($_SESSION['eID'])){
         $eID = $_SESSION['eID'];
         if (isset($_POST['submit'])) {
         include 'db.php';
         $type = (explode('.', $_FILES['ePhoto']['name']));
         $tmp_name = $_FILES['ePhoto']['tmp_name'];
         $name = $_FILES['ePhoto']['name'];
         $target_dir = 'assets/images/employees/';
         $type = end($type);
         $allowed = ['png','jpg'];
         if(in_array($type, $allowed)){
         $target_file = $target_dir . basename($_FILES["ePhoto"]["name"]);
         move_uploaded_file($tmp_name, $target_file);
         $sql = "UPDATE employees SET avatar = ? WHERE eID = ?;";
         $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"si",$target_file,$eID);
          mysqli_stmt_execute($stmt);
            }
         else
         $uploadError = 'This type isnt allowed!';	
         
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
            if(isset($_SESSION['eID'])){
               include 'db.php';
               $eID = $_SESSION['eID'];
                $basedir = realpath(__DIR__);
                include($basedir . '/navbars/navEmployee.php');
                //Getting the employee avatar
                $sql = "SELECT avatar from employees WHERE eID = ? LIMIT 1";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"i",$eID);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($res);
                $avatar = $row['avatar'];
            }
            else{
                header('Location:index.php');
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
                     <h2>Employee  Panel</h2>
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
                     <h2>Employee Control Panel </h2>
                  </div>
               </div>
               <div class="col-md-8">
                  <br><br><br><br><br>
                  <a href="employeeStatus.php"><input  class="btn btn-danger"type="submit"  value="Employee Status"></a>
                  <a href="employeeOrders.php"><input  class="btn btn-danger"type="submit"  value="View Orders"></a>
                  <a href="shiftForm.php"><input  class="btn btn-danger"type="submit"  value="Shift Controls"></a>
               </div>
               <div class="col-md-4"><center>
                  <img src=" <?php echo($avatar); ?> " height="370px" width="270px" class="img-fluid" alt="">
                  <h5 class="text-center" style="margin-top: 15px;"></h5>
                     <?php echo('Employee:' .$_SESSION['firstname'] .'&nbsp' .$_SESSION['lastname']); ?>
                     <form action="logout.php" method="post">
                        <button class="btn btn-danger" type="submit">Log-Out</button>
                     </form>
                     <br><br>
                     <form action="employeeCp.php" method="post" enctype="multipart/form-data">
                        <div>
                           <fieldset>
                              <input type="file" name="ePhoto" id="ePhoto" required="">
                           </fieldset>
                        </div>
                        <div >
                           <fieldset>
                              <br>
                              <button type="submit" name="submit" class="btn btn-success" value="Submit">Upload Photo</button>
                           </fieldset>
                        </div>
                     </form>
         </center>
                  
                  <br>
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