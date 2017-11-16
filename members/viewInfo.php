<?php
	session_start();
	require ("../members/header.php");

	if(!isset($_SESSION["login"])) {
	header ("location:../members/login.php");
}
?>

<?php 
	if (isset($_GET['user'])) {
		$view = $_GET['user'];
	}
?>

<nav id = "navigation" class="row navbar navbar-inverse">
	<div class = "container-fluid">
		<ul class="col-lg-12 nav navbar-nav">
			<li class = "active"><a href="../index.php">Home</a></li>
			<?php
				require_once("../members/dbconnect.php");

				$sql = "SELECT  UserId FROM users WHERE UserId = '$view'";
				$result = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query

				if (mysqli_num_rows($result) >= 1) {
					while($row = mysqli_fetch_assoc($result)) {
			?>

			<li><?php echo "<a href=\"../members/viewInfo.php?user=$row[UserId]\">View Info</a>" ?></li>

			<?php
					}
				} else {
					echo "User Id not found.";
				}	
			?>
			<li><a href="../members/viewmembers.php">View all Members</a></li>
			<li><a href="../members/updateYourself.php">Update information</a></li>		
		</ul>
	</div>
</nav>

<div id = "logout">
	<p>Logged in as <?php $vname= $_SESSION["uname"]; ?> <span class="username"><?php echo $vname;?></span></p>
	<a href="../members/logout.php"><button class="btn btn-danger">Logout</button></a>
</div>

<div class = "content table-responsive" id ="viewInfo">
	<p>Your Personal Inforamtion:</p>

	<?php

		$sql = "SELECT username, email, address, remarks, passwordHint FROM users WHERE UserId = '$view'";
		$result = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query  

		if (mysqli_num_rows($result) >= 1)  {
			while($row = mysqli_fetch_assoc($result)) {  
			
	?>

	<table id = "infoTable">
		<tr>
			<td class="leftBold">Username:</td>
			<td><?php echo $row["username"]; ?></td>
		</tr>
		<tr>
			<td class="leftBold">Email:</td>
			<td><?php echo $row["email"]; ?></td>
		</tr>
		<tr>
			<td class="leftBold">Address:</td>
			<td><?php echo $row["address"]; ?></td>
		</tr>
		<tr>
			<td class="leftBold">Remarks:</td>
			<td><?php echo $row["remarks"]; ?></td>
		</tr>
		<tr>
			<td class="leftBold">Password Hint:</td>
			<td><?php echo $row["passwordHint"]; ?></td>
		</tr>
	</table>

	<?php
			}
		}
	?>
	
</div>
