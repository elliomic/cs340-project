<?php   //updates Plan information in the database
	include 'connectvarsEECS.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn){
		die('Could not connect: ' . mysqli_error());
	}

	//sanitize user input
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	$speed = mysqli_real_escape_string($conn, $_POST['speed']);
	$added_by = mysqli_real_escape_string($conn, $_POST['added_by']);
	$planID = mysqli_real_escape_string($conn, $_POST['planID']);

	$result = mysqli_query($conn, "UPDATE Plan SET name = '" . $name . "', price = " . $price . ", speed = " . $speed . ", added_by = " . $added_by . " WHERE id = " . $planID);
	
	if($result){
		echo 'Update successful';
	}
	else{
		echo 'Update failed';
	}
?>
