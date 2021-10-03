<?php 
if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
  if(isset($_POST['userEdit'])){
      include 'db.php';
      $id = $_POST['id'];
      $name=$_POST['name'];
      $email=$_POST['email'];
      $password = $_POST['password'];
      $number=$_POST['phone'];
      $address=$_POST['address'];
      if(isset($name) && !empty($name)){
        $sql = "UPDATE users SET name = ? WHERE id=? ;";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"si",$name,$id);
        mysqli_stmt_execute($stmt);
        }
        if(isset($email) && !empty($email)){
          $sql = "UPDATE users SET email = ? WHERE id=? ;";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"si",$email,$id);
          mysqli_stmt_execute($stmt);
          $_SESSION['email'] === $email;
          }

      if(isset($number) && $number >0){
          $sql = "UPDATE users SET number = ? WHERE id=? ;";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"ii",$number,$id);
          mysqli_stmt_execute($stmt);
          }
      if(isset($password) && !empty($password)){
          $hashedpwd=password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET  password = ? WHERE id=? ;";
            $stmt= mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$hashedpwd,$id);
            mysqli_stmt_execute($stmt);
         }  
      if(isset($address) && !empty($address)){
            $sql = "UPDATE users SET  address = ? WHERE id=? ;";
            $stmt= mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$address,$id);
            mysqli_stmt_execute($stmt);
         }  
            header('Location:users.php');
      }
   else if(isset($_POST['profileEdit'])){
      include 'db.php';
      $id = $_POST['id'];
      $name=$_POST['name'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $number=$_POST['phone'];
      $address=$_POST['address'];
      if(isset($name) && !empty($name)){
        $sql = "UPDATE users SET name = ? WHERE id=? ;";
        $stmt= mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"si",$name,$id);
        mysqli_stmt_execute($stmt);
        }
        if(isset($email) && !empty($email)){
          $sql = "UPDATE users SET email = ? WHERE id=? ;";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"si",$email,$id);
          mysqli_stmt_execute($stmt);
          $_SESSION['email'] === $email;
          }

      if(isset($number) && $number >0){
          $sql = "UPDATE users SET number = ? WHERE id=? ;";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"ii",$number,$id);
          mysqli_stmt_execute($stmt);
          }
      if(isset($password) && !empty($password)){
          $hashedpwd=password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET  password = ? WHERE id=? ;";
            $stmt= mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$hashedpwd,$id);
            mysqli_stmt_execute($stmt);
         }  
      if(isset($address) && !empty($address)){
            $sql = "UPDATE users SET  address = ? WHERE id=? ;";
            $stmt= mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$address,$id);
            mysqli_stmt_execute($stmt);
         }  
            header('Location:profile.php');
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
  elseif(isset($_POST['alterUser'])){
    if ($_SERVER['REQUEST_METHOD'] === "POST" ) {   
      if(isset($_POST['alterUser'])){
          include 'db.php';
          $id = $_POST['id'];
          $sql = "SELECT userType FROM users WHERE id=? LIMIT 1 ; ";
          $stmt= mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt,$sql);
          mysqli_stmt_bind_param($stmt,"i",$id);
          mysqli_stmt_execute($stmt);
          $res = mysqli_stmt_get_result($stmt);
          $row = mysqli_fetch_assoc($res);
          $isAdmin = $row['userType'];
          if($isAdmin==1){
            $sql = "UPDATE users SET userType =0 WHERE id=?; ";
            $stmt= mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"i",$id);
            mysqli_stmt_execute($stmt);
          }
          else{
            $sql = "UPDATE users SET userType =1 WHERE id=?; ";
            $stmt= mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"i",$id);
            mysqli_stmt_execute($stmt);
          }
        }
        header('Location:users.php');
  }
}
  else
  echo('Something else');
  } ?>
