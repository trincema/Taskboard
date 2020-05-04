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
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add Task</button>
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
                    <tr>
                        <td>1</td>
                        <td>Implement login form</td>
						<td>PHP</td>
						<td>Level 7</td>
						<td>20</td>
						<td>Popescu Ion</td>
						<td><span class="label label-danger">To do</span></td>
                        <td>
							<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Implement login form</td>
						<td>C++</td>
						<td>Level 7</td>
						<td>20</td>
						<td>Popescu Ion</td>
						<td><span class="label label-warning">In progress</span></td>
                        <td>
							<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
					</tr>
					<tr>
                        <td>3</td>
                        <td>Implement login form</td>
						<td>Java</td>
						<td>Level 7</td>
						<td>20</td>
						<td>Popescu Ion</td>
						<td><span class="label label-success">Done</span></td>
                        <td>
							<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
					</tr>
					<tr>
                        <td>1</td>
                        <td>Implement login form</td>
						<td>PHP</td>
						<td>Level 7</td>
						<td>20</td>
						<td>Popescu Ion</td>
						<td><span class="label label-danger">To do</span></td>
                        <td>
							<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Implement login form</td>
						<td>C++</td>
						<td>Level 7</td>
						<td>20</td>
						<td>Popescu Ion</td>
						<td><span class="label label-warning">In progress</span></td>
                        <td>
							<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
					</tr>
					<tr>
                        <td>3</td>
                        <td>Implement login form</td>
						<td>Java</td>
						<td>Level 7</td>
						<td>20</td>
						<td>Popescu Ion</td>
						<td><span class="label label-success">Done</span></td>
                        <td>
							<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
