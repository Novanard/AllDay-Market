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
            if(isset($_SESSION['email'])&& $_SESSION['userType']== 0){
            $basedir = realpath(__DIR__);
                 		include($basedir . '/navbars/navuser.php');
                 	}
                 else{
                         header('Location:index.php');
                 }
                 
                 ?>
      </header>
      <!-- Page Content -->
      <div class="page-heading about-heading header-text" style="background-image: url(assets/images/veghs.png);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>AllDay Market</h4>
              <h2>My Orders</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
 <div class="col-md-9">
  <div class="row">
         <?php 
            include 'db.php';
            if(isset($_SESSION['id'])){
            	$id = $_SESSION['id'];
            	$sql = "SELECT * FROM orders_id WHERE userID = ? AND isDone = 0";
                   $stmt= mysqli_stmt_init($conn);
                   mysqli_stmt_prepare($stmt,$sql);
                   mysqli_stmt_bind_param($stmt,"i",$id);
                   mysqli_stmt_execute($stmt);
                   $results=mysqli_stmt_get_result($stmt);
              while ($row=mysqli_fetch_assoc($results))
                   {                  
                     echo '		<div class="col-md-6">
                     <div class="product-item">';    
                          $orderID = $row['id'];
                          $date = $row['date'];
                          $totalItems = $row['totalItems'];
                          $totalMoney = $row['totalMoney'];
                          echo '<div style="display: flex;align-items:center;">
            
                       <h5><a href="#">Order ID: '.$orderID.'</a>
                       </div>
                        <div class="down-content">
                        <ul>
                        <li><strong>Order Date:</strong><br>'.$date.'</li><br>
                        <li><strong>Total Items:</strong><br>'.$totalItems.'</li><br>
                        <li><strong>Total Money:</strong><br>₪'.$totalMoney.'<li>
                        </ul>
                        <strong>Order Controls</strong>
                        <form action="orderControls.php" method="post">
                        <div >
                           <fieldset>
                           <input type="hidden" name="orderID" value="'.$orderID.'">
                              <button type="submit" name="statusOrder" class="btn btn-secondary">Order Status</button>
                           </fieldset>
                        </div>
                     </form>
            
                        <br><br>
                        </div>
                        </div>
                      </div>
                      ';
            
                   }
               }			
            ?> 	
         <!-- 
            <a href="editProfileForm.php?id='.$ID.'"> 
            <button class="btn btn-secondary" type="button" class="filled-button" class="editBtn">Edit</button>
            </a>
            -->
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