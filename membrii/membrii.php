<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="membrii.css">
	<script type="text/javascript" src="membrii.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body style="weight: lightgrey;">
	<div class="container mt-5">
	<div class="row">
        <div class="col-sm-8"><h4>Team Members</h4></div>
        </div>
		<div class="row">
			<div class="col-lg-4">
				<ul class="list-group">
					<?php
						include "../db_connection.php";
						$connection = mysqli_connect($db_hostname, $db_username, $db_password);
						if(!$connection) {
							echo "Database Connection Error...".mysqli_connect_error();
						} else {
							$sql="SELECT * FROM $database.TeamMembers";
							$retval = mysqli_query( $connection, $sql );
							while($row = mysqli_fetch_assoc($retval)) {
								$first_name = $row["first_name"];
								$last_name = $row["last_name"];
								$work_hours = $row["work_hours"];
								$skill_id = $row["skill"];
								$skill_level_id = $row["skill_level"];

								$sql="SELECT * FROM $database.Skills WHERE id=$skill_id";
								$retval1 = mysqli_query( $connection, $sql );
								$skill = "";
								while($row1 = mysqli_fetch_assoc($retval1)){
									$skill = $row1["skill"];
								}

								$sql = "SELECT * FROM $database.SkillLevel WHERE id=$skill_level_id";
								$retval1 = mysqli_query( $connection, $sql );
								$skill_level="";
								while($row1 = mysqli_fetch_assoc($retval1)){
									$skill_level = $row1["skill_level"];
								}

								$sql = "SELECT * FROM $database.WorkingHours WHERE id=$work_hours";
								$retval1 = mysqli_query( $connection, $sql );
								$hours = "";
								while($row1 = mysqli_fetch_assoc($retval1)){
									$hours = $row1["hour"];
								}

								echo "<li class=\"list-group-item list-group-item-action\">".
										 "<div class=\"d-flex w-100 justify-content-between\">".
										 	"<h5 class=\"mb-1\">$first_name $last_name</h5>".
											 "<small><i>$hours</i></small>".
										"</div>".
										"<small><i><b>Skill:</b> $skill</i></small>".
										"<small class=\"text-muted\"> <i>($skill_level)</i></small>".
									"</li>";
							}
							mysqli_close($connection);
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
