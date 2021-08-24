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
<div class="page-heading about-heading header-text" style="background-image: url(assets/images/veghs.png);">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>AllDay Market</h4>
            <h2>View Payroll</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST['viewPayroll'])){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include 'db.php';
    echo' 
    <div class="col-md-12">
    <div class="row">';
      $id = $_POST['id'];
      $sql = "SELECT * from oldPayroll_details WHERE payroll_id = ?; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"i",$id);
      mysqli_stmt_execute($stmt);
      $results = mysqli_stmt_get_result($stmt);
      $day = 1;
	  while ($row=mysqli_fetch_assoc($results)) 
	        {
                $startTime = $row['startTime'];
                $endTime = $row['endTime'];
                $totalTime = $row['totalTime'];
                $payday = $row['payday'];
                $payroll_id = $row['payroll_id'];
                echo '
                               <div class="col-md-6">
                               <div class="product-item">
                               <div class="down-content">
                               <a href="#"><h4>Day~'.$day.'</h4></a>
                               
                               <ol><li>StartTime: '.$startTime.'<br>
                               <li>endTime: '.$endTime.'<br>
                               <li>TotalTime: '.$totalTime.'<br>
                               <li>Payday: ₪'.$payday.'<br>

                               </div>
                               </div>
                               </div>
                               ';
                $day+=1;
                
           }
                              // Making sum of all current working days
                              $sql = "SELECT SUM(payday) as totalPayday FROM oldPayroll_details WHERE payroll_id = ? ";
                              $stmt= mysqli_stmt_init($conn);
                              mysqli_stmt_prepare($stmt,$sql);
                              mysqli_stmt_bind_param($stmt,"i",$id);
                              mysqli_stmt_execute($stmt);
                              $results=mysqli_stmt_get_result($stmt);
                              $row = mysqli_fetch_assoc($results);
                              $totalPayday = $row['totalPayday'];
                              // Making count of all working days
                              $sql = "SELECT COUNT(payday) as totalDays FROM oldPayroll_details WHERE payroll_id = ? ";
                              $stmt= mysqli_stmt_init($conn);
                              mysqli_stmt_prepare($stmt,$sql);
                              mysqli_stmt_bind_param($stmt,"i",$id);
                              mysqli_stmt_execute($stmt);
                              $results=mysqli_stmt_get_result($stmt);
                              $row = mysqli_fetch_assoc($results);
                              $totalDays = $row['totalDays']; 
                              echo '
                              <div class="col-md-6">
                              <div class="product-item">
                              <div class="down-content">
                              <a href="#"><h4>Summary:</h4></a>
                              <br>
                              Total Work Days: '.$totalDays.'<br>
                              Total Payday: ₪'.$totalPayday.'

                              </div>
                              </div>
                              </div>
                              ';
                              echo'</div></div>';
        }
    }
        else
        echo($id);

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