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
            $basedir = realpath(__DIR__);
            		include($basedir . '/navbars/navadmin.php');
            	}
            
            else{
                    header('Location:index.php');
            }
            
            ?>
  <style>
         img {
  border: 5px solid #555;
}
         </style>
      </header>
      <!-- Page Content -->
      <div class="page-heading about-heading header-text" style="background-image: url(assets/images/items/veghs.png);">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="text-content">
                     <h4>AllDay Market</h4>
                     <h2>User Statics</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <div class="col-md-12">
         <div class="row">
            <?php 
               mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
               include 'db.php';
               // Getting the needed statistics for users
               $sql = "SELECT MAX(weeklyOrders) as MaxWOrders,MAX(lifetimeOrders) as MaxLOrders,MAX(weeklySpent) as MaxWSpent,MAX(lifetimeSpent) as MaxLSpent FROM users;";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $result=mysqli_stmt_get_result($stmt);
               $row = mysqli_fetch_assoc($result);
               $maxWeekO = $row['MaxWOrders'];
               $maxLifeO= $row['MaxLOrders'];
               $maxWeekS=$row['MaxWSpent'];
               $maxLifeS=$row['MaxLSpent'];
               $sql = "SELECT * FROM users WHERE lifetimeOrders =?;";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$maxLifeO);
               mysqli_stmt_execute($stmt);
               $result=mysqli_stmt_get_result($stmt);
               while($row=mysqli_fetch_assoc($result)){
                  $id = $row['id'];
                  $name = $row['name'];
                  $email = $row['email'];
                  $avatar = $row['avatar'];
                  echo'
                  <div class="col-md-4">
                  <div class="product-item">
                  <center> <h4> Most Orders Lifetime</h4><br>
                  <img src="'.$avatar.'" height="370px" width="270px" alt="">
                  <div class="down-content">
                  <center><strong>'.$name.'</strong><small>('.$id.')</small></center>
                  </div>                   <br>
                   <div>
                    The highest order amount of <b>all time</b> goes to <u>'.$email.'</u> with a total of:  <strong>'.$maxLifeO.' orders.</strong>
                   </div>
                   <div>
                 </div>
                 </div>
                 </div>';
               }
               $sql = "SELECT * FROM users WHERE weeklyOrders =?;";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$maxWeekO);
               mysqli_stmt_execute($stmt);
               $result=mysqli_stmt_get_result($stmt);
               while($row=mysqli_fetch_assoc($result)){
                  $id = $row['id'];
                  $name = $row['name'];
                  $email = $row['email'];
                  $avatar = $row['avatar'];
                  echo'
                  <div class="col-md-4">
                  <div class="product-item">
                  <center> <h4> Most Orders This Week</h4><br>
                  <img src="'.$avatar.'" height="370px" width="270px" alt="">
                  <div class="down-content">
                  <center><strong>'.$name.'</strong><small>('.$id.')</small></center>
                  </div>                   <br>
                   <div>
                    The highest order amount of the <b>current week</b> goes to <u>'.$email.'</u> with a total of:  <strong>'.$maxWeekO.' orders.</strong>
                   </div>
                   <div>
                 </div>
                 </div>
                 </div>';
               }
               $sql = "SELECT * FROM users WHERE weeklySpent =?;";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$maxWeekS);
               mysqli_stmt_execute($stmt);
               $result=mysqli_stmt_get_result($stmt);
               while($row=mysqli_fetch_assoc($result)){
                  $id = $row['id'];
                  $name = $row['name'];
                  $email = $row['email'];
                  $avatar = $row['avatar'];
                  echo'
                  <div class="col-md-4">
                  <div class="product-item">
                  <center> <h4> Biggest Spender This Week</h4><br>
                  <img src="'.$avatar.'" height="370px" width="270px" alt="">
                  <div class="down-content">
                  <center><strong>'.$name.'</strong><small>('.$id.')</small></center>
                  </div>                   <br>
                   <div>
                    The biggest spender of the <b>current week</b> goes to <u>'.$email.'</u> with a total of:  <strong>₪'.$maxWeekS.'</strong>
                   </div>
                   <div>
                 </div>
                 </div>
                 </div>';
               }
               $sql = "SELECT * FROM users WHERE lifetimeSpent =?;";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$maxLifeS);
               mysqli_stmt_execute($stmt);
               $result=mysqli_stmt_get_result($stmt);
               while($row=mysqli_fetch_assoc($result)){
                  $id = $row['id'];
                  $name = $row['name'];
                  $email = $row['email'];
                  $avatar = $row['avatar'];
                  echo'
                  <div class="col-md-4">
                  <div class="product-item">
                  <center> <h4> Biggest Spender of AllTime</h4><br>
                  <img src="'.$avatar.'" height="370px" width="270px" alt="">
                  <div class="down-content">
                  <center><strong>'.$name.'</strong><small>('.$id.')</small></center>
                  </div>                   <br>
                   <div>
                    The biggest spender of <b>AllTime</b> goes to <u>'.$email.'</u> with a total of:  <strong>₪'.$maxLifeS.'</strong>
                   </div>
                   <div>
                 </div>
                 </div>
                 </div>';
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