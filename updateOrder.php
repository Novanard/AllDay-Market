<?php 

if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  if(isset($_POST['isDone'])){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
      include 'db.php';
      $barcode = $_POST['barcode'];
      $orderID = $_POST['orderID'];
      $sql = "UPDATE order_details set isDone = 1 WHERE itemBarcode = ? AND order_id = ?; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"ii",$barcode,$orderID);
      mysqli_stmt_execute($stmt);
      // Selecting all of the not-ready items, if there are nothing it means the order is finished
      $sql = "SELECT * FROM order_details WHERE order_id = ? AND isDone =0 ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"i",$orderID);
      mysqli_stmt_execute($stmt);
      $results=mysqli_stmt_get_result($stmt);
      if(mysqli_num_rows($results)==0){
        $sql = "UPDATE orders_id SET isDone =1 WHERE id = ?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$orderID);
        mysqli_stmt_execute($stmt);

      }
      header('Location:employeeOrders.php');

      
    }
  else
  echo('Something else');
  } ?>
