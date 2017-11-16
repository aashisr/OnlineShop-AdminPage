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

<?php 
	if (isset($_GET['mod']) && is_numeric($_GET['mod'])) {
					$mod = $_GET['mod'];
				}
?>

<div class = "content" id = "modify">
	<h2>Modify users informartion here:</h2>
	<form method = "post" action="../members/loginCheck.php" class="form-horizontal">
		<input type="hidden" name="mod" value = "<?php echo $mod ?>">
	
		<?php
			require_once("../members/dbconnect.php") ;

			$sql = "SELECT email, address, remarks FROM users WHERE UserId = $mod";
			$result1 = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query

			if (mysqli_num_rows($result1) > 0) {
				while ($row = mysqli_fetch_assoc($result1)) {
		?>
			
		<div class = "form-group">
			<label for ="email" class = "control-label col-sm-2">Email:</label>
			<div class = "col-sm-9">
				<input type="email" class="form-control" name="email" value="<?php echo $row["email"]  ?>">
			</div>
		</div>

		<div class = "form-group">
			<label for ="address" class = "control-label col-sm-2">Address:</label>
			<div class = "col-sm-9">
				<input type="text" class="form-control" name="address" value="<?php echo $row["address"]  ?>">
			</div>
		</div>

		<div class = "form-group">
			<label for ="remarks" class = "control-label col-sm-2">Remarks:</label>
			<div class = "col-sm-9">
				<input type="text" class="form-control" name="remarks" value="<?php echo $row["remarks"]  ?>">
			</div>
		</div>
		
		<?php 
				}
			} else {
				echo "User not found";
			}
		?>

		<div class = "form-group">
			<div class = "col-sm-offset-2 col-sm-10">
				<button class = "btn btn-success" type="submit" name = "modifyUser">Modify User</button>
			</div>
		</div>

	</form>
	<br>




</div>  <!-- content ends -->


</div>  <!-- container ends -->
</body>
</html>

