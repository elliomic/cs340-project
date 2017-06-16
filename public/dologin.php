<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	$emp = 	mysqli_real_escape_string($conn, $_POST['employee']);
	$user = mysqli_real_escape_string($conn, $_POST['user']);
	$password = mysqli_real_escape_string($conn, md5($_POST["password"]));

	if ($emp == TRUE){
	//do employee login
			$result = mysqli_query($conn, "SELECT * FROM Employee WHERE username = '" . $user . "' AND pass = '" . $password . "'");
		if (!$result) {
			die("Query to show fields from table failed");
		}
		$num_row = mysqli_num_rows($result);

		//start session cookie
		if($num_row > 0) {
			session_start();
			$_SESSION['type'] = 'employee';
			$_SESSION['user'] = $user;
			$row = mysqli_fetch_row($result);
			$_SESSION['id'] = $row[0];
			header('Location: ./employee_account.php');
		} else {
			header('Location: ./login.php?failed');
		}
	}
	else{
	//do customer login	
		$result = mysqli_query($conn, "SELECT * FROM Customer WHERE username = '" . $user . "' AND pass = '" . $password . "'");
		if (!$result) {
			die("Query to show fields from table failed");
		}
		$num_row = mysqli_num_rows($result);

		if($num_row > 0) {
			session_start();
			$_SESSION['type'] = 'customer';
			$_SESSION['user'] = $user;
			$row = mysqli_fetch_row($result);
			$_SESSION['id'] = $row[0];
			header('Location: ./account.php');
		} else {
			header('Location: ./login.php?failed');
		}
	}

	mysqli_free_result($result);
	mysqli_close($conn);
	?>

