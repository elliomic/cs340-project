<?php
	include 'connectvarsEECS.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn){
		die('Could not connect: ' . mysqli_error());
	}
	
	$planID = mysqli_real_escape_string($conn, $_POST['plan']);

	$result = mysqli_query($conn, 'SELECT name, price, speed, added_by FROM Plan WHERE id = ' . $planID);
	$plan = mysqli_fetch_row($result);

	echo '<form action="doplanedit.php" method="post">';
	echo 'name: <input type="text" name="name" autocomplete=off required value="' . $plan[0] . '"><br>';
	echo 'price: <input type="text" name="price" autocomplete=off required value=' . $plan[1] . '><br>';
	echo 'speed: <input type="text" name="speed" autocomplete=off required value=' . $plan[2] . '><br>';
	echo 'added by: <input type="text" name="added_by" autocomplete=off required value=' . $plan[3] . '><br>';
	echo '<input type="submit" name="action" value="Edit plan">';
	echo '<input type="hidden" name="planID" value=' . $planID . '><br>';
	echo '</form>';
?>
