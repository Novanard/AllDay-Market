<?php 

if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  if(isset($_POST['isDone'])){
      include 'db.php';
      $barcode = $_POST['barcode'];
      $sql = "UPDATE order_details set isDone = 1 WHERE itemBarcode = ?; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"i",$barcode);
      mysqli_stmt_execute($stmt);
      header('Location:employeeOrders.php');
      
    }
  else
  echo('Something else');
  } ?>
