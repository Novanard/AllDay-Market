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
            echo($eID);
            // If employee is checking-in, first thing is to check if they exist
           $sql = "SELECT * FROM employees WHERE eID = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results=mysqli_stmt_get_result($stmt);
          $row=mysqli_fetch_assoc($results);
           if(isset($row['eID'])){
           $startTime = date("Y-m-d H:i:s");
           // If the employee exists , check if they are in their shift
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
              //If the employee isnt in their shift, they start a new shift
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
            // If the employee is checking out, first to check if they exist
           $sql = "SELECT * FROM employees WHERE eID = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results=mysqli_stmt_get_result($stmt);
           $row =mysqli_fetch_assoc($results);
           if(isset($row['eID'])){
              // If they employee exists, check if they are in a shift
           $sql = "SELECT * FROM shift WHERE eID = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results =mysqli_stmt_get_result($stmt);
           $row = mysqli_fetch_assoc($results);
           if(!isset($row['eID']))
            echo('You cant check-out before you check-in!');
           else{
            $startTime=$row['startTime'];
          $endTime = date("Y-m-d H:i:s"); 
          // If the employee is in a shift, update their checkout time
           $sql = "UPDATE shift SET endtime = ? WHERE eID = ?";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"si",$endTime,$eID);
           mysqli_stmt_execute($stmt);
           echo('Successfully check-out of your shift!');
           // Deleting the shift after it ends
           $sql = "DELETE FROM shift WHERE eID = ?";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           echo('Shift Deleted');
         }
         //Checking if the employee has previous payroll_id
         $sql="SELECT payMonth,isFinished FROM payroll_ids WHERE eID = ?";
         $stmt= mysqli_stmt_init($conn);
         mysqli_stmt_prepare($stmt,$sql);
         mysqli_stmt_bind_param($stmt,"i",$eID);
         mysqli_stmt_execute($stmt);
         $results = mysqli_stmt_get_result($stmt);
         $row = mysqli_fetch_assoc($results);
         //If there are no previous records, a new one is created
         if(!isset($row['payMonth'])){
         $sql = "INSERT INTO payroll_ids (eID,payMonth) VALUES (?,?);";
         $month = DATE("Y-m-d");
         $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"is",$eID,$month);
          mysqli_stmt_execute($stmt);
          echo('Payroll ID Executed');}
          // If there are previous records, check if the month is finished
          // If it is not finished, then no need to create another record
          else if(isset($row['payMonth'])&& $row['isFinished']!= 1){
             $onlyMonth = date("m",strtotime($row['payMonth']));
             $currentDate = DATE("Y-m-d");
             $currentMonth = date("m",strtotime($currentDate));
             if($onlyMonth == $currentMonth)
               echo('No need for another payroll id');
           // If the current month does not match the payroll_id month, then we create a new one 
           // and update the previous isFinished to 1.
           //In addition we archieve the payroll_id and details.
               else {
                  $sql = "UPDATE payroll_ids set isFinished = 1 WHERE eID = ?;";
                  $stmt= mysqli_stmt_init($conn);
                   mysqli_stmt_prepare($stmt,$sql);
                   mysqli_stmt_bind_param($stmt,"i",$eID);
                   mysqli_stmt_execute($stmt);
                  
                  $sql = "INSERT INTO payroll_ids (eID,payMonth) VALUES (?,?);";
                  $stmt= mysqli_stmt_init($conn);
                   mysqli_stmt_prepare($stmt,$sql);
                   mysqli_stmt_bind_param($stmt,"is",$eID,$currentDate);
                   mysqli_stmt_execute($stmt);
               }
               
          }
          //Getting the payroll id in order to insert it as the foreign key
          $sql="SELECT id FROM payroll_ids WHERE eID = ? AND isFinished =0";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"i",$eID);
          mysqli_stmt_execute($stmt);
          $results = mysqli_stmt_get_result($stmt);
          $row = mysqli_fetch_assoc($results);
          $payroll_id = $row['id'];
          echo('Payroll ID GET successfully');
          // Inserting the payroll details of the employee
          $sql = "INSERT INTO payroll_details (startTime,endTime,totalTime,payroll_id,eID) VALUES (?,?,?,?,?);";
          $datetime1 = strtotime($startTime);
          $datetime2 = strtotime($endTime);
          $interval  = abs($datetime1 - $datetime2)/30; // 0.5 minute equals 1 hour in real life for simulation purposes
          $totalHours = $interval;
          $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"ssiii",$startTime,$endTime,$totalHours,$payroll_id,$eID);
           mysqli_stmt_execute($stmt);
           echo('Payroll Details Executed');
           // Getting the perhour from employee tables to calculate the payday
           $sql="SELECT perhour FROM employees WHERE eID = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$eID);
           mysqli_stmt_execute($stmt);
           $results = mysqli_stmt_get_result($stmt);
           $row = mysqli_fetch_assoc($results);
           $perhour = $row['perhour'];
           $payday = $perhour * $totalHours ;
           //Getting the payroll_details primary key in order to update it's payday
           $sql="SELECT id FROM payroll_details WHERE startTime = ? AND endTime = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"ss",$startTime,$endTime);
           mysqli_stmt_execute($stmt);
           $results = mysqli_stmt_get_result($stmt);
           $row = mysqli_fetch_assoc($results);
           $pay_detailsID = $row['id'];
           echo('Pay roll details PK GET Success');
           // UPDATING the payday column in the payroll_details
           $sql="UPDATE payroll_details SET payday = ? WHERE id = ?";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"ii",$payday,$pay_detailsID);
           mysqli_stmt_execute($stmt);
           echo('Payday updated');
           //Getting the current TotalMoney and increasing it with the current payday
           $sql="SELECT totalMoney FROM payroll_ids  WHERE id = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$payroll_id);
           mysqli_stmt_execute($stmt);
           echo('totalMoney GET');
            $res = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($res);
            $totalMoney = $row['totalMoney'];
            $totalMoney += $payday;
            // Updating totalMoney with the new amount
            $sql ="UPDATE payroll_ids SET totalMoney = ? WHERE id = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"ii",$totalMoney,$payroll_id);
            mysqli_stmt_execute($stmt);
            echo('totalMoney Updated');
           //Getting the current TotalTime and increasing it with the current hours
           $sql="SELECT totalTime FROM payroll_ids  WHERE id = ? LIMIT 1";
           $stmt= mysqli_stmt_init($conn);
           mysqli_stmt_prepare($stmt,$sql);
           mysqli_stmt_bind_param($stmt,"i",$payroll_id);
           mysqli_stmt_execute($stmt);
           echo('totalTime GET');
            $res = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($res);
            $totalTime = $row['totalTime'];
            $totalTime += $totalHours;
            // Updating totalTime with the new amount
            $sql ="UPDATE payroll_ids SET totalTime = ? Where id = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"ii",$totalTime,$payroll_id);
            mysqli_stmt_execute($stmt);
            echo('totalTime Updated');
         
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
            if(isset($_SESSION['eID'])){
                $basedir = realpath(__DIR__);
                include($basedir . '/navbars/navEmployee.php');
            }
            else{
                header('Location:index.php');
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