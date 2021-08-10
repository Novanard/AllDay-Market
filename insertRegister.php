<?php 

if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
include 'db.php'; 
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $hashedpwd=password_hash($password, PASSWORD_DEFAULT);
  $address=$_POST['address'];
  $number=$_POST['number'];

      $sql = "INSERT INTO users (name,email,password,address,number) VALUES (?,?,?,?,?);";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"sssss",$name,$email,$hashedpwd,$address,$number);
        mysqli_stmt_execute($stmt);

        header('Location:login.php');
    }

?>
