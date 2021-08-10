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
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>AllDay <em>Market</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 



                            <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                    
                    <div class="dropdown-menu">
                      <a class="dropdown-item active" href="vegehtables.php">Vegehtables</a>
                      <a class="dropdown-item" href="HomeTools.php">Home Tools</a>
                      <a class="dropdown-item" href="Bakery.php">Bakery</a>
                      <a class="dropdown-item" href="butchery.php">Butchery</a>
                    </div>
                </li>

                
                <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
				<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>


    <!-- Page Content -->
  
       <br />
	<div>
	<div>
    <form action="insertLogin.php" method="POST">
        <table width="40%"  align="center" class="table table-dark table-hover">

            <tr>
                <td colspan=2><center><font size=4><b>Login in order to continue</b></font></center></td>
            </tr>

            <tr>
                <td>Email:</td>
                <td><input type="email" size=25 name="email"></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" size=25 name="password" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required></td>
            </tr>

            <tr>
                <td><input type="Reset"></td>
                <td><input type="submit" name="Submit" value="Login"></td>
				<td><a href="register.php">Register</a>
				</td>
               
            </tr>
        </table>

    </form>
	</div>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>
</html>