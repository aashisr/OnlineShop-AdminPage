<?php
	session_start();
	require ("../members/header.php");

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
	<a href="../members/logout.php"><button class="btn btn-danger">Logout</button></a>
</div>

<div class = "content">
	<p>You can view existing members or create new members by clicking the links above.</p>
</div>

		</div>  <!-- container ends -->
	</body>
</html>