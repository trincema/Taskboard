<?php
	include "../db_connection.php";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		session_start();
		$first_name = $_POST['First_Name'];
		$last_name = $_POST['Last_Name'];
		$password = $_POST['Password'];
		$email= $_POST['Email'];
		$skill = $_POST['Skill'];
		$skill_level = $_POST['SkillLevel'];
		$work_hours = $_POST['WorkingHours'];

		$skill_id = 0;
		$skill_level_id = 0;
		$work_hours_id = 0;

		$connection = mysqli_connect($db_hostname, $db_username, $db_password);
		if(!$connection) {
			echo"Database Connection Error...".mysqli_connect_error();
		} else {
			$sql="SELECT * FROM Taskboard.Skills WHERE skill='$skill'";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Error access in table Skills".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 1) {
				while($row = mysqli_fetch_assoc($retval)) {
					$skill_id=$row["id"];
				}
			}
			$sql="SELECT * FROM Taskboard.SkillLevel WHERE skill_level='$skill_level'";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Error access in table SkillLevel".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 1) {
				while($row = mysqli_fetch_assoc($retval)) {
					$skill_level_id=$row["id"];
				}
			}
			$sql="SELECT * FROM Taskboard.WorkingHours WHERE hour='$work_hours'";
			$retval = mysqli_query( $connection, $sql );
			if(! $retval ) {
				echo"Error access in table WorkingHours".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 1) {
				while($row = mysqli_fetch_assoc($retval)) {
					$work_hours_id=$row["id"];
				}
			}
		
			$sql= "SELECT * FROM Taskboard.TeamMembers WHERE email= '$email'";
			$retval= mysqli_query($connection, $sql);
			if(! $retval ) {
				echo"Error access in table TeamMembers".mysqli_error($connection);
			}
			if (mysqli_num_rows($retval) == 0) {
				$sql= "INSERT INTO Taskboard.TeamMembers (first_name,last_name,email,password,skill,skill_level,work_hours) ".
				"VALUES ('$first_name','$last_name','$email','$password',$skill_id,$skill_level_id,$work_hours_id)";
				$retval= mysqli_query($connection, $sql);
				if(!$retval ) {
					echo"Error access in table TeamMembers".mysqli_error($connection);
				} else {
					// Redirect to Login page
					header("location: http://localhost/taskboard/header/login.php");
				}
			} else {
				echo"User already exists";
			}
		}
		mysqli_close($connection);
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
					<span class="input-group-addon">
						<span style="display: inline-block; width:2em;"><i class="fa fa-user"></i></span>
					</span>
					<input type="text" class="form-control" name="First_Name" placeholder="First Name" required="required">
				</div>
			</div>
			<!-- Last name -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width:2em;"><i class="fa fa-user"></i></span>
					</span>
					<input type="text" class="form-control" name="Last_Name" placeholder="Last Name" required="required">
				</div>
			</div>
			<!-- Email address -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width:2em;"><i class="fa fa-envelope"></i></span>
					</span>
					<input type="text" class="form-control" name="Email" placeholder="Email" required="required">
				</div>
			</div>
			<!-- Password -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width:2em;"><i class="fa fa-lock"></i></span>
					</span>
					<input type="password" class="form-control" name="Password" placeholder="Password" required="required">
				</div>
			</div>
			<!-- Confirm Password -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width:2em;"><i class="fa fa-lock"></i></span>
					</span>
					<input type="password" class="form-control" name="Confirm_Password" placeholder="Confirm Password" required="required">
				</div>
			</div>
			<!-- Skill -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 8em; text-align: left;"> <i class="fa fa-cogs"></i> Skill</span>
					</span>
					<select class="form-control" name="Skill">
						<option>C</option>
						<option>C++</option>
						<option>Java</option>
					</select>
				</div>
			</div>
			<!-- Nivel Skill -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 8em; text-align: left;"> <i class="fa fa-arrow-up"></i> Skill Level</span>
					</span>
					<select class="form-control" name="SkillLevel">
						<option>Level 1</option>
						<option>Level 2</option>
						<option>Level 3</option>
						<option>Level 4</option>
						<option>Level 5</option>
						<option>Level 6</option>
						<option>Level 7</option>
						<option>Level 8</option>
						<option>Level 9</option>
						<option>Level 10</option>
					</select>
				</div>
			</div>
			<!-- Working Hours -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 8em; text-align: left;"> <i class="fa fa-clock-o"></i> Working Hours</span>
					</span>
					<select class="form-control" name="WorkingHours">
						<option>4h</option>
						<option>6h</option>
						<option>8h</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary login-btn btn-block">Sign Up</button>
			</div>
		</form>
		<p class="text-center text-muted small">Already have an account? <a href="http://localhost/Taskboard/header/login.php">Sign in here!</a></p>
	</div>
</body>
</html>
