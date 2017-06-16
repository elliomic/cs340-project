<?php include '_header.php';?>
<?php
	include 'connectvarsEECS.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	
	$user = "";
	$loggedIn = False;

	if(isset($_SESSION['type']) && isset($_SESSION['user']) && $_SESSION['type'] == 'employee') {
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$loggedIn = True;
	}

	if($loggedIn){
		$result = mysqli_query($conn, "SELECT id, name FROM Plan");
		$num_plans = mysqli_num_rows($result);
?>
		<form action="showPlan.php" method="post" target="editFrame">
		  <fieldset>
			<div class="x-flex-row center-xs middle-xs">
			  <div class="x-flex__col-xs-12 x-flex__col-md-10">
				<div class="x-flex__content">
				  <div class="x-field--text">
					<h2 class="x-display2">Plans</h2>
					<?php if($num_plans > 0) { ?>
					<select class="x-field__input" name="plan">
			
                      <?php for($i=0; $i<$num_plans; $i++){
                        $thisPlan = mysqli_fetch_row($result); ?>
                            <?php echo "<option value=\"" . $thisPlan[0] . "\"" . ">" . $thisPlan[1] . "</option>" ?>
			<?php } ?>
            	  </div>
			    </div>
		      </div>
			  <input class="x-button--solid" type="submit" name="action" value="Choose plan">
			</select>
		<?php }
		else {
			echo 'No plans';
		} ?>
		</form>

		<iframe style="margin:10px" width="100%" height="400" frameBorder="0" name="editFrame" id="editFrame"></iframe>
	<?php }
	else{
		echo "Please login as an employee.";
	} ?>
<?php include '_footer.php';?>
