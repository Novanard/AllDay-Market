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
		$sql = "SELECT id FROM orders_id WHERE userID =? AND date = ?";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"is",$userID,$timestamp);
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
		$totalItems = 0;	$totalMoney=0;
		while ($row=mysqli_fetch_assoc($results))
		{
		$itemBarcode=$row['itemBarcode'];
		$itemName=$row['name'];
		$quantity=$row['qnt'];
		$price = $row['price'];
		$total = $quantity * $price;
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
		// If the quantity is bigger than what the customer wants, then we add it to their order and 
		if($qnt >= $quantity){
			$totalItems++;
			$totalMoney+=$total;
		$sql = "INSERT INTO order_details (itemBarcode,itemName,depNum,price,quantity,total,order_id,img) VALUES (?,?,?,?,?,?,?,?);";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"isiiiiis",$itemBarcode,$itemName,$depNum,$price,$quantity,$total,$order_id,$img);
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
        else if($qnt<$quantity && $qnt >0){
            $quantity = $qnt;
            $totalItems++;
            $total = $qnt * $price;
			$totalMoney+=$total;
		$sql = "INSERT INTO order_details (itemBarcode,itemName,depNum,price,quantity,total,order_id,img) VALUES (?,?,?,?,?,?,?,?);";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"isiiiiis",$itemBarcode,$itemName,$depNum,$price,$quantity,$total,$order_id,$img);
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
	    //Marking the item as checkedOut in the cart
		$sql = "UPDATE cart SET checkedOut =1 WHERE userID = ? AND itemBarcode = ?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"ii",$userID,$itemBarcode);
		mysqli_stmt_execute($stmt);
    }
		// Updating the totalItems and totalMoney in orders id
		$sql = "UPDATE orders_id SET totalItems = ?,totalMoney=? WHERE id =?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"iii",$totalItems,$totalMoney,$order_id);
		mysqli_stmt_execute($stmt);
		//Getting the current weeklyOrders,lifeTimeOrders of the user and increasing it.	
		$sql = "SELECT weeklyOrders,lifetimeOrders FROM users WHERE id=? LIMIT 1;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"i",$userID);
		mysqli_stmt_execute($stmt);	
		$results=mysqli_stmt_get_result($stmt);
		$row=mysqli_fetch_assoc($results);
		$totalWeekly = $row['weeklyOrders'];
		$totalLife = $row['lifetimeOrders'];
		$totalWeekly+=1;
		$totalLife+=1;
		$sql = "UPDATE users SET weeklyOrders=?,lifetimeOrders=? WHERE id =?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"iii",$totalWeekly,$totalLife,$userID);
		mysqli_stmt_execute($stmt);
		//Getting the current weeklySpent,lifetimeSpent of the user and increasing it.	
		$sql = "SELECT weeklySpent,lifetimeSpent FROM users WHERE id=? LIMIT 1;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"i",$userID);
		mysqli_stmt_execute($stmt);	
		$results=mysqli_stmt_get_result($stmt);
		$row=mysqli_fetch_assoc($results);
		$totalWeekly = $row['weeklySpent'];
		$totalLife = $row['lifetimeSpent'];
		$totalWeekly+=$totalMoney;
		$totalLife+=$totalMoney;
		$sql = "UPDATE users SET weeklySpent=?,lifetimeSpent=? WHERE id =?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"iii",$totalWeekly,$totalLife,$userID);
		mysqli_stmt_execute($stmt);
			//Counting how many items per department are in the order to see the user's preference
	$sql = "SELECT depNum,COUNT(depNum) AS sumDepItems FROM order_details WHERE order_id = ? GROUP BY depNum;";	
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt,$sql);
	mysqli_stmt_bind_param($stmt,"i",$order_id);
	mysqli_stmt_execute($stmt);
	$results = mysqli_stmt_get_result($stmt);
	$favDep =0;$mostItems = 0;
	while($row = mysqli_fetch_assoc($results)){
		$depNum = $row['depNum'];
		$numItems = $row['sumDepItems'];
		if($numItems > $mostItems){
			$mostItems = $numItems;
			$favDep = $depNum;
		}
	}
		//Updating topDepartment in the order id
		$sql = "UPDATE orders_id SET topDep = ? WHERE id = ?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"ii",$favDep,$order_id);
		mysqli_stmt_execute($stmt);


			}	

				header('Location:finishOrder.php');
		}
	else
		header('Location:login.php');
	
	
?>

