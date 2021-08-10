<!DOCTYPE html>
<html><head>
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
    <link rel="stylesheet" href="assets/css/owl.css"></head>
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
            	if($_SESSION['email'] === 'admin@allday.com'){
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

    <div class="page-heading about-heading header-text" style="background-image: url(assets/images/veghs.png);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>AllDay Market</h4>
              <h2>Cart</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
 <div class="col-md-9">
  <div class="row">
	<?php 
		include 'db.php';
		if(isset($_SESSION['email'])){
			$userID = $_SESSION['id'];
			$sql = "SELECT * FROM cart WHERE userID = ?";
	        $stmt= mysqli_stmt_init($conn);
	        mysqli_stmt_prepare($stmt,$sql);
	        mysqli_stmt_bind_param($stmt,"i",$userID);
	        mysqli_stmt_execute($stmt);
	        $results=mysqli_stmt_get_result($stmt);
	    	$totalPrice = 0;
		  while ($row=mysqli_fetch_assoc($results)) 
	        {
			
			echo '		<div class="col-md-6">
                      <div class="product-item">';                   
					$name = $row['name'];
					$price = $row['price'];
					$qnt = $row['qnt'];
					$img = $row['img'];
					$total=$row['qnt'] * $row['price'];
					$totalPrice += $total;
				echo '<div style="display: flex;align-items:center;">

                        <a href="#"><img src="'.$img.'" alt=""></a>
                       <div class="down-content">
                          <a href="#"><h4>'.$name.'</h4></a>
                          <h6>₪'.$price.'
						  <h6>Amount: '.$qnt.'
						  <h6>Total:'.$total.' <br>
						<form action="deleteCart.php" method="post">
							<input type="hidden" value="'.$name.'" name="delete" />
							<input class="btn btn-danger" value="Delete" type="submit" />
						</form>
				

                          <br><br>                                                 
                        </div>
                      </div>
                    </div>
					';
	        	echo "</div>";
				
	        }
	    }	
			
?> 	
	</div>
	<div style="font-family: 'Poppins', sans-serif;font-size: 20px;float: right;font-weight: bold">
	
		Total Price = <?php echo $totalPrice ?>
		<form action="createOrder.php" method="POST">
		<button class="btn btn-danger" type="submit" name="submit" class="filled-button" class="payBtn">Checkout</button>
		</form>
		
	
	</div>
	</div>
    


    <!-- Page Content -->
  


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