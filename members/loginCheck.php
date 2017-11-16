<?php
	session_start();
	require("../members/dbconnect.php");
		// Register

	if (isset($_POST["register"])) {    //isset determines if a variable is set and is not Null
		$uname = mysqli_real_escape_string($conn,$_POST["uname"]);
		$email = mysqli_real_escape_string($conn,$_POST["email"]);
		$password = mysqli_real_escape_string($conn,$_POST["password"]);
		$address = mysqli_real_escape_string ($conn,$_POST["address"]);
		$hint = mysqli_real_escape_string ($conn,$_POST["hint"]);
		$UserId = mt_rand(46000,46999);

		$sql = "SELECT username FROM users WHERE username = '$uname'"; //Check if username already exists
		$result = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query

		$sql1 = "SELECT UserId FROM users WHERE UserId = '$UserId'"; //Check if userid already exists
		$result1 = mysqli_query($conn,$sql1);
	
		if (mysqli_num_rows($result)== 0 && mysqli_num_rows($result1) == 0)  {			// returns the number of rows in result set
			$sql = "INSERT INTO users (UserId, username, email, password, address, passwordHint) VALUES ('$UserId', '$uname', '$email', '$password', '$address', '$hint')";

			if (mysqli_query($conn,$sql)) {
				// echo "Username $uname succesfully registered. Please go to login page.";
				$_SESSION["registerSuccess"] = "Username $uname succesfully registered. Please go to login page." ;
				header("location:../members/register.php") ;
				}
			else {
				echo "Error: " . mysqli_error($conn);
				}
			}
		else {
			// echo "Username $uname not available.";
			$_SESSION["registerError"] =  "Username $uname not available." ;
				header("location:../members/register.php") ;
		}
		
	}

	// Login

	if (isset($_POST["login"])) {
		$uname = mysqli_real_escape_string($conn,$_POST["uname"]);
		$password = mysqli_real_escape_string($conn,$_POST["password"]);

		$sql = "SELECT username, password FROM users WHERE username = '$uname' AND password = '$password'";
		$result = mysqli_query($conn, $sql); 
		

		if (mysqli_num_rows($result) == 1) {
			
			$_SESSION["login"] = "1" ;
			$_SESSION["uname"] = $uname;

			$userCheck = "SELECT username, password, UserCheck FROM users WHERE username = '$uname' AND password = '$password' AND UserCheck = 1";
			$userResult = mysqli_query ($conn, $userCheck);

			if (mysqli_num_rows($userResult) == 1) {
				header ("location:../admin/admin.php");
			} else {
				header ("location:../index.php");
			}

		} else {
			$_SESSION['errMsg'] = "Invalid username or password. Please try again.";
			
			header("location:../members/login.php");
		}

	}

	// Create user

	if (isset($_POST["createUser"])) {    //isset determines if a variable is set and is not Null
		$uname = mysqli_real_escape_string($conn,$_POST["uname"]);
		$email = mysqli_real_escape_string($conn,$_POST["email"]);
		$password = mysqli_real_escape_string($conn,$_POST["password"]);
		$address = mysqli_real_escape_string ($conn,$_POST["address"]);
		$UserId = mt_rand(46000,46999);

		$sql = "SELECT username FROM users WHERE username = '$uname'";
		$result = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query

		if (mysqli_num_rows($result)== 0) {			// returns the number of rows in result set
			if (isset($_POST['admin'])) {
				$sqladmin = "INSERT INTO users (UserId, username, email, password, address, UserCheck) VALUES ('$UserId', '$uname', '$email', '$password', '$address',1)";
			} else {
				$sql = "INSERT INTO users (UserId, username, email, password, address) VALUES ('$UserId', '$uname', '$email', '$password', '$address')";
			}

		if (mysqli_query($conn,$sqladmin)) {
				$_SESSION["registerSuccessAdmin"] = "Username $uname created successfully as admin. " ;
				header("location:../admin/viewUsers.php") ;
			
			} elseif (mysqli_query($conn,$sql)) {
				$_SESSION["registerSuccess"] = "Username $uname created successfully. " ;
				header("location:../admin/viewUsers.php") ;
			} else {
				echo "Error: " . mysqli_error($conn);
			}
		
		} else {
			$_SESSION["registerError"] = "Username $uname not available." ;
				header("location:../admin/createUser.php") ;
		}
		
	}

	//modifyUser

		
	if (isset($_POST["modifyUser"])) {    //isset determines if a variable is set and is not Null

		if (is_numeric($_POST['mod'])) {
			$id = $_POST['mod'] ;

			$email = mysqli_real_escape_string($conn,$_POST["email"]);
			$address = mysqli_real_escape_string ($conn,$_POST["address"]);
			$remarks = mysqli_real_escape_string ($conn,$_POST["remarks"]);


			$modify = "UPDATE users SET email = '$email', address = '$address', remarks = '$remarks' WHERE UserId = $id ";
			$result = mysqli_query($conn, $modify) OR die (mysqli_error($conn));

			if(mysqli_affected_rows($conn) == 1) {
				$_SESSION["modifySuccess"] = "Information succesfully modified." ;
				header("location:../admin/viewUsers.php");
			} elseif (mysqli_affected_rows($conn) == 0) {
				$_SESSION["modifyError"] = "Please change at least one information." ;
				header("location:../admin/viewUsers.php");
			} else {
				echo "Error:" . mysqli_error($conn);
				header("location:../admin/viewUsers.php");
			}

		} else {
			$_SESSION["userIdError"] = "Can not get userid."; 
			header("location:../admin/viewUsers.php"); 
		}
	}


	//updateYourself
		
	if(isset($_POST["update"])) {
		$email = mysqli_real_escape_string($conn,$_POST["email"]);
		$address = mysqli_real_escape_string ($conn,$_POST["address"]);
		$uname = $_SESSION["uname"];
		
		$update = "UPDATE users SET email = '$email', address = '$address'  WHERE username = '$uname' " ;
		$result = mysqli_query($conn, $update) or die(mysqli_error($conn)); 

		if (mysqli_affected_rows($conn) == 1) {
			$_SESSION["modifySuccess"] = "Information succesfully modified." ;
			header("location:../members/updateYourself.php");
		} elseif (mysqli_affected_rows($conn) == 0) {
			$_SESSION["modifyError"] = "Email or address can not be same as previous one." ;
			header("location:../members/updateYourself.php");
		} else {
			echo "Error:" . mysqli_error($conn);
			header("location:../members/updateYourself.php");
		}
		
	}

	mysqli_close($conn);

?>