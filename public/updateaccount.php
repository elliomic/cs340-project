<?php session_start() ?>

<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$user = mysqli_real_escape_string($conn, $_POST['user']);
	$id = mysqli_real_escape_string($conn, $_SESSION['id']);
	
	$num = mysqli_real_escape_string($conn, $_SESSION['num']);
	$street = mysqli_real_escape_string($conn, $_SESSION['street']);
	$apt = mysqli_real_escape_string($conn, $_SESSION['apt']);
	$city = mysqli_real_escape_string($conn, $_SESSION['city']);
	$state = mysqli_real_escape_string($conn, $_SESSION['state']);
	$zip = mysqli_real_escape_string($conn, $_SESSION['zip']);
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	
	$result = mysqli_query($conn, "UPDATE Customer SET name = '" . $name . "' WHERE id = " . $_SESSION['id']);

	if (!$result) {
		die("Query to update name failed.");
	}
	// $num_row = mysqli_num_rows($result);
	
	// Get the address id of the customer
	$result = mysqli_query($conn, "SELECT address_id FROM Customer WHERE id = " . $_SESSION['id']);
	$userInfo = mysqli_fetch_row($result);
	$addressId = $userInfo[0];
	
	$result = mysqli_query($conn, "UPDATE A"

	mysqli_free_result($result);
	mysqli_close($conn);

	header('Location: ./account.php');
	exit();
	
	?>

