<?php include '_header.php' ?>
<?php
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
		}
		
		$userInfo = mysqli_fetch_row($result);
		
		$planId = mysqli_real_escape_string($conn, $_GET['plan']);
		
		$result = mysqli_query($conn, 'SELECT name, price, speed FROM Plan WHERE id = ' . $planId);
		
		if($result) {
			$planInfo = mysqli_fetch_row($result);
			$planName = $planInfo[0];
			$planPrice = $planInfo[1];
			$planSpeed = $planInfo[2];
			
			echo '<h1>Subscribe to ' . $planName . '</h1>';
		}
		
		echo '<form action="dosubscribe.php"  method="post">';
		echo '<br>Address to subscribe at:<br><br>';
		echo 'Number: <input type="text" name="num" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[2] . '><br>';
		echo 'Street: <input type="text" name="street" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[3] . '"><br>';
		echo 'Apt. No.: <input type="text" name="apt" autocomplete=off title="3 to 20 characters" value=' . $userInfo[4] . '><br>';
		echo 'City: <input type="text" name="city" autocomplete=off required title="3 to 20 characters" value="' . $userInfo[5] . '"><br>';
		echo 'State: <input type="text" name="state" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[6] . '><br>';
		echo 'Zip: <input type="text" name="zip" autocomplete=off required title="3 to 20 characters" value=' . $userInfo[7] . '><br>';
		
		// Get billing info
		$result = mysqli_query($conn, "SELECT id, name, cc_type, cc_number, expiration_date FROM Billing_Info WHERE user_id = " . $_SESSION['id']);
		$num_cards = mysqli_num_rows($result);
		
		echo 'Payment:';
		if($num_cards > 0) {
			echo '<select name="card">';
			
			for($i = 0; $i < $num_cards; $i++) {
				$thisCard = mysqli_fetch_row($result);
				echo '<option value = "' . $thisCard[0] . '">' . $thisCard[2] . ' ending in ' . substr((string)$thisCard[3], -4) . '</option>';
			}
			
			echo '<input type="submit" name="action" value="Subscribe">';			
			echo '</select>';
		} else {
			echo 'Please add a card before subscribing to a plan.';
		}		
		
		echo '</form>';
			
		mysqli_free_result($result);
		
		mysqli_close($conn);
	}


?>








<?php include '_footer.php' ?>
