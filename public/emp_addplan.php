<?php include("_header.php"); ?>
<?php
	$user = "";
	$loggedIn = False;

	if(isset($_SESSION['type']) && isset($_SESSION['user']) && $_SESSION['type'] == 'employee') {
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$loggedIn = True;
	}

	if($loggedIn){
?>
	<h2>Add A New Plan</h2>
	<form action="addplan.php"  method="post">
			Plan Name
			<input type="text" name="plan_name" autocomplete=off><br>
			Speed
			<input type="number" name="plan_speed"><br>
			Cost
			<input type="number" name="plan_cost"><br>
		<input type="submit" name="submit">
	</form>
<?php
}else{
	echo "Please login as an employee.";
}
?>




<?php include("_footer.php"); ?>
