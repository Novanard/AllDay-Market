                           <div class="col-lg-12 col-md-12 col-sm-12">
                              <fieldset>
                                 <input type="file" name="ePhoto" id="Image">
                              </fieldset>
                           </div>
						   
						   
						            	$type = (explode('.', $_FILES['ePhoto']['name']));
         	$tmp_name = $_FILES['ePhoto']['tmp_name'];
         	$name = $_FILES['ePhoto']['name'];
         	$target_dir = 'assets/images/employees';
         	$type = end($type);
         	$allowed = ['png','jpg'];
         	if(in_array($type, $allowed)){
         		$target_file = $target_dir . basename($_FILES["ePhoto"]["name"]);
         		move_uploaded_file($tmp_name, $target_file);
         		$sql = "INSERT INTO employees (eID,firstname,lastname,depNum,perhour,residence,avatar) VALUES (?,?,?,?,?,?,?);";
         		$stmt= mysqli_stmt_init($conn);
         	    mysqli_stmt_prepare($stmt,$sql);
         	    mysqli_stmt_bind_param($stmt,"issiiss",$eID,$eFirstname,$eLastname,$depNum,$PerHour,$residence,$target_file);
         	    mysqli_stmt_execute($stmt);
         
         	}else{
         		$uploadError = 'This type isnt allowed!';
               echo($uploadError);
         	}