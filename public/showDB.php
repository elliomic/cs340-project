<!DOCTYPE html>
<!-- showDB.php -->
<html>
	<head>
		<title>MySQL DB Viewer</title>
	</head>
<body>

<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	$result = mysqli_query($conn, "SHOW TABLES");
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$num_row = mysqli_num_rows($result);	
	
	echo "<h1>Choose one table:<h1>"; 
	echo "<form action=\"showTable.php\" method=\"POST\">";
	echo "<select name=\"table\" size=\"1\" Font size=\"+2\">";
	// Select a database table to display
	for($i=0; $i<$num_row; $i++) {
		$tablename=mysqli_fetch_row($result);
		echo "<option value='$tablename[0]' >".$tablename[0]."</option>";
	}
	
	echo "</select>";
	echo "<div><input type=\"submit\" value=\"submit\"></div>";
	echo "</form>";
		
	mysqli_free_result($result);
	mysqli_close($conn);
	?>
</body>

</html>

	
