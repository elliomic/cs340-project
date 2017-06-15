<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	session_start();
	//
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	//
	$plan = mysqli_real_escape_string($conn, $_POST['plan']);
	$card = mysqli_real_escape_string($conn, $_POST['card']);	
	$user = mysqli_real_escape_string($conn, $_SESSION['user']);
	$id = mysqli_real_escape_string($conn, $_SESSION['id']);	
	$num = mysqli_real_escape_string($conn, $_POST['num']);
	$street = mysqli_real_escape_string($conn, $_POST['street']);
	//
	$apt = 'NULL';
	if($_POST['apt'] != '') {
		$apt = mysqli_real_escape_string($conn, $_POST['apt']);
	}
	//
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$zip = mysqli_real_escape_string($conn, $_POST['zip']);
	//
	// Get the address id of this customer
	$query = "SELECT address_id FROM Customer WHERE id = " . $_SESSION['id'];
	$result = mysqli_query($conn, $query);
	$customerRow = mysqli_fetch_row($result);
	$addressId = $customerRow[0];
	//
	// Check that there isn't already a subscriber at that address.
	$query = "SELECT plan_id, address_id FROM Subscription WHERE plan_id = " . $plan . " AND address_id = " . $addressId;
	//echo $query;
	$result = mysqli_query($conn, $query);
	//
	$num_row = mysqli_num_rows($result);
	if($num_row == 0) {
		$query = "INSERT INTO Subscription (plan_id, address_id, billing_id, customer_id)" .
		" VALUES (" . $plan . ", " . $addressId . ", " . $card . ", " . $_SESSION['id'] . ")";
		mysqli_query($conn, $query);
		echo "ZERO ROWS";
		header("Location: account.php");
	} else {
		header("Location: subscribefailed.php");
	}

	mysqli_close($conn);
	?>

