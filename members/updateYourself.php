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


<div class = "content" id = "update">
	<h2>Update your information here</h2>
	<br>


	<form method = "post" action="../members/loginCheck.php" class="form-horizontal">
		<?php
			require_once("../members/dbconnect.php") ;
			$uname = $_SESSION["uname"];

			$sql = "SELECT email, address FROM users WHERE username = '$uname'";
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
		
		<?php 
				}
			} else {
				echo "User not found";
			}
		?>

		<div class = "form-group">
			<div class = "col-sm-offset-2 col-sm-10">
				<button class = "btn btn-success" type="submit" name = "update">Update</button>
			</div>
		</div>
			
	</form>

	<br>

	<div id ="modifySuccess">
		<?php 
			if (!empty($_SESSION["modifySuccess"])) {
				echo $_SESSION["modifySuccess"];
				unset($_SESSION["modifySuccess"]);
			} 
		?>
	</div>


	<div id ="modifyError">
		<?php
			if (!empty($_SESSION["modifyError"])) {
				echo $_SESSION["modifyError"];
				unset($_SESSION["modifyError"]);
			} 
		?>
	</div>

</div>




</div>  <!-- container ends -->
</body>
</html>