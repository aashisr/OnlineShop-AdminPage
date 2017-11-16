<?php
	session_start();
	require_once("../members/header.php");

	if(!isset($_SESSION["login"])) {
	header ("location:../members/login.php");
}
?>


<nav id = "navigation" class="navbar navbar-inverse">
	<div class = "container-fluid">
		<ul class="nav navbar-nav">
			<li class = "active"><a href="../admin/admin.php">Home</a></li>
			<li><a href="#">Notifications</a></li>
			<li><a href="../admin/viewUsers.php">View Users</a></li>
			<li><a href="../admin/createUser.php">Create users</a></li>
		</ul>
	</div>
</nav>

<div id = "logout">
	<p>Logged in as <?php $vname= $_SESSION["uname"]; ?> <span class="username"><?php echo $vname;?></span></p>
	<a id = "blogout" href="../members/logout.php"><button class="btn btn-danger" >Logout</button></a>
</div>

<div class = "content table-responsive" id ="viewUsers">
<p>Users registered in the database:</p>
	<table border="1px solid" class="table-responsive">
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Email</th>
			<th>Address</th>
			<th>UserCheck</th>
			<th>Remarks</th>
			<th>Delete User</th>
			<th>Modify Users</th>
			
		</tr>
		<?php
			require_once("../members/dbconnect.php") ;

			$sql = "SELECT UserId, username, email, UserCheck, address, remarks FROM users";
			$result = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
		?>
			<tr>
				<td> <?php echo $row["UserId"] ?> </td>
				<td> <?php echo $row["username"] ?> </td>
				<td> <?php echo $row["email"] ?> </td>
				<td> <?php echo $row["address"] ?> </td>
				<td> <?php echo $row["UserCheck"] ?> </td>
				<td> <?php echo $row["remarks"] ?> </td>
				<td> <?php echo "<a href='../admin/deleteUsers.php?del=$row[UserId]' onclick=\"return confirm('Are you sure you want to delete this user?')\"><span style='color:red'>Delete user</span></a>"  ?></td>
				<td> <?php echo "<a href='../admin/modifyUsers.php?mod=$row[UserId]'><span style='color:blue'>Modify user</span></a>"  ?></td>
			</tr>
		<?php			
				}
			} else {
				echo "No users found";
			}
		mysqli_close($conn);
		?>
	</table>
	<br>

	<div id ="registerSuccess">
		<?php
			 if (!empty($_SESSION["registerSuccess"])) {
				echo $_SESSION["registerSuccess"];
				unset($_SESSION["registerSuccess"]);
			} 
		?>
	</div>

	<div id ="registerSuccessAdmin">
		<?php
			 if (!empty($_SESSION["registerSuccessAdmin"])) {
				echo $_SESSION["registerSuccessAdmin"];
				unset($_SESSION["registerSuccessAdmin"]);
			} 
		?>
	</div>

	<div id ="modifySuccess">
		<?php 
			if (!empty($_SESSION["modifySuccess"])) {
				echo $_SESSION["modifySuccess"];
				unset($_SESSION["modifySuccess"]);
			} 
		?>
	</div>

	<div id ="deleteSuccess">
		<?php 
			if (!empty($_SESSION["deleteSuccess"])) {
				echo $_SESSION["deleteSuccess"];
				unset($_SESSION["deleteSuccess"]);
			} 
		?>
	</div>

	<div id ="userIdError">
		<?php if (!empty($_SESSION["userIdError"])) {
			echo $_SESSION["userIdError"];
			unset($_SESSION["userIdError"]);
			} ?>
	</div>

	<div id ="modifyError">
		<?php
			if (!empty($_SESSION["modifyError"])) {
				echo $_SESSION["modifyError"];
				unset($_SESSION["modifyError"]);
			} 
		?>
	</div>

</div>   <!-- viewUsers ends -->







</div>  <!-- container ends -->
</body>
</html>