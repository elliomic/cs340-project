<?php include '_header.php' ?>
<?php
	error_reporting(E_ALL); ini_set('display_errors', 1);
	include 'connectvarsEECS.php'; 
	if(isset($_SESSION['type']) && isset($_SESSION['user']) && $_SESSION['type'] == 'customer') {
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$conn) {
			die('Could not connect: ' . mysqli_error());

		}
		
		// Get he user's username and address information
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
		echo '<h1>Account info for ' . clean_input($userInfo[0]) . '</h1>';
		echo '<form action="updateaccount.php"  method="post">';
		echo 'Name: <input type="text" name="name" autocomplete=off required pattern=".{3,255}" title="3 to 255 characters" value="' . clean_input($userInfo[1]) . '"><br>';
		echo 'Address number: <input type="text" name="num" autocomplete=off pattern="([0-9])*" required title="Enter a number" value=' . clean_input($userInfo[2]) . '><br>';
		echo 'Street: <input type="text" name="street" autocomplete=off required pattern=".{3,255}" title="3 to 255 characters" value="' . clean_input($userInfo[3]) . '"><br>';
		echo 'Apt. No.: <input type="text" name="apt" autocomplete=off pattern="([0-9])*" title="Enter a number" value=' . clean_input($userInfo[4]) . '><br>';
		echo 'City: <input type="text" name="city" autocomplete=off required pattern=".{3,255}" title="3 to 255 characters" value="' . clean_input($userInfo[5]) . '"><br>';
		echo 'State: <input type="text" name="state" autocomplete=off pattern="([A-Z]){2,2}" required title="2 letters" value=' . clean_input($userInfo[6]) . '><br>';
		echo 'Zip: <input type="text" name="zip" autocomplete=off required pattern="[0-9]{5,5}" title="5 digits" value=' . clean_input($userInfo[7]) . '><br>';

		echo '<div class="x-flex__content"><input type="submit" name="action" value="Update" class="x-button--solid"></div>';
		echo '</form>';
			
		mysqli_free_result($result);
		
		$result = mysqli_query($conn, "SELECT id, name, cc_type, cc_number, expiration_date FROM Billing_Info WHERE user_id = " . $_SESSION['id']);
		
		$num_row = mysqli_num_rows($result);
		
		echo "<hr>";
		echo "<h1>My cards</h1>";
		
		// Print the user's cards
		for($i = 0; $i < $num_row; $i++) {
			$cardInfo = mysqli_fetch_row($result);
			echo '<form action="updatebilling.php" method="post">';
			echo '<input type="hidden" name="id" value="' . clean_input($cardInfo[0]) . '">';
			echo 'Your Name: <input type="text" name="name" autocomplete=off required pattern=".{3,255}" title="3 to 255 characters" value="' . clean_input($cardInfo[1]) . '"><br>';
			echo 'Card Name: <input type="text" name="card" autocomplete=off required pattern=".{3,255}" title="3 to 255 characters" value=' . clean_input($cardInfo[2]) . '><br>';
			echo 'Number: <input type="text" name="number" autocomplete=off required pattern="([0-9]){16,16}" required title="16 digits" value=' . clean_input($cardInfo[3]) . '><br>';
			echo 'Expiration: <input type="date" name="exp" autocomplete=off required value=' . clean_input($cardInfo[4]) . '><br>';
			echo '<div class="x-flex__content"><input type="submit" name="action" value="Update" class="x-button--solid"></div>';
			echo '<div class="x-flex__content"><input type="submit" name="action" value="Delete" class="x-button--solid"></div>';
			echo '</form>';
		}
		
		echo "<hr>";
		echo "<h1>Add a new card</h1>";
		
		// Add a new card
		echo '<form action="addbilling.php" method="post">';
		echo 'Your Name: <input type="text" name="name" pattern=".{3,255}" title="3 to 255 characters" autocomplete=off required><br>';
		echo 'Card Name: <input type="text" name="card" pattern=".{3,255}" title="3 to 255 characters" autocomplete=off required><br>';
		echo 'Number: <input type="text" name="number" pattern="([0-9]){16,16}" required title="16 digits" autocomplete=off required><br>';
		echo 'Expiration: <input type="date" name="exp" autocomplete=off required><br>';
		echo '<div class="x-flex__content"><input type="submit" name="add" value="Add" class="x-button--solid"></div>';
		echo '</form>';
		
		mysqli_free_result($result);
		
		echo '<hr><h1>My plans</h1><br>';
		
		// Gets a list of all of this user's plans
		$query = 'SELECT s.plan_id, s.address_id, s.billing_id, p.name, p.price, p.speed FROM Subscription s LEFT JOIN Plan p ON s.plan_id = p.id WHERE customer_id = ' . $_SESSION['id'];
		$result = mysqli_query($conn, $query);
		$num_row = mysqli_num_rows($result);
		
		if (!$result) {
			mysqli_free_result($result);
			mysqli_close($conn);
			echo 'Error getting subscriptions';
		}

		if($num_row == 0) {
			echo "You have no plans";
		}

		
		// Print out all the plans I am subscribed to
		for($i = 0; $i < $num_row; $i++) {
			$planInfo = mysqli_fetch_row($result);
			// Get address info for this plan
			$query = "SELECT a.num, a.street, a.apt_no, a.city, a.state, a.zip FROM Address a WHERE a.id = " . $planInfo[1];
			$addressResult = mysqli_query($conn, $query);
			$addressInfo = mysqli_fetch_row($addressResult);

			// Get billing info for this plan
			$query = "SELECT cc_type, cc_number FROM Billing_Info WHERE id = " . $planInfo[2];
			$billingResult = mysqli_query($conn, $query);
			$billingInfo = mysqli_fetch_row($billingResult);

			echo '<h2>' . clean_input($planInfo[3]) . '</h2>';
			echo 'Speed: ' . clean_input($planInfo[5]) . '<br>';
			echo 'Price: ' . clean_input($planInfo[4]) . '<br><br>';
			echo clean_input($addressInfo[0]) . ' ' . clean_input($addressInfo[1]);
			if(clean_input($addressInfo[2]) != '') {
				echo '#' . clean_input($addressInfo[2]);
			}
			echo '<br>';
			echo  clean_input($addressInfo[3]) . ', ' .  clean_input($addressInfo[4]) . ', ' .  clean_input($addressInfo[5]);
			echo '<br><br>';
			echo 'Billing: ' . clean_input($billingInfo[0]) . ' ending with ' . clean_input(substr((string)$billingInfo[1], -4));
			echo '<form action="dounsub.php" method="post">';
			echo '<input type="hidden" name="plan" value="' . clean_input($planInfo[0]) . '">';
			echo '<input type="hidden" name="address" value="' . clean_input($planInfo[1]) . '">';
			echo '<div class="x-flex__content"><input type="submit" name="action" value="Unsubscribe" class="x-button--solid"></div>';
			echo '</form>';
		}
			
		mysqli_close($conn);
	}
	?>








<?php include '_footer.php' ?>
