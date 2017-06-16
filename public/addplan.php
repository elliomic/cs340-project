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

	$query = "INSERT INTO plans (name, cost, speed) VALUES ('" . $plan_name . "', " . $plan_speed . ", " . $plan_cost . " )";
		



	
	mysqli_close($conn);
	?>
