<?php 
  
include 'db.php'; 
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	if (isset($_POST['submit'])) {
		if(isset($_SESSION['email'])){
		$userID=$_SESSION['id'];
		$timestamp = date('Y-m-d H:i:s');
		//Creating
		$sql = "INSERT INTO orders_id (userID,date) VALUES (?,?);";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"is",$userID,$timestamp);
        mysqli_stmt_execute($stmt);
		$sql = "SELECT id FROM orders_id WHERE userID =?";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$userID);
        mysqli_stmt_execute($stmt);
		$results=mysqli_stmt_get_result($stmt);
		$order_id;
		while($row=mysqli_fetch_assoc($results))
		$order_id=$row['id'];
		$sql = "SELECT * FROM cart WHERE userID = ?";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$userID);
        mysqli_stmt_execute($stmt);
		$results=mysqli_stmt_get_result($stmt);
		while ($row=mysqli_fetch_assoc($results))
		{
		$itemBarcode=$row['itemBarcode'];
		$itemName=$row['name'];
		$quantity=$row['qnt'];
		$depNum =$row['depNum'];
		$img = $row['img'];
		$sql = "INSERT INTO order_details (itemBarcode,depNum,quantity,order_id,img) VALUES (?,?,?,?,?);";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"iiiis",$itemBarcode,$depNum,$quantity,$order_id,$img);
        mysqli_stmt_execute($stmt);
		}
        header('Location:finishOrder.php');
	
		}
	else
		header('Location:login.php');
	}
?>

