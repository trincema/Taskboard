<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="taskuri.css">
	<script type="text/javascript" src="taskuri.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                        <th style="width: 5em;">Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					include "../db_connection.php";
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
								"<td><span class=\"label label-$label\">$task_status</span></td>".
								"<td>".
								"<a class=\"edit\" title=\"Edit\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE254;</i></a>".
								"<a class=\"delete\" title=\"Delete\" data-toggle=\"tooltip\"><i class=\"material-icons\">&#xE872;</i></a>".
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
	<!-- Modal -->
<div class="modal fade" id="AddTask" tabindex="-1" role="dialog" aria-labelledby="AddTaskLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddTaskLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="post" class="needs-validation" action="" novalidate>
		<h2 class="text-center">Sign in</h2>   
			<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control" name="TaskName" placeholder="Taks name"
						 required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				Please enter a proper email address!
      				</div>
				</div>
			</div>
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
			<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control" name="TaskName" placeholder="Taks name"
						 required>
					<div class="valid-feedback">
        				Looks good!
      				</div>
					<div class="invalid-feedback">
        				Please enter a proper email address!
      				</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">
						<span style="display: inline-block; width: 8em; text-align: left;"> <i class="fa fa-arrow-up"></i> Assigned To</span>
					</span>
					<select class="form-control" name="AssignedTo">
						<?php
							include "../db_connection.php";
							$connection = mysqli_connect($db_hostname, $db_username, $db_password);
							if(!$connection) {
								echo"Database Connection Error...".mysqli_connect_error();
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
						<span style="display: inline-block; width: 8em; text-align: left;"> <i class="fa fa-arrow-up"></i> Skill Level</span>
					</span>
					<select class="form-control" name="SkillLevel">
						<option>Todo</option>
						<option>In progress</option>
						<option>Done</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary login-btn btn-block">Add Task</button>
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
