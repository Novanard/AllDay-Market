<?php 

	include 'db.php';
	session_start();
	if(isset($_SESSION['email'])){
		$user = $_SESSION['email'];
		$userID=$_SESSION['id'];
		$id = $_POST['id'];
		$qnt = (int)explode('=',$_POST['qnt'])[1];
		$sql = "SELECT * FROM items WHERE Barcode = ?";
		$stmt= mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"i",$id);
		mysqli_stmt_execute($stmt);
		$results=mysqli_stmt_get_result($stmt);
		$row=mysqli_fetch_assoc($results);
		$name = $row['Name'];
		$price = $row['Price'];
		$img = $row['img'];
		$sql = "INSERT INTO cart (userID,name,price,qnt,img) VALUES (?,?,?,?,?);";
		$stmt= mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"issss",$userID,$name,$price,$qnt,$img);
		mysqli_stmt_execute($stmt);
	}

?>