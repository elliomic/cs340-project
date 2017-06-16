<?php include '_header.php' ?>
<?php
	error_reporting(E_ALL); ini_set('display_errors', 1);

	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$user = "";
	$loggedIn = False;

	// See if the user is logged in
	if(isset($_SESSION['type']) && isset($_SESSION['user']) && $_SESSION['type'] == 'customer') {
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$loggedIn = True;
	}

	// If the user is logged in, then run a query that checks if each plan is available at that users address.
	// If they aren't logged in, then just get all plans
	$query = "";
	if(isset($_SESSION['id'])) {
		$query = "SELECT p.name, p.price, p.speed, c.id, p.id FROM Plan p LEFT JOIN Customer c ON c.address_id IN (SELECT address_id FROM Address_Plans WHERE plan_id = p.id) AND c.id = " . $_SESSION['id'];
	} else {	
		$query = "SELECT p.name, p.price, p.speed, NULL, p.id FROM Plan p";
	}

	$result = mysqli_query($conn, $query);

	$num_row = mysqli_num_rows($result);
	
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	echo "<table>";
	echo '<tr style="margin:auto"><th>Plan Name</th><th>Speed</th><th>Price / Mo</th>';

	if($loggedIn) {
		echo "<th>Available at your location</th>";
	}

	echo "</tr>";
	// Select a database table to display
	for($i=0; $i<$num_row; $i++) {
		$plan=mysqli_fetch_row($result);
		echo '<tr><td>';
		echo $plan[0];

		echo '</td><td>' . clean_input($plan[2]) . "</td><td>" . clean_input($plan[1]) . "</td>";
		
		if($loggedIn) {
			echo "<td>";

			if(isset($plan[3])) {
				echo '<a href="subscribe.php?plan='. clean_input($plan[4]) . '">' . 'Yes! Subscribe now!' . '</a>';
			} else {
				echo 'No';
			}

			echo "</td>";
		}
		
		echo "</tr>";
	}
	
	echo "</table>";

	mysqli_free_result($result);
	mysqli_close($conn);
	?>








<?php include '_footer.php' ?>
