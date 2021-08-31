<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	session_start();
	require './db.php';
	$email = $_SESSION['email'];
	$userID = $_SESSION['id'];
	$quantity = $_POST['newQty'];
	if(isset($_POST['deleteCart'])){
	$name = $_POST['deleteName'];
	$sql = "DELETE FROM cart WHERE userID = ? AND name = ?;";
	$stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"is",$userID,$name);
    mysqli_stmt_execute($stmt);
	}
	if(isset($quantity))
	{
		$stock=$_POST['stock'];
		$name =$_POST['updateName'];
		if($quantity<$stock && $quantity>0){
		$sql="UPDATE cart SET qnt = ? WHERE userID=? AND name=?;";
		$stmt=mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"iis",$quantity,$userID,$name);
		mysqli_stmt_execute($stmt);
		}

	}
    header('Location: cart.php');
}
