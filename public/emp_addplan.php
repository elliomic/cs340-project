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
	<h2 class="x-display2">Add A New Plan</h2>
	<form action="addplan.php"  method="post">
	  <fieldset>
		<div class="x-flex-row center-xs middle-xs">
		  <div class="x-flex__col-xs-12 x-flex__col-md-8">
			<div class="x-flex__content">
			  <div class="x-field--text">
				<label class="x-field__label x-heading5 x-field__label--floating-label" for="plan_name">Plan Name</label>
				<input autocomplete="off" class="x-field__input" type="text" name="plan_name" placeholder="Plan Name">
			  </div>
			</div>
		  </div>
		  <div class="x-flex__col-xs-12 x-flex__col-md-4">
			<div class="x-flex__content">
			  <div class="x-field--text">
				<label class="x-field__label x-heading5 x-field__label--floating-label" for="plan_name">Speed</label>
				<input class="x-field__input" type="number" name="plan_speed">
			  </div>
			</div>
		  </div>
		  <div class="x-flex__col-xs-12 x-flex__col-md-4">
			<div class="x-flex__content">
			  <div class="x-field--text">
				<label class="x-field__label x-heading5 x-field__label--floating-label" for="plan_name">Cost</label>
				<input class="x-field__input" type="number" name="plan_cost">
			  </div>
			</div>
		  </div>
		  <input type="submit" class="x-button--solid" name="submit">
		</div>
	  </fieldset>
	</form>
<?php
}else{
	echo "Please login as an employee.";
}
?>




<?php include("_footer.php"); ?>
