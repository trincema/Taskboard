<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$email= $_POST['email'];
	$skill=$_POST['skill'];
	$skill_level=$_POST['skill_level'];
	$work_hours=$_POST['work_hours'];

	$sql = "SELECT id FROM Taskboard.TeamMembers WHERE username = '$username' and password = '$password' and email='$email' and
			skill='$skill' and skill_level='$skill_level' and work_hours='$work_hours'";

	$sql= "INSERT INTO $database.TeamMembers (first_name,last_name,username,email,password,skill,skill_level,work_hours) 
			VALUES ('Popescu','Maria','maria','mariamaria','123','C++','Level 6','4h')";

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
			<!-- Skill -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-lock"></i>
					</span>
					<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" style="width: 100%;" type="button" id="dropdownMenu1"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<span id="skill">C</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a onclick="onSkillChanged('C');">C</a></li>
						<li><a onclick="onSkillChanged('C++');">C++</a></li>
						<li><a onclick="onSkillChanged('Java');">Java</a></li>
					</ul>
					</div>
				</div>
			</div>
			<!-- Nivel Skill -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-lock"></i>
					</span>
					<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" style="width: 100%;" type="button" id="dropdownMenu2"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<span id="skill_level">Level 1</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
						<li><a onclick="onSkillLevelChanged(1);">Level 1</a></li>
						<li><a onclick="onSkillLevelChanged(2);">Level 2</a></li>
						<li><a onclick="onSkillLevelChanged(3);">Level 3</a></li>
						<li><a onclick="onSkillLevelChanged(4);">Level 4</a></li>
						<li><a onclick="onSkillLevelChanged(5);">Level 5</a></li>
						<li><a onclick="onSkillLevelChanged(6);">Level 6</a></li>
						<li><a onclick="onSkillLevelChanged(7);">Level 7</a></li>
						<li><a onclick="onSkillLevelChanged(8);">Level 8</a></li>
						<li><a onclick="onSkillLevelChanged(9);">Level 9</a></li>
						<li><a onclick="onSkillLevelChanged(10);">Level 10</a></li>
					</ul>
					</div>
				</div>
			</div>
			<!-- Working Hours -->
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-lock"></i>
					</span>
					<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" style="width: 100%;" type="button" id="dropdownMenu3"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<span id="working_hours">8h/day</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
						<li><a onclick="onWorkingHoursChanged(4);">4h/day</a></li>
						<li><a onclick="onWorkingHoursChanged(6);">6h/day</a></li>
						<li><a onclick="onWorkingHoursChanged(8);">8h/day</a></li>
					</ul>
					</div>
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
