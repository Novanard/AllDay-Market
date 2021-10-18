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
            if(isset($_SESSION['email'])){
            	if($_SESSION['userType'] == 1){
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
            include($basedir . '/navbars/navbar.php');
            }
            
            ?>
      </header>
      <!-- Page Content -->
      <div class="page-heading about-heading header-text" style="background-image: url(assets/images/items/hometools.jpg);">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="text-content">
                     <h4>AllDay Market</h4>
                     <h2>HomeTools</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="row">
         <?php 
               include 'db.php';
               if(isset($_SESSION['userType'])){
                  if($_SESSION['userType'] == 1){
                     $sql = "SELECT * FROM items WHERE Department = 2";
                     $stmt= mysqli_stmt_init($conn);
                     mysqli_stmt_prepare($stmt,$sql);
                     mysqli_stmt_execute($stmt);
                     $results=mysqli_stmt_get_result($stmt);
               while ($row=mysqli_fetch_assoc($results))
               {
               $ID = $row['Barcode'];
               $name = $row['Name'];
               $price = $row['Price'];
               $qnt = $row['quantity'];
               $img = $row['img'];
               if($qnt>0)
               echo '
               <div class="col-md-4">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               <h6> ₪'.$price.' ~ <small>('.$qnt.')Units available</small>
               <br><br>
               
               <a href="editItemForm.php?id='.$ID.'">
               <button class="btn btn-secondary" type="button" class="filled-button" class="editBtn">
               Edit</button>
               </a>
               <form action="updateItem.php" method="post">
               <input type="hidden" name="id" value="'.$ID.'">
               <fieldset>
               <button type="submit" name="itemDel" id="form-submit" class="btn btn-danger">Delete</button>
               </fieldset>
               </form>
               </div>
               </div>
               </div>
               ';
               else
               echo '
               <div class="col-md-4">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               <h6> ₪'.$price.' ~ <small><font color="RED">(OUT OF STOCK)</font></small>
               <br><br>
               
               <a href="editItemForm.php?id='.$ID.'">
               <button class="btn btn-secondary" type="button" class="filled-button" class="editBtn">
               Edit</button>
               </a>
               <form action="updateItem.php" method="post">
               <input type="hidden" name="id" value="'.$ID.'">
               <fieldset>
               <button type="submit" name="itemDel" id="form-submit" class="btn btn-danger">Delete</button>
               </fieldset>
               </form>
               </div>
               </div>
               </div>
               ';
               }
               }
               else{ 
               //Selecting the sales available for the user, and making sum of them in case there are more than 1   
               $sql = "SELECT * FROM saleSystem WHERE userID = ? AND isUsed = 0;";
               $sumSales =0;
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$_SESSION['id']);
               mysqli_stmt_execute($stmt);
               $res=mysqli_stmt_get_result($stmt);
               while($row = mysqli_fetch_assoc($res)){
               $sale = $row['saleValue'];
               $depNum = $row['depNum'];
               $reason = $row['reason'];
               if($depNum == 2 || $depNum == NULL)
                $sumSales += $sale;
               }
               $sql = "SELECT * FROM items WHERE Department = 2;";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $results=mysqli_stmt_get_result($stmt);
               if(isset($sale)){
                  if(isset($sumSales)&&$sumSales>0)
                  echo'<hr><div class="alert alert-warning col-md-12" role="alert">
                  <p class="text-center" font-weight:bold>You have %'.$sale.' off for <b>"'.$reason .'"</b> Only For You! </p>
                 </div><hr>';
                 while ($row=mysqli_fetch_assoc($results))
                 {
                 $ID = $row['Barcode'];
                 $name = $row['Name'];
                 $price = $row['Price'];
                 $newPrice = $price/100  * (100-$sumSales);
                 $qnt = $row['quantity'];
                 $img = $row['img'];
                 if($qnt>0)
                 echo '
                 <div class="col-md-4">
                 <div class="product-item">
                 <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" alt=""></a>
                 <div class="down-content">
                 <a href="#"><h4>'.$name.'</h4></a>
                 
                 <h6><del> ₪'.$price.'</del> ₪'.$newPrice.'  ~  <small>('.$qnt.')Units available</small>
                 <br><br>
                 
                 <form id="qnt'.$ID.'">
                 <input type="text" placeholder="Enter Quantity in Units" name="qty" required>
                 <button class="btn btn-danger" type="button" onclick= add('.$ID.') class="filled-button" class="add2cart">Add To Cart</button></h6>
                 </form>
                 </div>
                 </div>
                 </div>
                 ';
                 else
                 echo '
                 <div class="col-md-4">
                 <div class="product-item">
                 <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" alt=""></a>
                 <div class="down-content">
                 <a href="#"><h4>'.$name.'</h4></a>
                 
                 <h6> ₪'.$price.' ~ <small><font color="RED">(OUT OF STOCK)</font></small>
                 <br><br>
                 
                 </div>
                 </div>
                 </div>
                 ';
                 }
            }
            else {
               while ($row=mysqli_fetch_assoc($results))
               {
               $ID = $row['Barcode'];
               $name = $row['Name'];
               $price = $row['Price'];
               $qnt = $row['quantity'];
               $img = $row['img'];
               if($qnt>0)
               echo '
               <div class="col-md-4">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               <h6>₪'.$price.'  ~  <small>('.$qnt.')Units available</small>
               <br><br>
               
               <form id="qnt'.$ID.'">
               <input type="text" placeholder="Enter Quantity in Units" name="qty" required>
               <button class="btn btn-danger" type="button" onclick= add('.$ID.') class="filled-button" class="add2cart">Add To Cart</button></h6>
               </form>
               </div>
               </div>
               </div>
               ';
               else
               echo '
               <div class="col-md-4">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               <h6> ₪'.$price.' ~ <small><font color="RED">(OUT OF STOCK)</font></small>
               <br><br>
               
               </div>
               </div>
               </div>
               ';
               }
            }
               }
               }
               else{
                  $sql = "SELECT * FROM items WHERE Department = 2;";
                  $stmt= mysqli_stmt_init($conn);
                  mysqli_stmt_prepare($stmt,$sql);
                  mysqli_stmt_execute($stmt);
                  $results=mysqli_stmt_get_result($stmt);      
               while ($row=mysqli_fetch_assoc($results))
               {
               $id = $row['Barcode'];
               $name = $row['Name'];
               $price = $row['Price'];
               $img = $row['img'];
               $qnt = $row['quantity'];
               if($qnt>0)
               echo '
               <div class="col-md-4">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" border="5px"; alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               ₪'.$price.' ~ <small>('.$qnt.')Units available</small>
               <br><br>
               
               <p>3 Years Warranty</p>
               </div>
               </div>
               </div>
               ';
               else
               echo '
               <div class="col-md-4">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" border="5px"; alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               ₪'.$price.' ~ <small><font color="RED">(OUT OF STOCK)</font></small>
               <br><br>
               
               <p>3 Years Warranty</p>
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
      <script type="text/javascript">
         function add(id){
           qnt = $('#qnt'+id).serialize();
           $('#qnt'+id).trigger("reset");
           $.ajax({
             url:'add2cart.php',
             method:'POST',
             data:{
             'id': id,
             'qnt': qnt
             },
             success:function(data){
               console.log(data);
             }
           });
         }
      </script>
   </body>
</html>