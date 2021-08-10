<?php 
if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  if(isset($_POST['supplierEdit'])){
      include 'db.php';
      $id=$_POST['id'];
      $sID=$_POST['sID'];
      $name=$_POST['name'];
      $company=$_POST['company'];
      $phone=$_POST['phone'];
      $sql = "UPDATE suppliers set sID= ?,name = ?,company = ?,phone = ? WHERE id=? ; ";
      $stmt= mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"issii",$sID,$name,$company,$phone,$id);
      mysqli_stmt_execute($stmt);
      header('Location:index.php');
    }
  elseif(isset($_POST['supplierDel'])){
    include 'db.php';
    $id =$_POST['id'];
    $sql = "DELETE FROM suppliers WHERE id = ?; ";
    $stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    header('Location:index.php');
  }
  else
  echo('Something else');
  } ?>
