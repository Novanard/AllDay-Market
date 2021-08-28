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
      <!-- Header -->
      <header class="">
         <?php
            session_start();
            if(isset($_SESSION['email'])){
            	if($_SESSION['userType'] == 1){
            		$target_dir = 'navbars/navadmin.php';
            		include ($target_dir);
            	}
            	else{
            		$target_dir = 'navbars/navuser.php';
            		include ($target_dir);
            	}
            }
            else{
            		$target_dir = 'navbars/navbar.php';
            		include ($target_dir);
            }
            
            ?>
      </header>
      <!-- Page Content -->
      <div class="page-heading about-heading header-text" style="background-image: url(assets/images/items/me5baz.jpg);">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="text-content">
                     <h4>AllDay Market</h4>
                     <h2>Bakery</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-10">
         <div class="row">
            <?php 
               include 'db.php';
               $sql = "SELECT * FROM items WHERE Department = 3";
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_execute($stmt);
               $results=mysqli_stmt_get_result($stmt);
               if(isset($_SESSION['email'])){
               if($_SESSION['userType'] ==1){
               while ($row=mysqli_fetch_assoc($results))
               {
               $ID = $row['Barcode'];
               $name = $row['Name'];
               $price = $row['Price'];
               $img = $row['img'];
               $qnt = $row['quantity'];

               echo '
               <div class="col-md-6">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" height="350px" width="250px" alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               ₪'.$price.' ~ <small>('.$qnt.')Pcs available</small>
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
               <p>Fresh Day to Day &nbsp;/&nbsp; Naturally Raised</p>
               </div>
               </div>
               </div>
               ';
               }
               }
               else{
               while ($row=mysqli_fetch_assoc($results))
               {
               $ID = $row['Barcode'];
               $name = $row['Name'];
               $price = $row['Price'];
               $img = $row['img'];
               $qnt = $row['quantity'];
               echo '
               <div class="col-md-6">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" style="width:470px;height:370px;" alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               ₪'.$price.' ~ <small>('.$qnt.')Pcs available</small>
               <br><br>
               <form id="qnt'.$ID.'">
               <input type="text" placeholder="Enter Quantity in Kilo" name="qty" required>
               <button class="btn btn-danger" type="button" onclick= add('.$ID.') class="filled-button" class="add2cart">Add To Cart</button></h6>
               </form>
               
               <p>Fresh Day to Day &nbsp;/&nbsp; Naturally Raised</p>
               </div>
               </div>
               </div>
               ';
               }
               }
               }
               else{
               while ($row=mysqli_fetch_assoc($results))
               {
               $id = $row['Barcode'];
               $name = $row['Name'];
               $price = $row['Price'];
               $img = $row['img'];
               $qnt = $row['quantity'];
               echo '
               <div class="col-md-6">
               <div class="product-item">
               <a href="#"><img src="'.$img.'" height="350px" width="250px" alt=""></a>
               <div class="down-content">
               <a href="#"><h4>'.$name.'</h4></a>
               
               ₪'.$price.' ~ <small>('.$qnt.')Pcs available</small>
               <br><br>
               <form id="qnt'.$id.'">
               <input type="text" placeholder="Enter Quantity in Kilo" name="qty" required>
               <button class="btn btn-danger" type="button" onclick= add('.$id.') class="filled-button" class="add2cart">Add To Cart</button></h6>
               </form>
               
               <p>Fresh Day to Day &nbsp;/&nbsp; Naturally Raised</p>
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