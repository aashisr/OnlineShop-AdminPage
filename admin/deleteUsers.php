<?php
require_once("../members/dbconnect.php");

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	
	$delete = "DELETE FROM users WHERE UserId = $id" ;
	$result = mysqli_query($conn,$delete) or die(mysqli_error($conn));

	if(mysqli_affected_rows($conn)==1) {
		$_SESSION["deleteSuccess"] = "User has been deleted successfully." ;
		header("location:../admin/viewUsers.php");
	} else {
		echo "Error: ". mysqli_error($conn);
	}
}

?>

