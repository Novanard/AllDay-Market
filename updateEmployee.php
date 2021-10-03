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
      if(isset($eID) && !empty($eID)){
        $sql = "UPDATE employees SET eID = ? WHERE id=? ;";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"ii",$eID,$id);
        mysqli_stmt_execute($stmt);
        }
        if(isset($firstname) && !empty($firstname )){
          $sql = "UPDATE employees SET firstname = ? WHERE id=? ;";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"si",$firstname,$id);
          mysqli_stmt_execute($stmt);
          }
        if(isset($lastname) && !empty($lastname)){
            $sql = "UPDATE employees SET lastname = ? WHERE id=? ;";
            $stmt= mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$lastname,$id);
            mysqli_stmt_execute($stmt);
            }  
            if(isset($depNum) && !empty($depNum)){
              $sql = "UPDATE employees SET depNum = ? WHERE id=? ;";
              $stmt= mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt,$sql);
              mysqli_stmt_bind_param($stmt,"ii",$depNum,$id);
              mysqli_stmt_execute($stmt);
              }   
           if(isset($perhour) && !empty($perhour)){
                $sql = "UPDATE employees SET perhour = ? WHERE id=? ;";
                $stmt= mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"ii",$perhour,$id);
                mysqli_stmt_execute($stmt);
                }  
                if(isset($residence) && !empty($residence)){
                  $sql = "UPDATE employees SET residence = ? WHERE id=? ;";
                  $stmt= mysqli_stmt_init($conn);
                  mysqli_stmt_prepare($stmt,$sql);
                  mysqli_stmt_bind_param($stmt,"si",$residence,$id);
                  mysqli_stmt_execute($stmt);
                  } 
                  if(isset($pin) && !empty($pin)){
                    $sql = "UPDATE employees SET PIN = ? WHERE id=? ;";
                    $stmt= mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt,$sql);
                    mysqli_stmt_bind_param($stmt,"ii",$pin,$id);
                    mysqli_stmt_execute($stmt);
                    }                           
      header('Location:employees.php');
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
