<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$plan_name = mysqli_real_escape_string($conn, $_POST['plan_name']);
	$plan_speed = mysqli_real_escape_string($conn,$_POST['plan_speed']);
	$plan_cost = mysqli_real_escape_string($conn,$_POST['plan_cost']);

	mysqli_query($conn,"INSERT INTO Plan (name, price, speed) VALUES ('" . $plan_name . "', " . $plan_cost . ", " . $plan_speed . " )");
	header('Location: ./employee_account.php');



	
	mysqli_close($conn);
	?>
