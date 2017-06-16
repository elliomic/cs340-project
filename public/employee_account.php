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
		$result = mysqli_query($conn, "SELECT c.username, c.name, a.num, a.street, a.apt_no, a.city, a.state, a.zip FROM Customer c LEFT JOIN Address a ON c.address_id = a.id WHERE c.id = " . $_SESSION['id']);
		$num_row = mysqli_num_rows($result);
		
		if (!$result) {
			mysqli_free_result($result);
			mysqli_close($conn);
			header('Location: ./login.php?failed');
		}
		
		$userInfo = mysqli_fetch_row($result);

		// Print the name and address
		echo '<h1>Account info for ' . $userInfo[0] . '</h1>';
		echo '<form action="updateaccount.php"  method="post">';
		echo 'Name: <input type="text" name="name" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[1] . '"><br>';
		echo 'Address number: <input type="text" name="num" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[2] . '><br>';
		echo 'Street: <input type="text" name="street" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[3] . '"><br>';
		echo 'Apt. No.: <input type="text" name="apt" autocomplete=off title="3 to 20 characters" value=' . $userInfo[4] . '><br>';
		echo 'City: <input type="text" name="city" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[5] . '"><br>';
		echo 'State: <input type="text" name="state" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[6] . '><br>';
		echo 'Zip: <input type="text" name="zip" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[7] . '><br>';

		echo '<div class="x-flex__content"><input type="submit" name="action" value="Update" class="x-button--solid"></div>';
		echo '</form>';
			
		mysqli_free_result($result);
		
		$result = mysqli_query($conn, "SELECT id, name, cc_type, cc_number, expiration_date FROM Billing_Info WHERE user_id = " . $_SESSION['id']);
		
		$num_row = mysqli_num_rows($result);
		
		echo "<hr>";
		echo "<h1>My Customers</h1>";
		
		echo "<h1><a href='emp_addplan.php'>Add a plan<a></h1>";
		
		
		mysqli_close($conn);
	}
	?>








<?php include '_footer.php' ?>
