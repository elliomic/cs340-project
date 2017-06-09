<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$plan = mysqli_real_escape_string($conn, $_POST['plan']);
	$card = mysqli_real_escape_string($conn, $_POST['card']);	
	$user = mysqli_real_escape_string($conn, $_SESSION['user']);
	$id = mysqli_real_escape_string($conn, $_SESSION['id']);	
	$num = mysqli_real_escape_string($conn, $_POST['num']);
	$street = mysqli_real_escape_string($conn, $_POST['street']);
	
	$apt = 'NULL';
	if($_POST['apt'] != '') {
		$apt = mysqli_real_escape_string($conn, $_POST['apt']);
	}
	
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$zip = mysqli_real_escape_string($conn, $_POST['zip']);
	
	$query = "SELECT id FROM Address WHERE num = " . $num . ' AND street = "' . $street . '" AND (' . $apt . ' IS NULL OR apt_no = ' . $apt . ') AND city = "' . $city . '" AND state = "' . $state . '" AND zip = ' . $zip;
	$result = mysqli_query($conn, $result);
	$num_row = mysqli_num_rows($result);
	if($num_rows == 0) {
		
	} else {
		
	}
	
	// $query = "INSERT INTO Subscription (plan_id, address_id, billing_id, customer_id) VALUES " 
	
	$result = mysqli_query($conn, "INSERT INTO Subscription (plan_id, address_id, billing_id, customer_id)" .
	" VALUES (" . $plan . ", 1, 
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$num_row = mysqli_num_rows($result);

	if($num_row > 0) {
		session_start();
		$_SESSION['type'] = 'customer';
		$_SESSION['user'] = $user;
		$_SESSION['id'] = $result[0][0];
		header('Location: ./plans.php');
	} else {
		header('Location: ./login.php?failed');
	}
	

	mysqli_free_result($result);
	mysqli_close($conn);
	?>

