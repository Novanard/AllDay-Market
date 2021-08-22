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
              <h2>Order Status</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
 <div class="col-md-9">
  <div class="row">
  <?php 
  if(isset($_POST['viewOrder'])){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
      include 'db.php';
      $orderID = $_POST['orderID'];
      $sql = "SELECT * from order_details WHERE order_id = ?; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"i",$orderID);
      mysqli_stmt_execute($stmt);
      $results = mysqli_stmt_get_result($stmt);
	  while ($row=mysqli_fetch_assoc($results)) 
	        {
                echo '		<div class="col-md-6">
                <div class="product-item">';                   
                  $itemBarcode = $row['itemBarcode'];
                  $itemName = $row['itemName'];
                  $depNum = $row['depNum'];
                  $price = $row['price'];
                  $qnt = $row['quantity'];
                  $total = $row['total'];
                  $img = $row['img'];
          echo '<div style="display: flex;align-items:center;">

                  <a href="#"><img src="'.$img.'" alt=""></a>
                 <div class="down-content">
                    <a href="#"><h4>'.$itemName.'<small>('.$itemBarcode.')</small></h4></a>
                    <h6>₪'.$price.'
                    <h6>Amount: '.$qnt.'
                    <h6>Total:'.$total.' <br>
                    <br><br>                                                 
                  </div>
                </div>
              </div>
              ';
          echo "</div>";
	        }
	    }	 
    if(isset($_POST['statusOrder'])){
      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
      include 'db.php';
      $orderID = $_POST['orderID'];
      $sql = "SELECT * from order_details WHERE order_id = ?; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"i",$orderID);
      mysqli_stmt_execute($stmt);
      $results = mysqli_stmt_get_result($stmt);
	  while ($row=mysqli_fetch_assoc($results)) 
	        {
                echo '		<div class="col-md-6">
                <div class="product-item">';                   
                  $itemBarcode = $row['itemBarcode'];
                  $itemName = $row['itemName'];
                  $depNum = $row['depNum'];
                  $price = $row['price'];
                  $qnt = $row['quantity'];
                  $total = $row['total'];
                  $img = $row['img'];
                  $isDone = $row['isDone'];
          echo '<div style="display: flex;align-items:center;">

                  <a href="#"><img src="'.$img.'" alt=""></a>
                 <div class="down-content">
                    <a href="#"><h4>'.$itemName.'<small>('.$itemBarcode.')</small></h4></a>
                    <h6>₪'.$price.'
                    <h6>Amount: '.$qnt.'
                    <h6>Total:'.$total.' <br>
                    <h6>Status:'; 
                    if($isDone==0)
                      echo'<span style="font-size:22px; color:red">InComplete</span>';
                      else
                      echo'<span style="font-size:22px; color:green">Complete</span>';
                      echo'
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