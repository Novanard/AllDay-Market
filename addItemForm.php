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
<?php 
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		if (isset($_POST['submit'])) {
			include 'db.php';

			$pname = $_POST['name'];
			$price = $_POST['price'];
			$department = $_POST['department'];

			$type = (explode('.', $_FILES['iPhoto']['name']));
			$tmp_name = $_FILES['iPhoto']['tmp_name'];
			$name = $_FILES['iPhoto']['name'];
			$target_dir = 'assets/images/items';
			$type = end($type);
			$allowed = ['png','jpg'];

			if(in_array($type, $allowed)){
				$target_file = $target_dir . basename($_FILES["iPhoto"]["name"]);
				move_uploaded_file($tmp_name, $target_file);
				$sql = "INSERT INTO items (Name,Price,Department,img) VALUES (?,?,?,?);";
				$stmt= mysqli_stmt_init($conn);
			    mysqli_stmt_prepare($stmt,$sql);
			    mysqli_stmt_bind_param($stmt,"ssss",$pname,$price,$department,$target_file);
			    mysqli_stmt_execute($stmt);

			}
      else{
				$uploadError = 'This type isnt allowed!';
			}
    }
	?>
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
		if($_SESSION['email'] === 'admin@allday.com'){
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
    <?php
     if(isset($_SESSION['email'])&& $_SESSION['userType']== 1){
         echo '
         <div class="page-heading contact-heading header-text" style="background-image: url(assets/images/heading-4-1920x500.jpg);">
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <div class="text-content">
                 <h4>AllDay ~ Market</h4>
                 <h2>Admin Panel</h2>
               </div>
             </div>
           </div>
         </div>
       </div>    
       <div class="send-message">
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <div class="section-heading">
                 <h2>Admin Panel ~ Upload An Item</h2>
               </div>
             </div>
             <div class="col-md-8">
               <div class="contact-form">
                 <form action="addItemForm.php" method="post" enctype="multipart/form-data">
                         <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12">
                       <fieldset>
                         <input name="name" type="text" class="form-control" id="name" placeholder="Item Name" required="">
                       </fieldset>
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12">
                       <fieldset>
                          <input name="price" type="text" class="form-control" id="name" placeholder="Item Price" required="">
                       </fieldset>
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12">
                       <fieldset>
                          <input name="department" type="text" class="form-control" id="name" placeholder="Item Department" required="">
                       </fieldset>
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12">
                       <fieldset>
                          <input type="file" name="iPhoto" id="iPhoto" required="">
                       </fieldset>
                     </div>
                     <div class="col-lg-12">
                       <fieldset>
             <br>
                         <button type="submit" name="submit" class="filled-button" value="Submit">Upload Item</button>
                       </fieldset>
             <br>
                     </div>
                   </div>
                 </form>
               </div>
             </div>
             <div class="col-md-4">
                 <div class="col-md-4">
         <br><br><br><br><br><br><br>
         <a href="adminCp.php"><button class="btn btn-danger" type="submit">Back to Control Panel</button></a>
         </h5>
         <br>
             </div>
       <br>
     </div>
   </div>
           </div>
         </div>
       </div> ';
      }
      else 
      header('Location:index.php');
      ?>

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
