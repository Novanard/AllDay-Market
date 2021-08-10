<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	session_start();
	require './db.php';
	$email = $_SESSION['email'];
	$name = $_POST['delete'];
	$sql = 'DELETE FROM cart WHERE email = ? and name = ?';
	$stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ss",$email,$name);
    mysqli_stmt_execute($stmt);

    header('Location: cart.php');
}
