<?php header("Location: account.php"); ?>
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
	$address = mysqli_real_escape_string($conn, $_POST['address']);	
	$user = mysqli_real_escape_string($conn, $_SESSION['user']);
	$id = mysqli_real_escape_string($conn, $_SESSION['id']);
	
	$query = "DELETE FROM Subscription WHERE plan_id = " . $plan . " AND address_id = " . $address;
	mysqli_query($conn, $query);

	mysqli_close($conn);
	?>

