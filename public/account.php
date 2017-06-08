<?php include '_header.php' ?>
<?php
	error_reporting(E_ALL); ini_set('display_errors', 1);
	include 'connectvarsEECS.php'; 
	if(isset($_SESSION['type']) && isset($_SESSION['user']) && $_SESSION['type'] == 'customer') {
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
		
		//for($i = 0; $i < 9; $i++) {
		//	echo $userInfo[$i] . '<br>';
		//}
		
		echo 'Account info for ' . $userInfo[0] . '<br><br>';
		echo '<form action="updateaccount.php"  method="post">';
		echo 'Name: <input type="text" name="name" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[1] . '><br><br>';
		echo 'Number: <input type="text" name="num" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[2] . '><br>';
		echo 'Street: <input type="text" name="street" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[3] . '><br>';
		echo 'Apt. No.: <input type="text" name="apt" autocomplete=off title="3 to 20 characters" value=' . $userInfo[4] . '><br>';
		echo 'City: <input type="text" name="city" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[5] . '><br>';
		echo 'State: <input type="text" name="state" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[6] . '><br>';
		echo 'Zip: <input type="text" name="zip" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[7] . '><br>';

		echo '<input type="submit" name="action" value="Update">';
		echo '</form>';
			
		mysqli_free_result($result);
		
		$result = mysqli_query($conn, "SELECT id, name, cc_type, cc_number, expiration_date FROM Billing_Info WHERE user_id = " . $_SESSION['id']);
		
		$num_row = mysqli_num_rows($result);
		
		for($i = 0; $i < $num_row; $i++) {
			$cardInfo = mysqli_fetch_row($result);
			echo '<form action="updatebilling.php" method="post">';
			echo 'Name: <input type="text" name="name" autocomplete=off required value=' . $cardInfo[1] . '><br>';
			echo 'Card: <input type="text" name="card" autocomplete=off required value=' . $cardInfo[2] . '><br>';
			echo 'Number: <input type="text" name="number" autocomplete=off required value=' . $cardInfo[3] . '><br>';
			echo 'Expiration: <input type="text" name="exp" autocomplete=off required value=' . $cardInfo[4] . '><br>';
			echo '<input type="submit" name="update" value="Update">';
			echo '<input type="submit" name="delete" value="Delete">';
			echo '</form>';
		}
		
		echo "<hr>";	
		
		echo '<form action="addbilling.php" method="post">';
		echo 'Name: <input type="text" name="name" autocomplete=off required><br>';
		echo 'Card: <input type="text" name="card" autocomplete=off required><br>';
		echo 'Number: <input type="text" name="number" autocomplete=off required><br>';
		echo 'Expiration: <input type="date" name="exp" autocomplete=off required><br>';
		echo '<input type="submit" name="add" value="Add">';
		echo '</form>';
		
		
		mysqli_close($conn);
	} else {
		header('Location: ./login.php?failed');
	}
	?>








<?php include '_footer.php' ?>
