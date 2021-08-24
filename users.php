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
            include($basedir . '/navbars/nav.php');
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
                     <h2>Users</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-10">
         <div class="row">
            <?php 
               mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                           include 'db.php';
                           $sql = "SELECT * FROM users";
                           $stmt= mysqli_stmt_init($conn);
                           mysqli_stmt_prepare($stmt,$sql);
                           mysqli_stmt_execute($stmt);
                           $results=mysqli_stmt_get_result($stmt);
               
               	if(isset($_SESSION['email'])){
               	if($_SESSION['userType'] == 1){
               		while ($row=mysqli_fetch_assoc($results))
               			{
               			  $id = $row['id'];
                         $name=$row['name'];
                         $email=$row['email'];
                         $address=$row['address'];
                         $number = $row['number'];
               			  $img = $row['avatar'];
               			  echo '
               				<div class="col-md-6">
               				  <div class="product-item">
               					<a href="#"><img src="'.$img.'" height="350px" width="250px" alt=""></a>
               				   <div class="down-content">
               					<center><strong>'.$name.' &nbsp ~ &nbsp '.$address.'&nbsp </strong><small>('.$id.')</small></center>
               					 </div>
               					  <br>
               					  <div>
               					  <ul>
               					  <li><strong>Email Address: </strong>'.$email.'</li>
                                <li><strong>Address: </strong>'.$address.'</li>
               					  <li><strong>Phone No: </strong>'.$number.'</li>
                                 </ul>
               					  </div>
               					  <div>
                               <a href="editUserForm.php?id='.$id.'">
                               <button class="btn btn-secondary" type="button" class="filled-button" class="editBtn">Edit</button>
                               </a>
                               <form action="updateSupplier.php" method="post">
                               <input type="hidden" name="id" value="'.$id.'">
                               <fieldset>
                               <button type="submit" name="userDel" id="form-submit" class="btn btn-danger">Delete</button>
                               </fieldset>
                               </form>
                           </div>
                           </div>
                         </div>
                         ';
               			}
               	}
               
               	}
               else{
               			  echo '
               				You cant see here
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