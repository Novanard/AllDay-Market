<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	session_start();
	require './db.php';
	$email = $_SESSION['email'];
	$userID = $_SESSION['id'];
	$name = $_POST['delete'];
	$sql = 'DELETE FROM cart WHERE userID = ? and name = ?';
	$stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"is",$userID,$name);
    mysqli_stmt_execute($stmt);

    header('Location: cart.php');
}
