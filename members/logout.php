<?php 
	session_start();
	unset($_SESSION["login"]);
	unset($_SESSION["uname"]);
	header("location:../members/login.php");
?>