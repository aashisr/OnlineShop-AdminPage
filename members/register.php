<?php
	session_start();
	require ("../members/header.php");
?>

<div class = "content" id = "register">
	<form method = "post" action="../members/loginCheck.php" class="form-horizontal">

		<h2>Please register here.</h2>
		<h4><a href="../members/login.php">Or go to login page.</a></h4>
				
				
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
			<label for ="hint" class = "control-label col-sm-2">Password Hint:</label>
			<div class = "col-sm-9">
				<input type="text" class="form-control" name="hint" placeholder="Type 3 passwords, 1 correct">
			</div>
		</div>
		<div class = "form-group">
			<div class = "col-sm-offset-2 col-sm-10">
				<button class = "btn btn-success" type="submit" name = "register">Register</button>
			</div>
		</div>
	</form>

	<div id ="registerSuccess">
		<?php if (!empty($_SESSION["registerSuccess"])) {
			echo $_SESSION["registerSuccess"];
			unset($_SESSION["registerSuccess"]);
			} ?>
	</div>

	<div id ="registerError">
		<?php if (!empty($_SESSION["registerError"])) {
			echo $_SESSION["registerError"];
			unset($_SESSION["registerError"]);
			} ?>
	</div>

</div>  <!-- content ends -->



		</div>  <!-- container ends -->
	</body>
</html>