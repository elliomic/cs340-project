<?php include '_header.php';?>
<?php
	include 'connectvarsEECS.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	
	$result = mysqli_query($conn, "SELECT id, name FROM Plan");
	$num_plans = mysqli_num_rows($result);

	echo '<form action="showPlan.php" method="post" target="editFrame">';
	echo 'Plans:';
	if($num_plans > 0) {
		echo '<select name="plan">';
		
		for($i=0; $i<$num_plans; $i++){
			$thisPlan = mysqli_fetch_row($result);
			echo '<option value="' . $thisPlan[0] . '">' . $thisPlan[1] . '</option>';
		}
	
		echo '<input type="submit" name="action" value="Choose plan">';
		echo '</select>';
	}
	else {
		echo 'No plans';
	}
	echo '</form>';

	echo '<iframe width="100%" height="150" frameBorder="0" name="editFrame" id="editFrame"></iframe>';
?>
<?php include '_footer.php';?>
