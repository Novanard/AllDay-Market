<?php 

if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  if(isset($_POST['itemEdit'])){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
      include 'db.php';
      $Barcode = $_POST['id'];
      $Name=$_POST['Name'];
      $Price=$_POST['Price'];
      $Department=$_POST['Department'];
      $sql = "UPDATE items set Name = ?, Price = ?,Department = ? WHERE Barcode = ?; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"siii",$Name,$Price,$Department,$Barcode);
      mysqli_stmt_execute($stmt);
      header('Location:index.php');
    }
  elseif(isset($_POST['itemDel'])){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include 'db.php';
    $Barcode =$_POST['id'];
    $sql = "DELETE FROM items WHERE Barcode = ?; ";
    $stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$Barcode);
    mysqli_stmt_execute($stmt);
    header('Location:index.php');
  }
  else
  echo('Something else');
  } ?>
