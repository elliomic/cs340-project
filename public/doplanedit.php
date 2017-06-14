<?php
	include 'connectvarsEECS.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn){
		die('Could not connect: ' . mysqli_error());
	}

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	$speed = mysqli_real_escape_string($conn, $_POST['speed']);
	$added_by = mysqli_real_escape_string($conn, $_POST['added_by']);
	$planID = mysqli_real_escape_string($conn, $_POST['planID']);

	echo $name.'<br>';
	echo $price.'<br>';
	echo $speed.'<br>';
	echo $added_by.'<br>';
	echo $planID.'<br>';

	$result = mysqli_query($conn, 'UPDATE Plan SET name=' . $name . ', price=' . $price . ', speed=' . $speed . ', added_by=' . $added_by . ' WHERE id=' . $planID);
	
	$rows = mysqli_affected_rows($result);
	if($rows=1){
		echo 'Update successful';
	}
	else{
		echo 'Update failed';
	}
?>
