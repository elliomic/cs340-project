<?php include '_header.php' ?>



<div id="wrap">
		<div id="header">
			<p class="login" ><a href="login.php"></a></p>
		</div>
		<nav>
			<ul id="menu">
				<li><a href="index.php">Home</a> </li>
				<li><a href="showTable.php">See Users</a></li>
				<li><a href="add.php">Sign Up</a></li>
			</ul> 
		</nav>
		<main>









<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$table = 'Users';
	$query = "SELECT username, firstName, email  FROM $table ";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	$fields_num = mysqli_num_fields($result);
	echo "<h1>Table: {$table}</h1>";
	echo "<table border='1'><tr>";
	// printing table headers
	for($i=0; $i<$fields_num; $i++) {	
		$field = mysqli_fetch_field($result);	
		echo "<td><b>{$field->name}</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			echo "<td>$cell</td>";	
		echo "</tr>\n";
	}

	mysqli_free_result($result);
	mysqli_close($conn);
	?>
	</div>

	
<?php include '_footer.php' ?>