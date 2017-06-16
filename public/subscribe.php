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
		// Get the information about the plan they want to subscribe to 
		$result = mysqli_query($conn, 'SELECT name, price, speed FROM Plan WHERE id = ' . $planId);
		
		if($result) {
			$planInfo = mysqli_fetch_row($result);
			$planName = $planInfo[0];
			$planPrice = $planInfo[1];
			$planSpeed = $planInfo[2];
			
			echo '<h1>Subscribe to ' . clean_input($planName) . '</h1>';
		}
		
		echo '<form action="dosubscribe.php"  method="post">';
		echo '<input type="hidden" name="plan" value="' . clean_input($planId) . '">';
		echo '<br>Address to subscribe at:<br><br>';
		
		// Number and street of addres
		echo clean_input($userInfo[2]) . ' ' . clean_input($userInfo[3]);
		// Print the apartment number, if there is one
		if(clean_input($userInfo[4]) != '') {
			echo '#' . clean_input($addressInfo[2]);
		}
		echo '<br>';
		// City, State, Zip
		echo  clean_input($userInfo[5]) . ', ' .  clean_input($userInfo[6]) . ', ' .  clean_input($userInfo[7]);
		echo '<br><br>';
		
		// Get billing info
		$result = mysqli_query($conn, "SELECT id, name, cc_type, cc_number, expiration_date FROM Billing_Info WHERE user_id = " . $_SESSION['id']);
		$num_cards = mysqli_num_rows($result);
		
		// Make a dropdown list with all of the customer's cards they have on file.
		// If they have no cards, then print an error and a link back to their account page
		// so they can enter a new card
		echo 'Payment:';
		if($num_cards > 0) {
			echo '<select name="card">';
			
			for($i = 0; $i < $num_cards; $i++) {
				$thisCard = mysqli_fetch_row($result);
				echo '<option value = "' . clean_input($thisCard[0]) . '">' . clean_input($thisCard[2]) . ' ending in ' . substr((string)clean_input($thisCard[3]), -4) . '</option>';
			}
			echo '</select>';			
			echo '<div class="x-flex__content"><input type="submit" name="action" value="Subscribe" class="x-button--solid"></div>';

		} else {
			echo 'Please <a href="account.php">add a card</a> before subscribing to a plan.';
		}		
		
		echo '</form>';
			
		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>
<?php include '_footer.php' ?>
