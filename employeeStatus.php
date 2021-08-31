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
      <div class="page-heading about-heading header-text" style="background-image: url(assets/images/items/veghs.png);">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="text-content">
                     <h4>AllDay Market</h4>
                     <h2>Employee Status</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="row">
            <?php 

               mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
               if(isset($_SESSION['eID'])){
                  $eID = $_SESSION['eID'];
                           include 'db.php';
                           // To get the payroll id of the current payroll for employee
                           $sql = "SELECT id FROM payroll_ids WHERE eID = ? AND isFinished = 0 LIMIT 1";
                           $stmt= mysqli_stmt_init($conn);
                           mysqli_stmt_prepare($stmt,$sql);
                           mysqli_stmt_bind_param($stmt,"i",$eID);
                           mysqli_stmt_execute($stmt);
                           $results=mysqli_stmt_get_result($stmt);
                           if(mysqli_num_rows($results)==0){
                              echo '<br><div class="alert alert-info col-md-12" role="alert">
                              <p class="text-center">No active payrolls found found!</p>
                            </div>';
                           }
                           else{
                              echo'  <hr><div class="alert alert-dark col-md-12" role="alert">
                              <p class="text-center" font-weight:bold>Current Payroll</p>
                             </div><hr>';
                            $row = mysqli_fetch_assoc($results);
                            $payroll_id = $row['id'];
                            //Getting all the working days of the current payroll_id
                            $sql = "SELECT * FROM payroll_details WHERE payroll_id = ? ";
                            $stmt= mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt,$sql);
                            mysqli_stmt_bind_param($stmt,"i",$payroll_id);
                            mysqli_stmt_execute($stmt);
                            $results=mysqli_stmt_get_result($stmt);
                            $day = 1;
                            while($row = mysqli_fetch_assoc($results))
                            {
                               $id = $row['id'];
                               $startTime = $row['startTime'];
                               $endTime = $row['endTime'];
                               $totalTime = $row['totalTime'];
                               $payday = $row['payday'];
                               echo '
                               <div class="col-md-6">
                               <div class="product-item">
                               <div class="down-content">
                               <a href="#"><h4>Day~'.$day.'</h4></a>
                               
                               <ol><li>StartTime: '.$startTime.'<br>
                               <li>endTime: '.$endTime.'<br>
                               <li>TotalTime: '.$totalTime.'<br>
                               <li>Payday: ₪'.$payday.'<br>

                               </div>
                               </div>
                               </div>
                               ';
                               $day+=1;
                            }
                               // Making sum of all current working days
                               $sql = "SELECT SUM(payday) as totalPayday FROM payroll_details WHERE payroll_id = ? ";
                               $stmt= mysqli_stmt_init($conn);
                               mysqli_stmt_prepare($stmt,$sql);
                               mysqli_stmt_bind_param($stmt,"i",$payroll_id);
                               mysqli_stmt_execute($stmt);
                               $results=mysqli_stmt_get_result($stmt);
                               $row = mysqli_fetch_assoc($results);
                               $totalPayday = $row['totalPayday'];
                               // Making count of all working days
                               $sql = "SELECT COUNT(payday) as totalDays FROM payroll_details WHERE payroll_id = ? ";
                               $stmt= mysqli_stmt_init($conn);
                               mysqli_stmt_prepare($stmt,$sql);
                               mysqli_stmt_bind_param($stmt,"i",$payroll_id);
                               mysqli_stmt_execute($stmt);
                               $results=mysqli_stmt_get_result($stmt);
                               $row = mysqli_fetch_assoc($results);
                               $totalDays = $row['totalDays'];
                               echo '
                               <div class="col-md-6">
                               <div class="product-item">
                               <div class="down-content">
                               <a href="#"><h4>Summary:</h4></a>
                               <br>
                               Total Work Days: '.$totalDays.'<br>
                               Total Payday: ₪'.$totalPayday.'



                               </div>
                               </div>
                               </div>
                               ';

               			}
                        echo '</div></div>';
                   // Checking old orders of the user
                   $sql = "SELECT * from oldPayroll_ids WHERE eID = ?;";
                   $stmt = mysqli_stmt_init($conn);
                   mysqli_stmt_prepare($stmt,$sql);
                   mysqli_stmt_bind_param($stmt,"i",$eID);
                   mysqli_stmt_execute($stmt);
                   $results = mysqli_stmt_get_result($stmt);
                   if(mysqli_num_rows($results)>0)
                   {echo'
                     <hr><div class="alert alert-dark" role="alert">
                     <p class="text-center" font-weight:bold>Payroll History</p>
                     </div><hr>';
                     echo'      <div class="col-md-12">
                     <div class="row">';
                        while($row=mysqli_fetch_assoc($results)){
                           $payrollID = $row['id'];
                           $payMonth = $row['payMonth'];
                           $totalTime = $row['totalTime'];
                           $totalMoney = $row['totalMoney'];
                           $isFinished = $row['isFinished'];
                           
                    
                               echo' <div class="col-md-6">
                               <div class="product-item">
                               <div class="down-content">
                               <a href="#"><h4>Payroll_ID:'.$payrollID.'</h4></a>
                               <br>
                               PayMonth: '.$payMonth.'<br>
                               Total Time: '.$totalTime.'<br>
                               Total Money: ₪'.$totalMoney.'<br>
                               <form action="payrollControls.php" method="post">
                               <input type="hidden" name="id" value="'.$payrollID.'">
                               <input type="submit" name="viewPayroll" value="View Payroll" class="btn btn-secondary">
                               </form>
                               </div>
                               </div>
                               </div>
                               ';

                   }
                  }
               }
               else
               			  echo 'Incorrect Session Details ';
               		  ?>
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