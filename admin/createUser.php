<?php
	session_start();
	require ("../members/header.php");

	
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


<div class = "content" id = "createUser">
		<form method = "post" action="../members/loginCheck.php" class="form-horizontal">

		<h2>Add users here:</h2>
				
				
		<div class = "form-group">
			<label for ="uname" class = "control-label col-sm-2">Username:</label>
			<div class = "col-sm-9">
				<input type="text" class="form-control" name="uname" required>
			</div>
		</div>
		<div class = "form-group">
			<label for ="email" class = "control-label col-sm-2">Email:</label>
			<div class = "col-sm-9">
				<input type="email" class="form-control" name="email">
			</div>
		</div>
		<div class = "form-group">
			<label for ="password" class = "control-label col-sm-2">Password:</label>
			<div class = "col-sm-9">
				<input type="password" class="form-control" name="password">
			</div>
		</div>
		<div class = "form-group">
			<label for ="address" class = "control-label col-sm-2">Address:</label>
			<div class = "col-sm-9">
				<input type="text" class="form-control" name="address">
			</div>
		</div>
		
		<div class = "form-group">
			<div class="col-sm-offset-2 col-sm-9">
		 		<div class="checkbox">
      				<label><input type="checkbox" name = "admin"> Add as admin</label>
    			</div>
    		</div>
    	</div>

    	<div class = "form-group">
			<div class = "col-sm-offset-2 col-sm-10">
				<button class = "btn btn-success" type="submit" name = "createUser">Add User</button>
			</div>
		</div>
	</form>


	<div id ="registerError">
		<?php if (!empty($_SESSION["registerError"])) {
			echo $_SESSION["registerError"];
			unset($_SESSION["registerError"]);
			} ?>
	</div>
</div>  <!-- createUser ends -->


		</div>  <!-- container ends -->
	</body>
</html>