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
         if (isset($_POST['submit']) && isset($_POST['checkIn'])) {
          include 'db.php';
         	$eID = $_POST['eID'];
            // Checking if the entered eID is a valid eID
           $sql = "SELECT * FROM employees WHERE eID = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results=mysqli_stmt_get_result($stmt);
          $row=mysqli_fetch_assoc($results);
           if(isset($row['eID'])){
           $startTime = date("Y-m-d H:i:s");
           // Checking if the employee is already checked-in
           $sql = "SELECT * FROM shift WHERE eID = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results=mysqli_stmt_get_result($stmt);
           $row=mysqli_fetch_assoc($results);
          if (isset($row['eID']))
            echo('Employee Already in their shift');
           else{
              // If not checked in, it created a record.
            $sql = "INSERT INTO shift (eID,startTime) VALUES (?,?);";
         		$stmt= mysqli_stmt_init($conn);
         	    mysqli_stmt_prepare($stmt,$sql);
         	    mysqli_stmt_bind_param($stmt,"is",$eID,$startTime);
         	    mysqli_stmt_execute($stmt);
               echo('Successfully checked-in your shift!');
         }
         }
         }
         else if (isset($_POST['submit']) && isset($_POST['checkOut'])) {
          include 'db.php';
         	$eID = $_POST['eID'];
            // Checking if the entered ID is a valid employee ID
           $sql = "SELECT * FROM employees WHERE eID = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results=mysqli_stmt_get_result($stmt);
           $row =mysqli_fetch_assoc($results);
           if(isset($row['eID'])){
            // If the employee is valid , we check if he checked-in before checking out  
           $sql = "SELECT * FROM shift WHERE eID = ? LIMIT 1";
           $shiftID = $row['id'];
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results =mysqli_stmt_get_result($stmt);
           $row = mysqli_fetch_assoc($results);
           if(!isset($row['eID']))
            echo('You cant check-out before you check-in!');
           else{
              // Checking out of the shift
         $startTime=$row['startTime'];
          $endTime = date("Y-m-d H:i:s"); 
           $sql = "UPDATE shift SET endtime = ? WHERE id = ?";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"si",$endTime,$shiftID);
           mysqli_stmt_execute($stmt);
           echo('Successfully check-out of your shift!');
           $sql = "DELETE FROM shift SET WHERE id = ?";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"si",$endTime,$shiftID);
           mysqli_stmt_execute($stmt);
           echo('shift cleaned');
         }
         //Creating a payroll id NOTE: NEED TO MAKE THIS EVERY MONTH
         $sql = "SELECT payMonth FROM payroll_ids WHERE eID = ? ";
         $date = DATE("Y-m-d");
         $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"i",$eID);
          mysqli_stmt_execute($stmt);
         $results = mysqli_stmt_get_result($stmt);
         $row = mysqli_fetch_assoc($results);
         if(isset($row['payMonth'])){
            if(MONTH($row['payMonth']) != MONTH($date)){
               $sql = "INSERT INTO payroll_ids (eID,payMonth) VALUES (?,?);";
               $stmt= mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"is",$eID,$date);
                mysqli_stmt_execute($stmt);
                echo('Payroll ID Executed');
            }
            else  
                echo('No need for extra payroll id');
         }
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
                     <h2>Employee Area</h2>
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
                     <h5>Enter your ID in order to start/finish your shift.</h5>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="contact-form">
                     <form action="shiftForm.php" method="POST">
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-sm-12">
                              <fieldset>
                                 <input name="eID" type="number" class="form-control" id="eId" placeholder=" Enter ID to check-in" required="">
                              </fieldset>
                           </div>
                           <div class="col-lg-12 col-md-12 col-sm-12">
                              <fieldset>
                                 <input name="checkIn" type="radio">Check-In</input> &nbsp; <input name="checkOut" type="radio">Check-out</input>
                              </fieldset>
                           </div>
                           <div class="col-lg-12">
                              <fieldset>
                                 <button name="submit" type="submit" id="form-submit" class="filled-button">Submit</button>
                              </fieldset>
                           </div>
                        </div>
                     </form>
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