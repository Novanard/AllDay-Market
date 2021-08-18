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
            if(isset($_SESSION['email'])&& $_SESSION['userType']== 1){
            	if($_SESSION['email'] === 'admin@allday.com'){
            $basedir = realpath(__DIR__);
            		include($basedir . '/navbars/navadmin.php');
            	}
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
                     <h2>Employees</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <div class="col-md-9">
         <div class="row">
            <?php 
               mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
               include 'db.php';
               // Getting the highest totalTime
               $sql = "SELECT MAX(totalTime) as MaxTime FROM payroll_ids WHERE isFinished =0 LIMIT 1";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $result=mysqli_stmt_get_result($stmt);
               $row = mysqli_fetch_assoc($result);
               $maxTime = $row['MaxTime'];
               // Selecting eID of the records who have their totalTime = MaxTime, in case there is more than 1 record
               $sql = "SELECT eID from payroll_ids WHERE totalTime = $maxTime";
               $stmt = mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $results = mysqli_stmt_get_result($stmt);
               while($row = mysqli_fetch_assoc($results))
               {
                  $eID = $row['eID'];
                  //Getting information about the records with the MaxTime
                  $sql = "SELECT * FROM employees WHERE eID = ?";
                  mysqli_stmt_init($conn);
                  mysqli_stmt_prepare($stmt,$sql);
                  mysqli_stmt_bind_param($stmt,"i",$eID);
                  mysqli_stmt_execute($stmt);
                  $res = mysqli_stmt_get_result($stmt);
                  while($row = mysqli_fetch_assoc($res))
                  {
                     $firstname = $row['firstname'];
                     $lastname = $row['lastname'];
                     $depNum = $row['depNum'];
                     $avatar = $row['avatar'];
                     echo'              		
                     <div class="col-md-6">
                     <div class="product-item">
                     <center>  Employee with <strong> MOST time </strong> at work<br>
                     <img src="'.$avatar.'" alt="">
                     <div class="down-content">
                     <center>'.$firstname.' '.$lastname.'<small>('.$eID.')</small></center>
                     </div>
                     <br>
                     <div>
                     <h6>The Employee with most hours at work with a total of:<br>  <strong>'.$maxTime.' Hours.</strong></h6>
                     <br>
                     <small>(Department Number: '.$depNum.')</small>
                     </div>
                     <div>
                     </div>
                     </div>
                     </div>
                     ';  
                  }
               }
               // Getting the lowest totalTime
               $sql = "SELECT MIN(totalTime) as MinTime FROM payroll_ids WHERE isFinished =0 LIMIT 1";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $result=mysqli_stmt_get_result($stmt);
               $row = mysqli_fetch_assoc($result);
               $minTime = $row['MinTime'];
               // Selecting eID of the records who have their totalTime = MinTime, in case there is more than 1 record
               $sql = "SELECT eID from payroll_ids WHERE totalTime = $minTime";
               $stmt = mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $results = mysqli_stmt_get_result($stmt);
               while($row = mysqli_fetch_assoc($results))
               {
                  $eID = $row['eID'];
                  //Getting information about the records with the MinTime
                  $sql = "SELECT * FROM employees WHERE eID = ?";
                  mysqli_stmt_init($conn);
                  mysqli_stmt_prepare($stmt,$sql);
                  mysqli_stmt_bind_param($stmt,"i",$eID);
                  mysqli_stmt_execute($stmt);
                  $res = mysqli_stmt_get_result($stmt);
                  while($row = mysqli_fetch_assoc($res))
                  {
                     $firstname = $row['firstname'];
                     $lastname = $row['lastname'];
                     $depNum = $row['depNum'];
                     $avatar = $row['avatar'];
                     echo'               		
                     <div class="col-md-6">
                     <div class="product-item">
                     <center>  Employee with <strong> LEAST time </strong> at work<br>
                     <img src="'.$avatar.'" alt="">
                     <div class="down-content">
                     <center>'.$firstname.' '.$lastname.'<small>('.$eID.')</small></center>
                     </div>
                     <br>
                     <div>
                     The Employee with least hours at work with a total of:<br>  <strong>'.$minTime.' Hours.</strong>
                     <br>
                     <small>(Department Number: '.$depNum.')</small>
                     </div>
                     <div>
                     </div>
                     </div>
                     </div>
                     ';  
                  }
               } 
                              // Getting the Max totalMoney
                              $sql = "SELECT MAX(totalMoney) as MaxMoney FROM payroll_ids WHERE isFinished =0 LIMIT 1";
                              $stmt= mysqli_stmt_init($conn);
                              mysqli_stmt_prepare($stmt,$sql);
                              mysqli_stmt_execute($stmt);
                              $result=mysqli_stmt_get_result($stmt);
                              $row = mysqli_fetch_assoc($result);
                              $maxMoney = $row['MaxMoney'];
                              // Selecting eID of the records who have their totalMoney = MaxMoney, in case there is more than 1 record
                              $sql = "SELECT eID from payroll_ids WHERE totalMoney = $maxMoney";
                              $stmt = mysqli_stmt_init($conn);
                              mysqli_stmt_prepare($stmt,$sql);
                              mysqli_stmt_execute($stmt);
                              $results = mysqli_stmt_get_result($stmt);
                              while($row = mysqli_fetch_assoc($results))
                              {
                                 $eID = $row['eID'];
                                 //Getting information about the records with the MaxMoney
                                 $sql = "SELECT * FROM employees WHERE eID = ?";
                                 mysqli_stmt_init($conn);
                                 mysqli_stmt_prepare($stmt,$sql);
                                 mysqli_stmt_bind_param($stmt,"i",$eID);
                                 mysqli_stmt_execute($stmt);
                                 $res = mysqli_stmt_get_result($stmt);
                                 while($row = mysqli_fetch_assoc($res))
                                 {
                                    $firstname = $row['firstname'];
                                    $lastname = $row['lastname'];
                                    $depNum = $row['depNum'];
                                    $avatar = $row['avatar'];
                                    echo'               		
                                    <div class="col-md-6">
                                    <div class="product-item">
                                    <center> Employee with <strong> HIGHEST payroll </strong> at work<br>
                                    <img src="'.$avatar.'" alt="">
                                    <div class="down-content">
                                    <center>'.$firstname.' '.$lastname.'<small>('.$eID.')</small></center>
                                    </div>
                                    <br>
                                    <div>
                                    The Employee with highest payroll with a total of:<br>  <strong>₪ '.$maxMoney.'</strong>
                                   <br>
                                    <small>(Department Number: '.$depNum.')</small>
                                    </div>
                                    <div>
                                    </div>
                                    </div>
                                    </div>
                                    ';  
                                 }
                              } // CHECKPOINT
                              // Getting the Min totalMoney
                              $sql = "SELECT MIN(totalMoney) as MinMoney FROM payroll_ids WHERE isFinished =0 LIMIT 1";
                              $stmt= mysqli_stmt_init($conn);
                              mysqli_stmt_prepare($stmt,$sql);
                              mysqli_stmt_execute($stmt);
                              $result=mysqli_stmt_get_result($stmt);
                              $row = mysqli_fetch_assoc($result);
                              $minMoney = $row['MinMoney'];
                              // Selecting eID of the records who have their totalMoney = MinMoney, in case there is more than 1 record
                              $sql = "SELECT eID from payroll_ids WHERE totalMoney = $minMoney";
                              $stmt = mysqli_stmt_init($conn);
                              mysqli_stmt_prepare($stmt,$sql);
                              mysqli_stmt_execute($stmt);
                              $results = mysqli_stmt_get_result($stmt);
                              while($row = mysqli_fetch_assoc($results))
                              {
                                 $eID = $row['eID'];
                                 //Getting information about the records with the MinMoney
                                 $sql = "SELECT * FROM employees WHERE eID = ?";
                                 mysqli_stmt_init($conn);
                                 mysqli_stmt_prepare($stmt,$sql);
                                 mysqli_stmt_bind_param($stmt,"i",$eID);
                                 mysqli_stmt_execute($stmt);
                                 $res = mysqli_stmt_get_result($stmt);
                                 while($row = mysqli_fetch_assoc($res))
                                 {
                                    $firstname = $row['firstname'];
                                    $lastname = $row['lastname'];
                                    $depNum = $row['depNum'];
                                    $avatar = $row['avatar'];
                                    echo'               		
                                    <div class="col-md-6">
                                    <div class="product-item">
                                    <center> Employee with <strong> LOWEST payroll </strong> at work<br>
                                    <img src="'.$avatar.'" alt="">
                                    <div class="down-content">
                                    <center>'.$firstname.' '.$lastname.'<small>('.$eID.')</small></center>
                                    </div>
                                    <br>
                                    <div>
                                    The Employee with lowest payroll with a total of:<br>  <strong>₪ '.$minMoney.'</strong>
                                    <br>
                                    <small>(Department Number: '.$depNum.')</small>
                                    </div>
                                    <div>
                                    </div>
                                    </div>
                                    </div>
                                    ';  
                                 }
                              }
                              
               
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