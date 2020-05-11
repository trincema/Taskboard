<?php
include "../db_connection.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['TaskId'];
    $sql="DELETE FROM $database.Tasks WHERE id='$id'";
	$connection = mysqli_connect($db_hostname, $db_username, $db_password);
	if(!$connection) {
		echo "Database Connection Error...".mysqli_connect_error();
	} else {
		$retval = mysqli_query( $connection, $sql );
		if(! $retval ) {
			echo "Error access in table Skills".mysqli_error($connection);
		}
        mysqli_close($connection);
	}
}
?>