
<!-- registration and login checking -->

<?php
	//session_start();

	$servername = "localhost";
	$database = "practicalattack";
	$username = "root";
	$password = "";

	// Create connection

	$conn = mysqli_connect($servername, $username, $password, $database);

	// check connection

	if (!$conn) {
		die("Connection failed:" .mysqli_connect_error());
	} 

?>  