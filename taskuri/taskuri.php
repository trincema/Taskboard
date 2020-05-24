<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="taskuri.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="container" style="padding: 0;">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Taskboard <b>Details</b></h2></div>
                    <div class="col-sm-4">
					<?php
						include "../db_connection.php";
						session_start();
						if (isset($_SESSION['user_id'])) {
							$connection = mysqli_connect($db_hostname, $db_username, $db_password);
							$userId = $_SESSION['user_id'];
							$sql = "SELECT * FROM $database.TeamMembers WHERE id = '$userId'";
							$retval = mysqli_query( $connection, $sql );

							if(! $retval ) {
								echo "Error accessing table TeamMembers0: ".mysqli_error($connection);
							}
							while($row = mysqli_fetch_assoc($retval)) {
								$role= $row["role"];
								if($role == 'Admin')
								echo "<button type=\"button\" class=\"btn btn-info add-new\" data-toggle=\"modal\" data-target=\"#AddTask\"><i class=\"fa fa-plus\"></i> Add Task</button>";
							}
							mysqli_close($connection);
						}
                        
					?>
						</div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
						<th style="width: 3em;">#</th>
                        <th style="width: 10em;">Task Name</th>
                        <th style="width: 4em;">Skill</th>
						<th style="width: 5em;">Level</th>
						<th style="width: 5em;">Duration</th>
						<th style="width: 10em;">Progress</th>
						<th style="width: 10em;">Assigned to</th>
						<th style="width: 6em;">Status</th>
                        <th style="width: 6em;">Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					include "add_task.php";
					include "edit_task.php";
					include "delete_task.php";
					$connection = mysqli_connect($db_hostname, $db_username, $db_password);
					if(!$connection) {
						echo"Database Connection Error...".mysqli_connect_error();
					} else {
						$sql="SELECT * FROM $database.Tasks";
						$retval = mysqli_query( $connection, $sql );
						while($row = mysqli_fetch_assoc($retval)) {
							$id = $row["id"];
							$task_name=$row["task_name"];
							$skill_required_id=$row["skill_required"];
							$level_required_id=$row["level_required"];
							$duration=$row["duration"];
							$task_status_id=$row["task_status"];
							$assigned_member_id=$row["assigned_member"];
							$sql="SELECT * FROM $database.Skills WHERE id=$skill_required_id";
							$retval1 = mysqli_query( $connection, $sql );
							$skill="";
							while($row1= mysqli_fetch_assoc($retval1)){
								$skill=$row1["skill"];
							}
							$sql="SELECT * FROM $database.SkillLevel WHERE id=$level_required_id";
							$retval1 = mysqli_query( $connection, $sql );
							$skill_level="";
							while($row1= mysqli_fetch_assoc($retval1)){
								$skill_level=$row1["skill_level"];
							}
							$sql="SELECT * FROM $database.TeamMembers WHERE id=$assigned_member_id";
							$retval1 = mysqli_query( $connection, $sql );
							$first_name="";
							$last_name="";
							while($row1= mysqli_fetch_assoc($retval1)){
								$first_name=$row1["first_name"];
								$last_name=$row1["last_name"];

							}
							$sql="SELECT * FROM $database.TaskStatus WHERE id=$task_status_id";
							$retval1 = mysqli_query( $connection, $sql );
							$task_status="";
							while($row1= mysqli_fetch_assoc($retval1)){
								$task_status=$row1["task_status"];
							}
							$label="";
							if($task_status == 'Todo')
								$label='danger';
							else if($task_status == 'In progress')
								$label='warning';
							else
								$label='success';
							$progressDisabled = "";
							$progressColor = "secondary";
							if ($task_status == "Done" || $task_status == "Todo") {
								$progressDisabled = "disabled";
								$progressColor = "light";
							}
							$measureUnit = "h";
							$role="";
							if (isset($_SESSION['user_id'])) {
								$userId = $_SESSION['user_id'];
								$sql = "SELECT * FROM $database.TeamMembers WHERE id = '$userId'";
								$retval2 = mysqli_query( $connection, $sql );
								if(! $retval2 ) {
									echo "Error accessing table TeamMembers0: ".mysqli_error($connection);
								}
								while($row = mysqli_fetch_assoc($retval2)) {
									$role= $row["role"];
								}
								}
							if($assigned_member_id == $userId || $role == 'Admin'){
							echo "<tr>".
								"<td>$id</td>".
								"<td><b>$task_name</b></td>".
								"<td>$skill</td>".
								"<td>$skill_level</td>".
								"<td id=\"duration-$id\">$duration$measureUnit</td>".
								"<td>".
									"<div class=\"progress\" style=\"height: 15px;\">".
										"<div class=\"progress-bar\" id=\"progress-$id\"".
											"role=\"progressbar\" aria-valuenow=\"75\" aria-valuemin=\"0\" aria-valuemax=\"100\" ".
											"style=\"width: 0%\">0 %".
										"</div>".
									"</div>";
									if($role == 'Operator')
									echo "<div class=\"btn-group btn-group-toggle btn-group-sm\" role=\"group\" style=\"width:100%; padding-top:5px;\">".
									"<button id=\"start-$id\" type=\"button\" class=\"btn btn-$progressColor\" onclick=\"start($id)\" $progressDisabled>Start</button>".
									"<button id=\"stop-$id\" type=\"button\" class=\"btn btn-$progressColor\" onclick=\"stop($id)\" $progressDisabled>Stop</button>".
									"</div>";
								echo	
								"</td>".
								"<td>$first_name $last_name</td>".
								"<td><span id=\"task-status-$id\" class=\"badge badge-$label\">$task_status</span></td>".
								"<td>".
								"<a class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#EditTask\" ".
									"data-task-id=\"$id\" data-task-name=\"$task_name\" data-skill=\"$skill\" ".
									"data-level=\"$skill_level\" data-duration=\"$duration\" data-first-name=\"$first_name\" ".
									"data-last-name=\"$last_name\" data-status=\"$task_status\"><i class=\"material-icons\">&#xE254;</i></a>";
									if($role == 'Admin')	
										echo "<a class=\"delete\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#DeleteTask\" ".
										"data-task-id=\"$id\" data-task-name=\"$task_name\"><i class=\"material-icons\">&#xE872;</i></a>";
									
							echo 
							"</td>".
							"</tr>" ;
						}
						}

					}
					mysqli_close($connection);
				?>
                </tbody>
            </table>
        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="taskuri.js"></script>
</body>
</html>
