<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$user = mysqli_real_escape_string($_POST["username"]);
	$password = mysqli_real_escape_string(md5($_POST["password"]));

	$result = mysqli_query($conn, "SELECT * FROM Customer WHERE username = '" . $user . "' AND pass = '" . $password . "'");
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$num_row = mysqli_num_rows($result);

	if($num_row > 0) {
		session_start();
		$_SESSION['type'] = 'cutsomer';
		$_SESSION['user'] = $user;
	}
	
	header('Location: /');

	mysqli_free_result($result);
	mysqli_close($conn);
	?>

