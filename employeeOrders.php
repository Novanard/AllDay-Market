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
                     <h2>Employee Orders</h2>
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
                           //Employee can not see Orders without being in their shift
                           $sql = "SELECT * FROM shift where eID = ?;";
                           $stmt = mysqli_stmt_init($conn);
                           mysqli_stmt_prepare($stmt,$sql);
                           mysqli_stmt_bind_param($stmt,"i",$eID);
                           mysqli_stmt_execute($stmt);
                           $results = mysqli_stmt_get_result($stmt);
                           if(mysqli_num_rows($results)){
                           // To get the department number of the current employee
                           $sql = "SELECT depNum FROM employees WHERE eID = ? LIMIT 1";
                           $stmt= mysqli_stmt_init($conn);
                           mysqli_stmt_prepare($stmt,$sql);
                           mysqli_stmt_bind_param($stmt,"i",$eID);
                           mysqli_stmt_execute($stmt);
                           $results=mysqli_stmt_get_result($stmt);
                            $row = mysqli_fetch_assoc($results);
                            $depNum = $row['depNum'];
                            //Getting all records where depNum matches the employee Dep
                            //And the state of the order item is not finished
                            $sql = "SELECT * FROM order_details WHERE depNum = ? AND isDone =0 ";
                            $stmt= mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt,$sql);
                            mysqli_stmt_bind_param($stmt,"i",$depNum);
                            mysqli_stmt_execute($stmt);
                            $results=mysqli_stmt_get_result($stmt);
                            while($row = mysqli_fetch_assoc($results))
                            {
                               $orderID = $row['order_id'];
                               $itemBarcode = $row['itemBarcode'];
                               $quantity = $row['quantity'];
                               $img = $row['img'];
                               echo '
                               <div class="col-md-6">
                               <div class="product-item">
                               <a href="#"><img src="'.$img.'" alt=""></a>
                               <div class="down-content">
                               <a href="#"><h4>OrderID ~'.$orderID.'</h4></a>
                               
                               <h6><small>ItemBarcode: '.$itemBarcode.'<br></small>
                               <h6><small> Quantity:'.$quantity.'</small>
                               <br><br>
                               <form action="updateOrder.php" method="post">
                               <input type="hidden" name="barcode" value="'.$itemBarcode.'">
                               <fieldset>
                               <input type="hidden" name="orderID" value="'.$orderID.'">
                               <button type="submit" name="isDone" id="form-submit" class="btn btn-success">isDone</button>
                               </fieldset>
                               </form>
                               </div>
                               </div>
                               </div>
                               ';
                               }

                              }
                              else{
                                 echo '<div class="alert alert-warning col-md-12" role="alert">
                                 <p style="text-align:center;">You must check-in your shift before accessing Orders!</p>
                               </div> ';
                           }
                        }
               
                        
               else{
               			  echo 'Else';}
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