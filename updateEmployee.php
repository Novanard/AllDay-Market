<?php 

if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  if(isset($_POST['employeeEdit'])){
      include 'db.php';
      $id=$_POST['id'];
      $eID = $_POST['eID'];
      $firstname=$_POST['firstname'];
      $lastname=$_POST['lastname'];
      $perhour=$_POST['perhour'];
      $depNum=$_POST['depNum'];
      $residence=$_POST['residence'];
      $sql = "UPDATE employees set eID = ?, firstname = ?, lastname = ?,perhour = ?,depNum=?,residence = ? WHERE id = ?; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"issiisi",$eID,$firstname,$lastname,$perhour,$depNum,$residence,$id);
      mysqli_stmt_execute($stmt);
      header('Location:employees.php');
    }
  elseif(isset($_POST['employeeDel'])){
    include 'db.php';
    $id =$_POST['id'];
    $sql = "DELETE FROM employees WHERE id = ?; ";
    $stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    header('Location:employees.php');
  }
  else
  echo('Something else');
  } ?>
