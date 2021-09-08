<?php 

	include 'db.php';
	session_start();
	if(isset($_SESSION['email'])){
		$user = $_SESSION['email'];
		$userID = $_SESSION['id'];
		$id = $_POST['id'];
		$qnt = (int)explode('=',$_POST['qnt'])[1];
		$sql = "SELECT * FROM items WHERE Barcode = ? LIMIT 1;";
		$stmt= mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"i",$id);
		mysqli_stmt_execute($stmt);
		$results=mysqli_stmt_get_result($stmt);
		$row=mysqli_fetch_assoc($results);
		$name = $row['Name'];
		$price = $row['Price']; 
		$price =number_format($price,2);
		$img = $row['img'];
		$depNum = $row['Department'];
               //Selecting the sales available for the user, and making sum of them in case there are more than 1   
               $sql = "SELECT * FROM saleSystem WHERE userID = ? AND isUsed = 0;";
               $sumSales =0;
               $stmt= mysqli_stmt_init($conn);
               mysqli_stmt_prepare($stmt,$sql);
               mysqli_stmt_bind_param($stmt,"i",$_SESSION['id']);
               mysqli_stmt_execute($stmt);
               $res=mysqli_stmt_get_result($stmt);
               while($row = mysqli_fetch_assoc($res)){
               $sale = $row['saleValue'];
               $saleDep = $row['depNum'];
               if($depNum == $saleDep || $saleDep == NULL)
                $sumSales += $sale;
			}
			$_SESSION['sumSales'] = $sumSales;
			if($sumSales>0)
			$price = $price/100 * (100-$sumSales);
			
		//Checking if the product already exists into cart update quantity only
		$sql = "SELECT * from Cart WHERE userID = ? AND itemBarcode =? LIMIT 1;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"ii",$userID,$id);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if(mysqli_num_rows($res)>0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
			$itemBarcode = $row['itemBarcode'];
			if($itemBarcode == $id){
			$sql = "SELECT qnt FROM cart WHERE itemBarcode = ? AND userID = ?;";
			$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt,$sql);
			mysqli_stmt_bind_param($stmt,"ii",$id,$userID);
			mysqli_stmt_execute($stmt);
			$res = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($res);
			$oldQ = $row['qnt'];
			$newQ = $oldQ + $qnt;
			$sql = "UPDATE cart SET qnt = ? WHERE itemBarcode = ? AND userID = ?;";
			$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt,$sql);
			mysqli_stmt_bind_param($stmt,"iii",$newQ,$id,$userID);
			mysqli_stmt_execute($stmt);
			}
		}
		}
		else {
		$sql = "INSERT INTO cart (userID,name,price,qnt,itemBarcode,depNum,img) VALUES (?,?,?,?,?,?,?);";
		$stmt= mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt,$sql);
		mysqli_stmt_bind_param($stmt,"isssiis",$userID,$name,$price,$qnt,$id,$depNum,$img);
		mysqli_stmt_execute($stmt);
		}
	}

?>