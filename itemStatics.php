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
                     <h2>Employees </h2>
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
               // Selecting the highest sellCount in Vegehtables department
               $sql = "SELECT MAX(sellCount) as MaxSold FROM items WHERE Department =1 LIMIT 1";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $results=mysqli_stmt_get_result($stmt);
               $row = mysqli_fetch_assoc($results);
               $sellCount = $row['MaxSold'];
               //Getting all the products who where sold at the maximum price incase there are more than one record
               $sql ="SELECT * from items WHERE sellCount = ? AND Department = 1";
               mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$sellCount);
               mysqli_stmt_execute($stmt);
               $results = mysqli_stmt_get_result($stmt);
               while($row = mysqli_fetch_assoc($results))
               {
                  $barcode = $row['Barcode'];
                  $name = $row['Name'];
                  $img = $row['img'];
               echo'               		
               <div class="col-md-6">
               <div class="product-item">
               <center> <h4> Most selling in <strong>Vegehtables</strong></h4><br>
               <img src="'.$img.'" style="width:470px;height:370px;" alt="">
               <div class="down-content">
               <center><strong>'.$name.'</strong><small>('.$barcode.')</small></center>
               </div>
               <br>
               <div>
               This is the highest selling item with a total of:  <strong>'.$sellCount.' KGs.</strong>
               </div>
               <div>
               </div>
               </div>
               </div>
               ';  
               }
                    // Selecting the lowest sellCount in Vegehtables department
               $sql = "SELECT MIN(sellCount) as MinSold FROM items WHERE Department =1 LIMIT 1";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $results=mysqli_stmt_get_result($stmt);
               $row = mysqli_fetch_assoc($results);
               $sellCount = $row['MinSold'];
               //Getting all the products who where sold at the minimum price incase there are more than one record
               $sql ="SELECT * from items WHERE sellCount = ? AND Department =1";
               mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$sellCount);
               mysqli_stmt_execute($stmt);
               $results = mysqli_stmt_get_result($stmt);
               while($row = mysqli_fetch_assoc($results))
               {
                  $barcode = $row['Barcode'];
                  $name = $row['Name'];
                  $img = $row['img'];
               echo'               		
               <div class="col-md-6">
               <div class="product-item">
               <center> <h4> Lowest selling in <strong>Vegehtables</strong></h4><br>
               <img src="'.$img.'" style="width:470px;height:370px;" alt="">
               <div class="down-content">
               <center><strong>'.$name.'</strong><small>('.$barcode.')</small></center>
               </div>
               <br>
               <div>
               This is the lowest selling item with a total of:  <strong>'.$sellCount.' KGs.</strong>
               </div>
               <div>
               </div>
               </div>
               </div>
               ';  
               }  
                     // Selecting the highest sellCount in HomeTools department
                     $sql = "SELECT MAX(sellCount) as MaxSold FROM items WHERE Department =2 LIMIT 1";
                     $stmt= mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_execute($stmt);
                     $results=mysqli_stmt_get_result($stmt);
                     $row = mysqli_fetch_assoc($results);
                     $sellCount = $row['MaxSold'];
                     //Getting all the products who where sold at the maximum price incase there are more than one record
                     $sql ="SELECT * from items WHERE sellCount = ? AND Department = 2";
                     mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_bind_param($stmt,"i",$sellCount);
                     mysqli_stmt_execute($stmt);
                     $results = mysqli_stmt_get_result($stmt);
                     while($row = mysqli_fetch_assoc($results))
                     {
                        $barcode = $row['Barcode'];
                        $name = $row['Name'];
                        $img = $row['img'];
                     echo'               		
                     <div class="col-md-6">
               <div class="product-item">
               <center> <h4> Most selling in <strong>Home Tools</strong></h4><br>
               <img src="'.$img.'" style="width:470px;height:370px;" alt="">
               <div class="down-content">
               <center><strong>'.$name.'</strong><small>('.$barcode.')</small></center>
                </div>
                 <br>
                 <div>
                  This is the highest selling item with a total of:  <strong>'.$sellCount.' units.</strong>
                 </div>
                 <div>
               </div>
               </div>
               </div>';  
                     }
                          // Selecting the lowest sellCount in HomeTools department
                     $sql = "SELECT MIN(sellCount) as MinSold FROM items WHERE Department =2 LIMIT 1";
                     $stmt= mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_execute($stmt);
                     $results=mysqli_stmt_get_result($stmt);
                     $row = mysqli_fetch_assoc($results);
                     $sellCount = $row['MinSold'];
                     //Getting all the products who where sold at the minimum price incase there are more than one record
                     $sql ="SELECT * from items WHERE sellCount = ? AND Department =2";
                     mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_bind_param($stmt,"i",$sellCount);
                     mysqli_stmt_execute($stmt);
                     $results = mysqli_stmt_get_result($stmt);
                     while($row = mysqli_fetch_assoc($results))
                     {
                        $barcode = $row['Barcode'];
                        $name = $row['Name'];
                        $img = $row['img'];
                     echo'               		
                     <div class="col-md-6">
               <div class="product-item">
               <center> <h4> Lowest selling in <strong>Home Tools</strong></h4><br>
               <img src="'.$img.'" style="width:470px;height:370px;" alt="">
               <div class="down-content">
               <center><strong>'.$name.'</strong><small>('.$barcode.')</small></center>
                </div>
                 <br>
                 <div>
                  This is the lowest selling item with a total of:  <strong>'.$sellCount.' Units.</strong>
                 </div>
                 <div>
               </div>
               </div>
               </div>';  
                     } 
                     // Selecting the highest sellCount in Bakery department
                     $sql = "SELECT MAX(sellCount) as MaxSold FROM items WHERE Department =3 LIMIT 1";
                     $stmt= mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_execute($stmt);
                     $results=mysqli_stmt_get_result($stmt);
                     $row = mysqli_fetch_assoc($results);
                     $sellCount = $row['MaxSold'];
                     if($sellCount>0){
                     //Getting all the products who where sold at the maximum price incase there are more than one record
                     $sql ="SELECT * from items WHERE sellCount = ? AND Department = 3";
                     mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_bind_param($stmt,"i",$sellCount);
                     mysqli_stmt_execute($stmt);
                     $results = mysqli_stmt_get_result($stmt);
                     while($row = mysqli_fetch_assoc($results))
                     {
                        $barcode = $row['Barcode'];
                        $name = $row['Name'];
                        $img = $row['img'];
                     echo'               		
                     <div class="col-md-6">
               <div class="product-item">
               <center> <h4> Most selling in <strong>Bakerys</strong></h4><br>
               <img src="'.$img.'" style="width:470px;height:370px;" alt="">
               <div class="down-content">
               <center><strong>'.$name.'</strong><small>('.$barcode.')</small></center>
                </div>
                 <br>
                 <div>
                  This is the highest selling item with a total of:  <strong>'.$sellCount.' pcs.</strong>
                 </div>
                 <div>
               </div>
               </div>
               </div>';  
                     }
                    }
                          // Selecting the lowest sellCount in Bakery department
                     $sql = "SELECT MIN(sellCount) as MinSold FROM items WHERE Department =3 LIMIT 1";
                     $stmt= mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_execute($stmt);
                     $results=mysqli_stmt_get_result($stmt);
                     $row = mysqli_fetch_assoc($results);
                     $sellCount = $row['MinSold'];
                     //Getting all the products who where sold at the minimum price incase there are more than one record
                     $sql ="SELECT * from items WHERE sellCount = ? AND Department =3";
                     mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_bind_param($stmt,"i",$sellCount);
                     mysqli_stmt_execute($stmt);
                     $results = mysqli_stmt_get_result($stmt);
                     while($row = mysqli_fetch_assoc($results))
                     {
                        $barcode = $row['Barcode'];
                        $name = $row['Name'];
                        $img = $row['img'];
                     echo'               		
                     <div class="col-md-6">
               <div class="product-item">
               <center> <h4> Lowest selling in <strong>Bakery</strong></h4><br>
               <img src="'.$img.'" style="width:470px;height:370px;" alt="">
               <div class="down-content">
               <center><strong>'.$name.'</strong><small>('.$barcode.')</small></center>
                </div>
                 <br>
                 <div>
                  This is the lowest selling item with a total of:  <strong>'.$sellCount.' PCs.</strong>
                 </div>
                 <div>
               </div>
               </div>
               </div>';  
                     } 
                          // Selecting the highest sellCount in Vegehtables department
               $sql = "SELECT MAX(sellCount) as MaxSold FROM items WHERE Department =4 LIMIT 1";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $results=mysqli_stmt_get_result($stmt);
               $row = mysqli_fetch_assoc($results);
               $sellCount = $row['MaxSold'];
               if($sellCount >0){
               //Getting all the products who where sold at the maximum price incase there are more than one record
               $sql ="SELECT * from items WHERE sellCount = ? AND Department = 4";
               mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$sellCount);
               mysqli_stmt_execute($stmt);
               $results = mysqli_stmt_get_result($stmt);
               while($row = mysqli_fetch_assoc($results))
               {
                  $barcode = $row['Barcode'];
                  $name = $row['Name'];
                  $img = $row['img'];
               echo'               		
               <div class="col-md-6">
               <div class="product-item">
               <center> <h4> Most selling in <strong>Butchery</strong></h4><br>
               <img src="'.$img.'" height="370px" width="270px" alt="">
               <div class="down-content">
               <center><strong>'.$name.'</strong><small>('.$barcode.')</small></center>
               </div>
               <br>
               <div>
               This is the highest selling item with a total of:  <strong>'.$sellCount.' KGs.</strong>
               </div>
               <div>
               </div>
               </div>
               </div>
               ';      }
               }
                                // Selecting the lowest sellCount in Butchery department
                                  $sql = "SELECT MIN(sellCount) as MinSold FROM items WHERE Department =4 LIMIT 1";
                                    $stmt= mysqli_stmt_init($conn);
                                    mysqli_stmt_prepare($stmt,$sql);
                                    mysqli_stmt_execute($stmt);
                                    $results=mysqli_stmt_get_result($stmt);
                                    $row = mysqli_fetch_assoc($results);
                                    $sellCount = $row['MinSold'];
                                    //Getting all the products who where sold at the minimum price incase there are more than one record
                                    $sql ="SELECT * from items WHERE sellCount = ? AND Department =4";
                                    mysqli_stmt_init($conn);
                                    mysqli_stmt_prepare($stmt,$sql);
                                    mysqli_stmt_bind_param($stmt,"i",$sellCount);
                                    mysqli_stmt_execute($stmt);
                                    $results = mysqli_stmt_get_result($stmt);
                                    while($row = mysqli_fetch_assoc($results))
                                    {
                                       $barcode = $row['Barcode'];
                                       $name = $row['Name'];
                                       $img = $row['img'];
                                    echo'               		
                                    <div class="col-md-6">
                            <div class="product-item">
                             <center> <h4> Lowest selling in <strong>Butchery</strong></h4><br>
                             <img src="'.$img.'" height="370px" width="270px" alt="">
                             <div class="down-content">
                              <center><strong>'.$name.'</strong><small>('.$barcode.')</small></center>
                               </div>
                                <br>
                                <div>
                                 This is the lowest selling item with a total of:  <strong>'.$sellCount.' KGs.</strong>
                                </div>
                                <div>
                              </div>
                            </div>
                          </div>
                          ';  
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