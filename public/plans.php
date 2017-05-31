<?php include '_header.php' ?>

// mysqli_real_escape_string
// clean_input

<div id="wrap">
<h1> Pebcak Enterprises </h1>
<div id="header">
<p class="login" ><a href="login.php"></a></p>
</div>
<nav>
<ul id="menu">
<li><a href="index.php">Home</a> </li>
<li><a href="plans.php">Browse Plans</a></li>
<li><a href="login.php">Login</a></li>
<li><a href="employee_login.php">Employees</a></li>
</ul> 
</nav>
<main>

<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	$result = mysqli_query($conn, "SELECT * FROM Plan");
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$num_row = mysqli_num_rows($result);	
	
	echo "<table>";
	echo "<tr><th>Plan Name</th><th>Speed</th><th>Price / Mo</th></tr>";
	// echo "<form action=\"showTable.php\" method=\"POST\">";
	// echo "<select name=\"table\" size=\"1\" Font size=\"+2\">";
	// Select a database table to display
	for($i=0; $i<$num_row; $i++) {
		$plan=mysqli_fetch_row($result);
		echo "<tr><td>" . $plan[1] . "</td><td>" . $plan[3] . "</td><td>" . $plan[2] . "</td><tr>";
		// echo "<option value='$tablename[0]' >".$tablename[0]."</option>";
	}
	
	echo "</table>";
	//echo "</select>";
	//echo "<div><input type=\"submit\" value=\"submit\"></div>";
	//echo "</form>";
		
	mysqli_free_result($result);
	mysqli_close($conn);
	?>




</main>



<?php include '_footer.php' ?>
