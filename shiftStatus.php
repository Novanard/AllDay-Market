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
      <style>
         img {
          border: 5px solid #555;
            }
      </style>  
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
            if(isset($_SESSION['email']) && $_SESSION['userType']==1){
                   $basedir = realpath(__DIR__);
            		include($basedir . '/navbars/navadmin.php');
            	}
            
            else{
                  header('Location:index.php');
            }
            
            ?>
      </header>
      <!-- Page Content -->
      <div class="page-heading about-heading header-text" style="background-image: url(assets/images/items/heading-4-1920x500.jpg);">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="text-content">
                     <h4>AllDay Market</h4>
                     <h2>Shift Status </h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="row">
            <?php 
               mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                           include 'db.php';
                           $sql = "SELECT * FROM shift";
                           $stmt= mysqli_stmt_init($conn);
                           mysqli_stmt_prepare($stmt,$sql);
                           mysqli_stmt_execute($stmt);
                           $results=mysqli_stmt_get_result($stmt);
                           if(mysqli_num_rows($results)>0){
               		       while ($row=mysqli_fetch_assoc($results))
               		    	{
                                 $flag; // 1 - Employee is busy 2- Employee is free  3- Employee Dep has no orders  
                                $eID = $row['eID'];
                                $sql = "SELECT * FROM employees WHERE eID = ? LIMIT 1;";
                                $stmt= mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt,$sql);
                                mysqli_stmt_bind_param($stmt,"i",$eID);
                                mysqli_stmt_execute($stmt);
                                $res = mysqli_stmt_get_result($stmt);
                                $row = mysqli_fetch_assoc($res);
                                $ID = $row['id'];
                                $firstname = $row['firstname'];
                                $lastname = $row['lastname'];
                                $depNum=$row['depNum'];
                                $perhour=$row['perhour'];
                                $residence=$row['residence'];
                                $pin = $row['PIN'];
                                $img = $row['avatar'];
                                //Checking if there are existing orders for that department
                                $sql = "SELECT * FROM order_details WHERE depNum = ? AND isDone = 0;";
                                $stmt= mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt,$sql);
                                mysqli_stmt_bind_param($stmt,"i",$depNum);
                                mysqli_stmt_execute($stmt);
                                $res = mysqli_stmt_get_result($stmt);
                                // If there are existing orders, we check if the employee is working on one of them, otherwise he is free
                                if(mysqli_num_rows($res)>0){
                                   $sql = "SELECT * FROM order_details WHERE eID = ? AND isDone = 0 ;";
                                   $stmt= mysqli_stmt_init($conn);
                                   mysqli_stmt_prepare($stmt,$sql);
                                   mysqli_stmt_bind_param($stmt,"i",$eID);
                                   mysqli_stmt_execute($stmt);
                                   $res = mysqli_stmt_get_result($stmt);
                                   if(mysqli_num_rows($res)>0)
                                   $flag = 1; // Employee is busy

                                   else
                                   $flag = 2; // Employee is free
                                }
                                else
                                $flag = 3; // No orders that belong to the employee's department
                                    
                                
                                echo '
                                <div class="col-md-4">
                                  <div class="product-item">
                                   <a href="#"><img src="'.$img.'" height="370px" width="270px" alt=""></a>
                                   <div class="down-content">
                                   <center><strong>'.$firstname.' &nbsp '.$lastname.'</strong><small>('.$ID.')</small></center>
                                   
                                     <br>
                                     <div>
                                     <center> <strong>DepNum:</strong> '.$depNum.'<br>
                                     </div>
                                    <center> <div>';
                                     if($flag == 1)
                                     echo 'Employee is <strong><font color="red">BUSY</font></strong> working on an order.';
                                    else if($flag ==2)
                                    echo 'Employee is <strong><font color="green">FREE</font></strong>';
                                    else if($flag ==3)
                                    echo 'Employee has no orders that belong to them <strong><font color="orange">(NEUTRAL)</font></strong>';
                                    echo'
                                   </div>
                                  </div>
                                </div>
                               ';
               			}
                     }
                     else
                     // If selecting everything from Shift returns nothing, means no workers are currently at work
                     echo '<br><div class="alert alert-info col-md-12" role="alert">
                     <p class="text-center">No Employees are currently at work!</p>
                   </div>';
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