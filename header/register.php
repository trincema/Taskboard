<?php
//verific in teammembers daca email si parola exista
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$username=$_POST['Email'];
	$password=$_POST['password'];
	$sql = "SELECT id FROM Taskboard.TeamMembers WHERE username = '$username' and password = '$password'";
	$connection = mysqli_connect("127.0.0.1:3306", "root", "");
		if(!$connection) {
			echo"Database Connection Error...".mysqli_connect_error();
		} else {
			
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Error access in table TeamMembers".mysqli_error($connection);
			}
		
			$count = mysqli_num_rows($retval);
			echo "$count";
			if($count == 1) {
				header("location: http://localhost/Taskboard");
			 }
		
		}
}

?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="register.css">
	<script type="text/javascript" src="register.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
	<div class="signup-form">
		<form method="post" action="">
		<h2 class="text-center">Sign Up</h2>
			<!-- First name -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="text" class="form-control" name="First_Name" placeholder="First Name" required="required">
				</div>
			</div>
			<!-- Last name -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="text" class="form-control" name="Last_Name" placeholder="Last Name" required="required">
				</div>
			</div>
			<!-- Username -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="text" class="form-control" name="Username" placeholder="Username" required="required">
				</div>
			</div>
			<!-- Email address -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="text" class="form-control" name="Email" placeholder="Email" required="required">
				</div>
			</div>
			<!-- Password -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
					<input type="password" class="form-control" name="Password" placeholder="Password" required="required">
				</div>
			</div>
			<!-- Confirm Password -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-lock"></i>
					</span>
					<input type="password" class="form-control" name="Confirm_Password" placeholder="Confirm Password" required="required">
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary login-btn btn-block">Sign in</button>
			</div>
		</form>
		<p class="text-center text-muted small">Already have an account? <a href="http://localhost/Taskboard/header/login.php">Sign in here!</a></p>
	</div>
</body>
</html>
