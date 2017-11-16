<?php
	session_start();
	require ("../members/header.php");
?>
<div class = "content" id = "login">
	<form method = "post" action="../members/loginCheck.php" class="form-horizontal">
		
		<h2>Please login here.</h2>
		<h4><a href="../members/register.php">or register here.</a></h4>

		<div class = "form-group">
			<label for ="uname" class = "control-label col-sm-2">Username:</label>
			<div class = "col-sm-9">
				<input type="text" class="form-control" name="uname" required>
			</div>
		</div>
		<div class = "form-group">
			<label for ="password" class = "control-label col-sm-2">Password:</label>
			<div class = "col-sm-9">
				<input type="password" class="form-control" name="password">
			</div>
		</div>
			<div class = "form-group">
			<div class = "col-sm-offset-2 col-sm-10">
				<button class = "btn btn-success" type="submit" name = "login">Login</button>
			</div>
		</div>
	</form>

	<div id ="errMsg">
		<?php if (!empty($_SESSION["errMsg"])) {
			echo $_SESSION["errMsg"];
			unset($_SESSION["errMsg"]);
			}
		 ?>
	</div>


</div>  <!-- login ends -->


		</div>  <!-- container ends -->
	</body>
</html>