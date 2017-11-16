<?php
	session_start();
	require ("../members/header.php");

	if(!isset($_SESSION["login"])) {
	header ("location:../members/login.php");
}
?>


<nav id = "navigation" class="row navbar navbar-inverse">
	<div class = "container-fluid">
		<ul class="col-lg-12 nav navbar-nav">
			<li class = "active"><a href="../index.php">Home</a></li>
			<?php
				require_once("../members/dbconnect.php");

				$uname = $_SESSION["uname"];
				$sql = "SELECT username, UserId, email, address FROM users WHERE username = '$uname'";
				$result = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query

				if (mysqli_num_rows($result) > 0) {
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

<div class = "content table-responsive" id ="viewUsers">
<p>Users registered in the database:</p>
	<table border="1px solid" class="table-responsive">
		<tr>
			<th>S. No.</th>
			<th>Username</th>
			<th>Email</th>
			<th>Address</th>
			
		</tr>
		<?php
			require_once ("../members/dbconnect.php") ;

			$sql = "SELECT UserId, username, email, UserCheck, address FROM users";
			$result = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query

			if (mysqli_num_rows($result) > 0) {
				$i = 1; 
				while ($row = mysqli_fetch_assoc($result)) {
		?>
			<tr>
				<td> <?php echo $i++ ?></td>
				<td> <?php echo $row["username"] ?> </td>
				<td> <?php echo $row["email"] ?> </td>
				<td> <?php echo $row["address"] ?> </td>
				
			</tr>
		<?php			
				}
		?>
		<?php
			} else {
				echo "No users found";
			}
		mysqli_close($conn);
		?>
	</table>
</div>   <!-- viewUsers ends -->





<br>






</div>  <!-- container ends -->
</body>
</html>