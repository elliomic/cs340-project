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
	$cardId = mysqli_real_escape_string($conn, $_POST['id']);
	$action = mysqli_real_escape_string($conn, $_POST['action']);
	
	// There are two buttons the user can click from the accounts page: update and delete
	// Check which one they pressed and do the appropriate action
	if($action == 'Update') {
		$query = "UPDATE Billing_Info SET name = '" . $name . "', cc_type = '" . $card . "', cc_number = " . $number . ", expiration_date = '" . $exp . "' WHERE id = " . $cardId;
		$result = mysqli_query($conn, $query);
		
		if (!$result) {
			die("Query to update card failed");
		}

	} else if($action == 'Delete') {
		$query = "DELETE FROM Billing_Info WHERE id = " . $cardId;
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to delete card failed");
		}
	}
	
	
	mysqli_close($conn);

	?>

