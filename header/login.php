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
<html>
<head>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script type="text/javascript" src="login.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
</head>
<body>
    <form method="post" action="">
        <div class="login-box">
            <div class="textbox">
                  <h1>Log in</h1>  
				<input type="text" name="Email" placeholder="Email"/><br /><br />
				<input type="password" name="password" placeholder="Password" /><br /><br />
				<input type="submit"  value="Submit"> <br><br>
				<div id="container"><br>
			<a href="reset.html" style=" margin-right:0px; font-size:13px; font-family:Tahoma, Geneva, sans-serif;">Reset password?</a> 
    		<a href="forgot.html" style=" margin-left:30px; font-size:13px; font-family:Tahoma, Geneva, sans-serif;">Forget password</a> 
    		</div><br /><br>
			Don't have account?<a href="signup.html" style="font-family:'Play', sans-serif;">&nbsp;Sign Up</a>
		</div>
	</form>

</body>
</html>
