<?php
	include 'connectvarsEECS.php';
	session_start();
	error_reporting(E_ALL); ini_set('display_errors', 1);	
	//
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	//
	$user = mysqli_real_escape_string($conn, $_SESSION['user']);
	$id = mysqli_real_escape_string($conn, $_SESSION['id']);
	//
	$num = mysqli_real_escape_string($conn, $_POST['num']);
	$street = mysqli_real_escape_string($conn, $_POST['street']);
	$apt = 'NULL';
	if($_POST['apt'] != '') {
		$apt = mysqli_real_escape_string($conn, $_POST['apt']);
	}
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$zip = mysqli_real_escape_string($conn, $_POST['zip']);
	//
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	//
	$query = "CALL CheckValidState ('" . $state . "')";
	$result = mysqli_query($conn, $query);
	//
	// sql state 4500 means CheckValidState failed (the user did not enter a valid 2 character state code)
	if($conn->sqlstate == 45000) {
		header('Location: ./badstate.php');
	} else {
		header('Location: ./account.php');
		//
		// Update the customer's name
		if($_POST['name'] != '') {
			$query = "UPDATE Customer SET name = '" . $name . "' WHERE id = " . $_SESSION['id'];
			$result = mysqli_query($conn, $query);
		}
		//
		if (!$result) {
			die("Query to update name failed.");
		}
		//
		// Update the customer's address
		$query = "CALL UpdateAddressCustomer (" . $id . ", " . $num . ", '" . $street . "', " . $apt . ", '" . $city . "', '" . $state . "', " . $zip . ")";
		$result = mysqli_query($conn, $query);
		//
	}

	mysqli_close($conn);
	?>
	