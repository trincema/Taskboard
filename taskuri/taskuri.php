<?php
include "../db_connection.php";
$add_task_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	$task_name = $_POST['TaskName'];
	$skill = $_POST['Skill'];
	$skill_level = $_POST['SkillLevel'];
	$duration = $_POST['Duration'];
	$assigned_to = $_POST['AssignedTo'];
	$status = $_POST['Status'];

	$skill_id = 0;
	$level_id = 0;
	$status_id = 0;

	$connection = mysqli_connect($db_hostname, $db_username, $db_password);
	if(!$connection) {
		echo"Database Connection Error...".mysqli_connect_error();
	} else {
		$sql="SELECT * FROM $database.Skills WHERE skill='$skill'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table Skills".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$skill_id = $row["id"];
			}
		}
		$sql="SELECT * FROM $database.SkillLevel WHERE skill_level='$skill_level'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table SkillLevel".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$level_id = $row["id"];
			}
		}
		$sql="SELECT * FROM $database.TaskStatus WHERE task_status='$status'";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table TaskStatus".mysqli_error($connection);
		}
		if (mysqli_num_rows($retval) == 1) {
			while($row = mysqli_fetch_assoc($retval)) {
				$status_id = $row["id"];
			}
		}

		$sql = "INSERT INTO Taskboard.Tasks(task_name,skill_required,level_required,duration,task_status,assigned_member) ".
				"VALUES('$task_name',$skill_id,$level_id,$duration,$status_id,1)";
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo"Error access in table TeamMembers".mysqli_error($connection);
		}
		mysqli_close($connection);
	}
}
?>
<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="taskuri.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
                        <button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#AddTask"><i class="fa fa-plus"></i> Add Task</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
						<th style="width: 3em;">#</th>
                        <th style="width: 15em;">Task Name</th>
                        <th style="width: 8em;">Required Skill</th>
						<th style="width: 9em;">Required Level</th>
						<th style="width: 5em;">Duration</th>
						<th style="width: 10em;">Assigned to</th>
						<th style="width: 6em;">Status</th>
                        <th style="width: 6em;">Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php
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
							echo "<tr>".
								"<td>$id</td>".
								"<td>$task_name</td>".
								"<td>$skill</td>".
								"<td>$skill_level</td>".
								"<td>$duration</td>".
								"<td>$first_name $last_name</td>".
								"<td><span class=\"badge badge-$label\">$task_status</span></td>".
								"<td>".
								"<a class=\"edit\" title=\"Edit\" data-toggle=\"modal\" data-target=\"#EditTask\" ".
									"data-task-id=\"$id\" data-task-name=\"$task_name\" data-skill=\"$skill\" ".
									"data-level=\"$skill_level\" data-duration=\"$duration\" data-first-name=\"$first_name\" ".
									"data-last-name=\"$last_name\" data-status=\"$task_status\"><i class=\"material-icons\">&#xE254;</i></a>".
								"<a class=\"delete\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#DeleteTask\" ".
									"data-task-id=\"$id\" data-task-name=\"$task_name\"><i class=\"material-icons\">&#xE872;</i></a>".
								"</td>".
								"</tr>" ;
						}

					}
					mysqli_close($connection);
				?>
                </tbody>
            </table>
        </div>
    </div>
	<!-- Add Task Modal -->
<div class="modal fade" id="AddTask" tabindex="-1" role="dialog" aria-labelledby="AddTaskLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddTaskLabel" style="font-size: 20px;">Add Task Dialog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="post" class="TaskForm" action="add_task.php" novalidate>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-list"></i> Task name</span>
					</span>
					<input type="text" class="form-control" name="TaskName" placeholder="Task name" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-cogs"></i> Skill</span>
					</span>
					<select class="form-control" name="Skill">
						<option>C</option>
						<option>C++</option>
						<option>Java</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-arrow-up"></i> Skill Level</span>
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
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-clock-o"></i> Duration</span>
					</span>
					<input type="number" class="form-control" name="Duration" placeholder="Duration" min="0" max="1000" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-user"></i> Assigned To</span>
					</span>
					<select class="form-control" name="AssignedTo">
						<?php
							$connection = mysqli_connect($db_hostname, $db_username, $db_password);
							if(!$connection) {
								echo "Database Connection Error...".mysqli_connect_error();
							} else {
								$sql="SELECT * FROM $database.TeamMembers";
								$retval = mysqli_query( $connection, $sql );
								while($row = mysqli_fetch_assoc($retval)) {
									$first_name=$row["first_name"];
									$last_name=$row["last_name"];
									echo "<option>$first_name $last_name</option>";
								}
								mysqli_close($connection);
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-check"></i> Status</span>
					</span>
					<select class="form-control" name="Status">
						<option>Todo</option>
						<option>In progress</option>
						<option>Done</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success">Add Task</button>
			</div>
		</form>
      </div>
    </div>
  </div>
  </div>

  <!-- Edit Task Modal -->
<div class="modal fade" id="EditTask" tabindex="-1" role="dialog" aria-labelledby="EditTaskLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditTaskLabel" style="font-size: 20px;">Edit Task Dialog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="post" class="TaskForm" action="edit_task.php" novalidate>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-list"></i> Task name</span>
					</span>
					<input type="text" id="edit-task-name" class="form-control" name="EditTaskName" placeholder="Task name" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-cogs"></i> Skill</span>
					</span>
					<select id="edit-skill" class="form-control" name="EditSkill">
						<option>C</option>
						<option>C++</option>
						<option>Java</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-arrow-up"></i> Skill Level</span>
					</span>
					<select id="edit-level" class="form-control" name="EditSkillLevel">
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
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-clock-o"></i> Duration</span>
					</span>
					<input type="number" id="edit-duration" class="form-control" name="EditDuration" placeholder="Duration" min="0" max="1000" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-user"></i> Assigned To</span>
					</span>
					<select id="edit-assigned-to" class="form-control" name="EditAssignedTo">
						<?php
							$connection = mysqli_connect($db_hostname, $db_username, $db_password);
							if(!$connection) {
								echo "Database Connection Error...".mysqli_connect_error();
							} else {
								$sql="SELECT * FROM $database.TeamMembers";
								$retval = mysqli_query( $connection, $sql );
								while($row = mysqli_fetch_assoc($retval)) {
									$first_name=$row["first_name"];
									$last_name=$row["last_name"];
									echo "<option>$first_name $last_name</option>";
								}
								mysqli_close($connection);
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 10em; text-align: left;"> <i class="fa fa-check"></i> Status</span>
					</span>
					<select id="edit-status" class="form-control" name="EditStatus">
						<option>Todo</option>
						<option>In progress</option>
						<option>Done</option>
					</select>
				</div>
			</div>
			<input style="visibility: hidden;" type="number" name="EditTaskId" id="edit-task-id">
			<div class="form-group">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success">Edit Task</button>
			</div>
		</form>
      </div>
    </div>
  </div>
  </div>
  	
	<!-- Delete Task Modal -->
	<div class="modal fade" id="DeleteTask" tabindex="-1" role="dialog" aria-labelledby="DeleteTaskLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="DeleteTaskLabel" style="font-size: 20px;">Delete Task Dialog</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" class="TaskForm" action="delete_task.php" novalidate>
						<span id="task-name"></span>
						<input style="visibility: hidden;" type="number" name="TaskId" id="TaskIdInput">
						<div class="form-group">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-success">Yes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="taskuri.js"></script>
</body>
</html>
