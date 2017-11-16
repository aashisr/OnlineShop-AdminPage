<?php
	session_start();
	if(!isset($_SESSION["login"])) {
		header ("location:members/login.php");
	}
 ?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Attacking Access Controls</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
<!DOCTYPE html>
																																
	</head>

	<body>

		<div id="container"> <!--container starts-->

			<nav id = "navigation" class="row navbar navbar-inverse">
				<div class = "container-fluid">
					<ul class="col-lg-12 nav navbar-nav">
						<li class = "active"><a href="index.php">Home</a></li>
						<?php
							require_once("members/dbconnect.php");

							$uname = $_SESSION["uname"];
							$sql = "SELECT username, UserId, email, address FROM users WHERE username = '$uname'";
							$result = mysqli_query($conn,$sql);  // $conn- checks connection, $sql- specifies the query

							if (mysqli_num_rows($result) >= 1) {
								while($row = mysqli_fetch_assoc($result)) {
						?>

						<li><?php echo "<a href=\"members/viewInfo.php?user=$row[UserId]\">View Info</a>" ?></li>

						<?php
								}
							} else {
								echo "User Id not found.";
							}	
						?>
						<li><a href="members/viewmembers.php">View all Members</a></li>
						<li><a href="members/updateYourself.php">Update information</a></li>
						
					</ul>
				</div>
			</nav>

			<div id = "logout">
				<p>Logged in as <?php $vname= $_SESSION["uname"]; ?> <span class="username"><?php echo $vname;?></span></p>
				<a href="members/logout.php"><button class="btn btn-danger">Logout</button></a>
			</div>

			<div class = "content table-responsive" id = "indexContent">
			
				<table class = "ctable">
					<tr>
						<th>Photo</th>
						<th>Model</th>
						<th>Release Date</th>
						<th>Specifications</th>
						<th>Price</th>
					</tr>
					<tr>
						<td><img id="dellxps" src="images/dellxps.jpg"  alt="Dell XPS"></td>
						<td>Dell XPS 13</td>
						<td>2015</td>	
						<td>-Intel Core i5-5200U <br>-4 GB DDR3L SDRAM <br>-128 GB SSD</td>
						<td>$820</td>
					</tr>

					<tr>
						<td><img id="hp255" src="images/hp255.jpg"  alt="HP 255" ></td>
						<td>HP 255 G2</td>
						<td>2013</td>
						<td>-AMD A-Series A6-5200<br>-4 GB DDR3L SDRAM <br>-1 TB Hard Disk</td>
						<td>$550</td>
					</tr>

					<tr>
						<td><img id="asus" src="images/asus.jpg" alt="ASUS ZenBook Pro"></td>
						<td>ASUS ZenBook Pro UX501</td>
						<td>Unknown</td>
						<td>-Intel Core i7-4720HQ<br>-16 GB DDR3L SDRAM<br>-512 GB SDD</td>
						<td>$1500</td>
					</tr>

					<tr>
						<td><img id="dellinspiron" src="images/dellinspiron.jpg" alt="BMW 740"</td>
						<td>Dell Inspiron 15 7000</td>
						<td>2015</td>
						<td>-Intel Core i7-5500U<br>-16 GB DDR3L SDRAM<br>-256 GB SSD</td>
						<td>$600</td>
					</tr>

				</table>
			</div>
		</div>  <!-- container ends -->
	</body>
</html>