<?php 
if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  if(isset($_POST['employeeEdit'])){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
      include 'db.php';
      $id = $_POST['id'];
      $eID = $_POST['eID'];
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $depNum= $_POST['depNum'];
      $perhour = $_POST['perhour'];
      $residence = $_POST['residence'];
      $pin = $_POST['PIN'];
      $sql = "UPDATE employees SET eID = ?,PIN = ?,firstname = ?,lastname = ?,depNum = ?,perhour = ?,residence = ? WHERE id = ?; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"isssiisi",$eID,$pin,$firstname,$lastname,$depNum,$perhour,$residence,$id);
      mysqli_stmt_execute($stmt);
      header('Location:index.php');
    }
  elseif(isset($_POST['employeeDel'])){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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
