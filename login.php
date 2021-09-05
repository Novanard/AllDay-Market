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
    $stats = 0;
    $uEmail = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   	include "db.php";
   	$email=$_POST['email'];
   	$password=$_POST['password'];
  	$sql = "SELECT * FROM users WHERE email = ?";
    $stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)>0){
      $uEmail=1;
    	$row = mysqli_fetch_assoc($result);
    	$pwdcheck=password_verify($password,$row['password']);
    	if($pwdcheck){
        $stats=1;
    		session_start();
        $_SESSION['id']=$row['id'];
        $userID = $row['id'];
    		$_SESSION['email']=$row['email'];
        $_SESSION['userType']=$row['userType'];
        $sql="SELECT * FROM users WHERE id = ? LIMIT 1 ;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$userID);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($res);
        $registerDate = $row['registerDate'];
        $totalOrders = $row['lifetimeOrders'];
        $weeklyOrders = $row['weeklyOrders'];
        $totalSpent = $row['lifetimeSpent'];
        $weeklySpent=$row['weeklySpent'];
        $registerMonth = date("m",strtotime($registerDate));
        $currentDate = DATE("Y-m-d");
        $currentMonth = date("m",strtotime($currentDate));
        //Checking if the user has been registered for 2 months without any Orders
        if($totalOrders ==0 && $currentMonth >= ($registerMonth +2)){
          //Checking if user previously got this sale
            $sale = 30; $isUsed = 0; $reason = "Registered for +2Months Without Any Orders";
            $sql = "SELECT * from saleSystem WHERE saleValue = ? AND reason = ? AND userID = ? LIMIT 1 ;";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"isi",$sale,$reason,$userID);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($res)==0){
            $sql = "INSERT INTO saleSystem(userID,saleValue,isUsed,reason) VALUES(?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"iiis",$userID,$sale,$isUsed,$reason);
            mysqli_stmt_execute($stmt);
            }
        }
        //If the user has most orders made lifetime 
        $sql = "SELECT MAX(lifetimeOrders) as MaxOrders from users LIMIT 1;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($res);
        $MaxOrders = $row['MaxOrders'];
        if($MaxOrders == $totalOrders){
          //Checking if user already has this sale
         $sale = 15; $isUsed = 0; $reason = "Most orders made of all time!";
        $sql = "SELECT * from saleSystem WHERE saleValue = ? AND reason = ? AND userID = ? LIMIT 1 ;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"isi",$sale,$reason,$userID);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res)==0){
        $sql = "INSERT INTO saleSystem(userID,saleValue,isUsed,reason) VALUES(?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"iiis",$userID,$sale,$isUsed,$reason);
        mysqli_stmt_execute($stmt);
        }
      }
        //If the user has most weekly orders
        $sql = "SELECT MAX(weeklyOrders) as MaxWeekOrders from users LIMIT 1;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($res);
        $MaxWeekOrders = $row['MaxWeekOrders'];
        if($MaxWeekOrders == $weeklyOrders){
            $sql = "SELECT * from saleSystem WHERE saleValue = ? AND reason = ? AND userID = ? LIMIT 1 ;";
            $sale = 20; $isUsed = 0; $reason ="Most Orders of the Week";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"isi",$sale,$reason,$userID);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($res)==0){
            $sql = "INSERT INTO saleSystem(userID,saleValue,isUsed,reason) VALUES(?,?,?,?);";
            $sale = 20; $isUsed = 0; $reason ="Most Orders of the Week";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"iiis",$userID,$sale,$isUsed,$reason);
            mysqli_stmt_execute($stmt);
            }
        }
        //Checking if the user has 3 uncounted orders above 150ILS ( counted for sales )
        $sql = "SELECT id,topDep FROM oldorders_id WHERE userID = ? AND countedSale=0 And totalMoney>150 LIMIT 3;";
        $sql2 = "SELECT id,topDep FROM orders_id WHERE userID = ? AND countedSale=0 AND totalMoney>150 LIMIT 3;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql2);
        mysqli_stmt_bind_param($stmt,"i",$userID);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res) == 3){
          $dep1=0;$dep2=0;$dep3=0;$dep4=0;
          while($row = mysqli_fetch_assoc($res))
          {
            $topDep = $row['topDep'];
            if($topDep == 1)
              $dep1++;
            if($topDep == 2)
              $dep2++;
            if($topDep == 3)
              $dep3++;
            if($topDep == 4)
              $dep4++;    
         }
         //If the user had the same favorite department for the last 3 orders they get
         // A sale for that department
         if($dep1 ==3)
         {
            $depNum=1;
            $sql = "SELECT * FROM saleSystem WHERE userID = ? AND saleValue = ? AND reason = ? AND depNum = ? LIMIT 1;";
            $sale = 20; $isUsed = 0; $reason ="Favorite Department Over The Last 3 Orders";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"isii",$userID,$sale,$reason,$depNum);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($res)== 0){
            $sql = "INSERT INTO saleSystem(userID,saleValue,isUsed,reason,depNum) VALUES(?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"iiisi",$userID,$sale,$isUsed,$reason,$depNum);
            mysqli_stmt_execute($stmt);
            }
         }
         if($dep2 == 3)
         {
            $depNum=2;
            $sql = "SELECT * FROM saleSystem WHERE userID = ? AND saleValue = ? AND reason = ? AND depNum = ? LIMIT 1;";
            $sale = 20; $isUsed = 0; $reason ="Favorite Department Over The Last 3 Orders";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"isii",$userID,$sale,$reason,$depNum);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($res)== 0){
            $sql = "INSERT INTO saleSystem(userID,saleValue,isUsed,reason,depNum) VALUES(?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"iiisi",$userID,$sale,$isUsed,$reason,$depNum);
            mysqli_stmt_execute($stmt);
            }
         }
         if($dep3 == 3)
         {
            $depNum=3;
            $sql = "SELECT * FROM saleSystem WHERE userID = ? AND saleValue = ? AND reason = ? AND depNum = ? LIMIT 1;";
            $sale = 20; $isUsed = 0; $reason ="Favorite Department Over The Last 3 Orders";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"isii",$userID,$sale,$reason,$depNum);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($res)== 0){
            $sql = "INSERT INTO saleSystem(userID,saleValue,isUsed,reason,depNum) VALUES(?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"iiisi",$userID,$sale,$isUsed,$reason,$depNum);
            mysqli_stmt_execute($stmt);
            }
         }
         if($dep4 == 3 )
         {
            $depNum=4;
            $sql = "SELECT * FROM saleSystem WHERE userID = ? AND saleValue = ? AND reason = ? AND depNum = ? LIMIT 1;";
            $sale = 20; $isUsed = 0; $reason ="Favorite Department Over The Last 3 Orders";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"isii",$userID,$sale,$reason,$depNum);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($res)== 0){
            $sql = "INSERT INTO saleSystem(userID,saleValue,isUsed,reason,depNum) VALUES(?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"iiisi",$userID,$sale,$isUsed,$reason,$depNum);
            mysqli_stmt_execute($stmt);
            }
         }
         //If the user has no favorite department, they get 10% only.
         else {
          $sale = 10; $isUsed = 0; $reason ="Made 3 Orders Above 150 ILS";
          $sql = "INSERT INTO saleSystem(userID,saleValue,isUsed,reason) VALUES(?,?,?,?);";
          $stmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"iiis",$userID,$sale,$isUsed,$reason);
          mysqli_stmt_execute($stmt);
         }
      }
      header('Location:index.php');
        }
        else
        $stats =2;
      }
    else 
    	$uEmail = 2;
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


    <div class="page-heading contact-heading header-text" style="background-image: url(assets/images/items/heading-4-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>AllDay ~ Market</h4>
              <h2>Log-in</h2>
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
              <h2>User Panel - Login</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div class="contact-form">
              <form action="login.php" method="post" enctype="multipart/form-data">
                      <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="email" type="email" class="form-control" id="name" placeholder="Email Address" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                       <input name="password" type="password" class="form-control" id="name" placeholder="Enter Your Password" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="">
                    </fieldset>
                  </div>
					<br>
                      <button type="submit" name="submit" class="filled-button" value="Submit" style="padding: 5px 10px;">Log-in</button>
                    </fieldset>
					<br>
                  </div>
                </div>
              </form>
              <?php
              if($stats==2){
                echo	'  <hr><div class="alert alert-warning" role="alert">
                <p class="text-center" font-weight:bold>Incorrect Password</p>
               </div><hr>';
              }
              else if($uEmail==2){
              echo	'  <hr><div class="alert alert-warning" role="alert">
              <p class="text-center" font-weight:bold>Email is not registered</p>
             </div><hr>';
            }   
            ?>
			  <br><br>
            </div>
          </div>
		 <div>
		 Dont have an account? <a href="register.php"> Register </a>
		</div>
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