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
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	
	$result = mysqli_query($conn, "UPDATE Customer SET name = '" . $name . "' WHERE id = " . $_SESSION['id']);

	if (!$result) {
		die("Query to show fields from table failed");
	}
	// $num_row = mysqli_num_rows($result);

	mysqli_free_result($result);
	mysqli_close($conn);

	header('Location: ./account.php');
	exit();
	
	?>

