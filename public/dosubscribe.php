<?php session_start(); ?>
<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$plan = mysqli_real_escape_string($conn, $_POST['plan']);
	$billing = mysqli_real_escape_string($conn, $_POST['billing']);
	
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

