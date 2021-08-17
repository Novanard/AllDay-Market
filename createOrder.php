<?php 
  
include 'db.php'; 
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	if (isset($_POST['submit'])) {
		if(isset($_SESSION['email'])){
		$userID=$_SESSION['id'];
		$timestamp = date('Y-m-d H:i:s');
		//Creating order record upon checking out
		$sql = "INSERT INTO orders_id (userID,date) VALUES (?,?);";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"is",$userID,$timestamp);
        mysqli_stmt_execute($stmt);
		// Geting the order_id in order to store it in order details table 
		$sql = "SELECT id FROM orders_id WHERE userID =?";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$userID);
        mysqli_stmt_execute($stmt);
		$results=mysqli_stmt_get_result($stmt);
		$order_id;
		while($row=mysqli_fetch_assoc($results))
		$order_id=$row['id'];
		// Getting all of the items in the cart to store them in order details table
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
		// Checking the quantity of the product in the inventory
		$sql = "SELECT quantity FROM items WHERE Barcode = ? LIMIT 1";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$itemBarcode);
        mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		$qnt = $row['quantity'];
		// If the quantity is bigger than what the customer wants, then we add it to their order
		if($qnt > $quantity){
		$sql = "INSERT INTO order_details (itemBarcode,depNum,quantity,order_id,img) VALUES (?,?,?,?,?);";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"iiiis",$itemBarcode,$depNum,$quantity,$order_id,$img);
        mysqli_stmt_execute($stmt);
		// Updating the quantity in the inventory 
		$sql ="UPDATE items SET quantity = ? WHERE Barcode = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		$newQ = $qnt - $quantity;
		mysqli_stmt_bind_param($stmt,"ii",$newQ,$itemBarcode);
		mysqli_stmt_execute($stmt);
		//Getting the current sellCount in order to increase it
		$sql ="SELECT sellCount FROM items WHERE Barcode = ? LIMIT 1";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		$newQ = $qnt - $quantity;
		mysqli_stmt_bind_param($stmt,"i",$itemBarcode);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		$sellCount = $row['sellCount'];
		//Updating the sellCount to the new one
		$sellCount += $quantity;
		$sql = "UPDATE items SET sellCount = ? WHERE Barcode = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"ii",$sellCount,$itemBarcode);
		mysqli_stmt_execute($stmt);
		}
		header('Location:finishOrder.php');
		}
		}
	else
		header('Location:login.php');
	}
?>

