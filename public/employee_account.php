<?php include '_header.php' ?>
<?php
	error_reporting(E_ALL); ini_set('display_errors', 1);
	include 'connectvarsEECS.php'; 
	if(isset($_SESSION['type']) && isset($_SESSION['user']) && $_SESSION['type'] == 'employee') {
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$conn) {
			die('Could not connect: ' . mysqli_error());

		}
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$result = mysqli_query($conn, "SELECT username, name, pass FROM Employee WHERE id = " . $_SESSION['id']);
		$num_row = mysqli_num_rows($result);
		
		if (!$result) {
			mysqli_free_result($result);
			mysqli_close($conn);
			header('Location: ./login.php?failed');
		}
		
		$userInfo = mysqli_fetch_row($result);

		// Print the name and address
		echo '<h1>Account info for ' . $userInfo[0] . '</h1>';
		
		echo '<form action="updateempaccount.php"  method="post">';
		echo 'ID: <input type="text" name="id" autocomplete=off required title="3 to 20 characters" value="' . $_SESSION['id'] . '" disabled><br>';
		echo 'Name: <input type="text" name="name" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[1] . '"><br>';
		echo 'Username: <input type="text" name="username" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[0] . '"><br>';
		echo 'Password: <input type="password" name="pass" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[2] . '"><br>';
		echo 'Branch: <input type="text" name="street" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[2] % 2 . '" disabled><br>';


		echo '<div class="x-flex__content"><input type="submit" name="action" value="Update" class="x-button--solid"></div>';
		echo '</form>';
			
		mysqli_free_result($result);
		
		$result = mysqli_query($conn, "SELECT id, name, cc_type, cc_number, expiration_date FROM Billing_Info WHERE user_id = " . $_SESSION['id']);
		
		$num_row = mysqli_num_rows($result);
		
		echo "<hr>";

		
		echo "<h1><a href='emp_addplan.php'>Add a plan<a></h1>";
		
		
		mysqli_close($conn);
	}
	?>








<?php include '_footer.php' ?>
