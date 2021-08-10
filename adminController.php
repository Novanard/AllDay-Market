<?php 
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
   		if (isset($_POST['addItem'])) {
   			include 'db.php';
   			$iName = $_POST['name'];
   			$price = $_POST['price'];
   			$department = $_POST['department'];
   			$type = (explode('.', $_FILES['iPhoto']['name']));
   			$tmp_name = $_FILES['iPhoto']['tmp_name'];
   			$name = $_FILES['iPhoto']['name'];
   			$target_dir = 'assets/images/items';
   			$type = end($type);
   			$allowed = ['png','jpg'];
   
   			if(in_array($type, $allowed)){
   				$target_file = $target_dir . basename($_FILES["iPhoto"]["name"]);
   				move_uploaded_file($tmp_name, $target_file);
   				$sql = "INSERT INTO items (Name,Price,Department,img) VALUES (?,?,?,?);";
   				$stmt= mysqli_stmt_init($conn);
   			    mysqli_stmt_prepare($stmt,$sql);
   			    mysqli_stmt_bind_param($stmt,"siis",$iName,$price,$department,$target_file);
   			    mysqli_stmt_execute($stmt);
				header( "url=index.php" );
   			}
   			else{
   				$uploadError = 'This type isnt allowed!';
   				}
		}
   		else if (isset($_POST['editItem'])) {
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
   			}
   		else if (isset($_POST['delItem'])) {
   			include 'db.php';
   
   			$id = $_POST['eID'];
   			$sql= "DELETE FROM items WHERE eID = ?;";
   			$stmt= mysqli_stmt_init($conn);
   			mysqli_stmt_prepare($stmt,$sql);
   			mysqli_stmt_bind_param($stmt,"i",$id);
   			mysqli_stmt_execute($stmt);	
   		}
		
	?>