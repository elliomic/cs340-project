<?php header('Location: ./account.php'); ?>
<?php
	include 'connectvarsEECS.php'; 
	session_start();
	error_reporting(E_ALL); ini_set('display_errors', 1);
	

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$user = mysqli_real_escape_string($conn, $_SESSION['user']);
	$id = mysqli_real_escape_string($conn, $_SESSION['id']);
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$card = mysqli_real_escape_string($conn, $_POST['card']);
	$number = mysqli_real_escape_string($conn, $_POST['number']);
	$exp = mysqli_real_escape_string($conn, $_POST['exp']);
	
	// Inserts new billing information
	$query = "INSERT INTO Billing_Info (name, cc_type, cc_number, expiration_date, user_id) VALUES ('" . $name . "', '" . $card . "', " . $number . ", '" . $exp . "', " . $id . " )";
	
	$result = mysqli_query($conn, $query);

	if (!$result) {
		die("Query to update name failed.");
	}
	
	mysqli_close($conn);

	?>

