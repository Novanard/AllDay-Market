<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   	include "db.php";
   	$email=$_POST['email'];
   	$password=$_POST['password'];
  	$sql = "SELECT * FROM users WHERE email = ?";
    $stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result)>0){
    	$row = mysqli_fetch_assoc($result);
    	$pwdcheck=password_verify($password,$row['password']);
    	if($pwdcheck){
    		session_start();
    		
    		$_SESSION['id']=$row['id'];
    		$_SESSION['email']=$row['email'];
    		 header('Location:index.php');
    	}
    	else{
    		echo "Password is incorrect";
    		exit();
    	}
    }
    else {
    	echo "Email isn't registered";
    	exit();
    }




}