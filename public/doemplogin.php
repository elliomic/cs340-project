<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$user = mysqli_real_escape_string($conn, $_POST['user']);
	$password = mysqli_real_escape_string($conn, md5($_POST["password"]));

	//checks if username and password match
	$result = mysqli_query($conn, "SELECT * FROM Employee WHERE username = '" . $user . "' AND pass = '" . $password . "'");
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$num_row = mysqli_num_rows($result);

	//start the session cookie
	if($num_row > 0) {
		session_start();
		$_SESSION['type'] = 'employee';
		$_SESSION['user'] = $user;
		header('Location: ./plans.php');
	} else {
		header('Location: ./login.php?failed');
	}
	

	mysqli_free_result($result);
	mysqli_close($conn);
	?>

