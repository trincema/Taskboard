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
<html>
<head>
	<link rel="stylesheet" type="text/css" href="register.css">
	<script type="text/javascript" src="register.js"></script>
</head>
<body>
	<h3>Register page</h3>
	<!-- Codul pentru pagina de register. -->
</body>
</html>
