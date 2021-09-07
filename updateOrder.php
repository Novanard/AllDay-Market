<?php 
if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  include 'db.php';
  session_start();
  if(isset($_POST['isDone'])){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);;
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
        //If the order is finished, we archieve the order and move it to old orders.
        $sql = "UPDATE orders_id SET isDone =1 WHERE id = ?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$orderID);
        mysqli_stmt_execute($stmt);
        $sql = "SELECT * FROM orders_id WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$orderID);
        mysqli_stmt_execute($stmt);   
        $results=mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);
        $userID = $row['userID'];
        $date = $row['date'];
        $totalItems = $row['totalItems'];
        $totalMoney = $row['totalMoney'];
        $isDone = $row['isDone'];
        $countedSale = $row['countedSale'];
        $topDep = $row['topDep'];
        $sql = "INSERT into oldOrders_id(id,userID,date,totalItems,totalMoney,isDone,countedSale,topDep) VALUES(?,?,?,?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"iisiiiii",$orderID,$userID,$date,$totalItems,$totalMoney,$isDone,$countedSale,$topDep);
        mysqli_stmt_execute($stmt); 
        //Selecting the order details and archieving them in oldOrder details table.    
        $sql = "SELECT * FROM order_details WHERE order_id = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$orderID);
        mysqli_stmt_execute($stmt);   
        $results=mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($results)){
          $id = $row['id'];
          $itemBarcode = $row['itemBarcode'];
          $itemName = $row['itemName'];
          $depNum = $row['depNum'];
          $price = $row['price'];
          $quantity = $row['quantity'];
          $total = $row['total'];
          $isDone = $row['isDone'];
          $img = $row['img'];
          $sql = "INSERT INTO oldOrder_details (id,itemBarcode,itemName,depNum,price,quantity,total,order_id,isDone,img) VALUES (?,?,?,?,?,?,?,?,?,?);";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"iisiiiiiis",$id,$itemBarcode,$itemName,$depNum,$price,$quantity,$total,$orderID,$isDone,$img);
          mysqli_stmt_execute($stmt); 
          //Deleting the record from the active orders   
          $sql = "DELETE FROM orders_id WHERE id =? ;";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"i",$orderID);
          mysqli_stmt_execute($stmt);  
        }

      }
      header('Location:employeeOrders.php');

      
    }
  else if(isset($_POST['saveCart'])){
    $userID;
    if(isset($_SESSION['id']))
    $userID = $_SESSION['id'];
    $sql = "UPDATE cart set checkedOut = 0 WHERE userID = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$userID);
    mysqli_stmt_execute($stmt);
    header('Location:index.php');
  }  
  else if(isset($_POST['deleteCart'])){
    $userID;
    if(isset($_SESSION['id']))
    $userID = $_SESSION['id'];
    $sql = "DELETE FROM cart WHERE userID = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$userID);
    mysqli_stmt_execute($stmt);
    header('Location:index.php');  
  }
  else
  echo('Something else');
  } ?>
