<?php 
if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  if(isset($_POST['userEdit'])){
      include 'db.php';
      $id = $_POST['id'];
      $name=$_POST['name'];
      $email=$_POST['email'];
      $password = $_POST['password'];
      $hashedpwd=password_hash($password, PASSWORD_DEFAULT);
      $number=$_POST['phone'];
      $address=$_POST['address'];
      $sql = "UPDATE users SET name = ?,email = ?, password = ?,number = ?,address = ? WHERE id=? ; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"sssisi",$name,$email,$hashedpwd,$number,$address,$id);
      mysqli_stmt_execute($stmt);
      header('Location:users.php');
    }
  elseif(isset($_POST['userDel'])){
    include 'db.php';
    $id =$_POST['id'];
    $sql = "DELETE FROM users WHERE id = ?; ";
    $stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    header('Location:users.php');
  }
  else
  echo('Something else');
  } ?>
