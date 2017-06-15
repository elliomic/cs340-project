<?php include '_header.php' ?>
<?php


//r change the value of $dbuser and $dbpass to your username and password
	error_reporting(E_ALL); ini_set('display_errors', 1);

	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$user = "";
	$loggedIn = False;

	if(isset($_SESSION['type']) && isset($_SESSION['user']) && $_SESSION['type'] == 'customer') {
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$loggedIn = True;
	}

	// $result = mysqli_query($conn, "SELECT p.name, p.price, p.speed, c.id FROM Plan p LEFT JOIN Address_Plans ap ON p.id = ap.plan_id LEFT JOIN Customer c ON ap.address_id = c.address_id AND c.username = '" . $user . "'");


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
	echo "<tr><th>Plan Name</th><th>Speed</th><th>Price / Mo</th>";

	if($loggedIn) {
		echo "<th>Available at your location</th>";
	}

	echo "</tr>";
	// Select a database table to display
	for($i=0; $i<$num_row; $i++) {
		$plan=mysqli_fetch_row($result);
		echo '<tr><td>';
		if($loggedIn) {
			echo '<a href="subscribe.php?plan=' . $plan[4] . '">';
		}
		echo $plan[0];
		if($loggedIn) {
			echo '</a>';
		}
		echo '</td><td>' . $plan[2] . "</td><td>" . $plan[1] . "</td>";
		
		if($loggedIn) {
			echo "<td>";

			if(isset($plan[3])) {
				echo '<div class="planYes">Yes!</div>';
			} else {
				echo '<div class="planNo">No</div>';
			}

			echo "</td>";
		}
		
		echo "</tr>";
		// echo "<option value='$tablename[0]' >".$tablename[0]."</option>";
	}
	
	echo "</table>";
	//echo "</select>";
	//echo "<div><input type=\"submit\" value=\"submit\"></div>";
	//echo "</form>";
		
	mysqli_free_result($result);
	mysqli_close($conn);
	?>








<?php include '_footer.php' ?>
