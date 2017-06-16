<?php include "_header.php"; ?>
<?php
	//displays a list of customers for employees

	include 'connectvarsEECS.php';
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}

	$user = "";
	$loggedIn = False;

	if(isset($_SESSION['type']) && isset($_SESSION['user']) && $_SESSION['type'] == 'employee') {
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$loggedIn = True;
	}

	//checks if the user is logged in
	if($loggedIn){
		//pulls customer information and address
		$result = mysqli_query($conn, "SELECT c.id, c.username, c.name, a.num, a.street, a.city, a.state FROM Customer c, Address a WHERE a.id = c.address_id");

		$num_row = mysqli_num_rows($result);
		
		if (!$result) {
			die("Query to show fields from table failed");
		}
		
		//create a table to display customer data
		echo "<table>";
		echo "<tr><th>User ID</th><th>Username</th><th>Customer Name</th><th>Address</th>";

		echo "</tr>";
		// Select a database table to display
		for($i=0; $i<$num_row; $i++) {
			$customer=mysqli_fetch_row($result);
			echo "<tr><td>" . $customer[0] . "</td><td>" . $customer[1] . "</td><td>" . $customer[2] . "</td><td>" . $customer[3] . " " . $customer[4] . " " . $customer[5] . ", " . $customer[6] . "</td>";
			
			echo "<tr>";
		}
		echo "</table>";
			
		mysqli_free_result($result);
		mysqli_close($conn);
	}
	else{
		echo "Please sign in as an employee to view this page.";
	}
?>
<?php include "_footer.php"; ?>
