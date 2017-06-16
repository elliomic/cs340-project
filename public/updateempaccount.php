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

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	$query = "UPDATE Employee SET name = '" . $name . "', username = '" . $username . "', pass = '" . $pass . "' WHERE id = " . $_SESSION['id'];
	$result = mysqli_query($conn, $query);

	if (!$result) {
		die("Query to update name failed.");
	}

	mysqli_close($conn);

	header("Location: ./employee_account.php");
?>
	
