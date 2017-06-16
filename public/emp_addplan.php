<?php include("_header.php"); ?>

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




<?php include("_footer.php"); ?>