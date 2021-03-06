<?php
	include 'connectvarsEECS.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn){
		die('Could not connect: ' . mysqli_error());
	}
	
	$planID = mysqli_real_escape_string($conn, $_POST['plan']);

	$result = mysqli_query($conn, 'SELECT name, price, speed, added_by FROM Plan WHERE id = ' . $planID);
	$plan = mysqli_fetch_row($result);
?>
<html>
  <head>
    <link rel="stylesheet" href="css/all.css">
  </head>
  <body>
    <form action="doplanedit.php" method="post" name="action" value="edit_vals">
      <fieldset>
        <div class="x-flex-row center-xs middle-xs">
	      <div class="x-flex__col-xs-6">
		    <div class="x-flex__content">
		      <div class="x-field--text">
                <label class="x-field__label x-heading5 x-field__label--floating-label" for="name">Name</label>
                <input type="text" name="name" autocomplete="off" required value="<?php echo $plan[0] ?>" placeholder="Name">
	          </div>
		    </div>
	      </div>
          <div class="x-flex__col-xs-6">
		    <div class="x-flex__content">
		      <div class="x-field--text">
                <label class="x-field__label x-heading5 x-field__label--floating-label" for="name">Price</label>
                <input type="text" name="price" autocomplete="off" required value="<?php echo $plan[1] ?>" placeholder="Price">
                </div>
		    </div>
	      </div>
          <div class="x-flex__col-xs-6">
		    <div class="x-flex__content">
		      <div class="x-field--text">
                <label class="x-field__label x-heading5 x-field__label--floating-label" for="name">Speed</label>
                <input type="text" name="speed" autocomplete="off" required value="<?php echo $plan[2] ?>" placeholder="Speed">
              </div>
		    </div>
	      </div>
          <div class="x-flex__col-xs-6">
		    <div class="x-flex__content">
		      <div class="x-field--text">
                <input type="hidden" name="added_by" autocomplete="off" required value="<?php echo $plan[3] ?>" placeholder="Added by">
                </div>
		    </div>
	      </div>
	      <input class="x-button--solid" type="submit" name="action" value="Edit plan">
	      <input type="hidden" name="planID" value="<?php echo $planID ?>">
	
		  <?php 
	  mysqli_free_result($result);
		$result = mysqli_query($conn, "SELECT id, num, street, city, state, zip FROM Address");
		$num_addresses = mysqli_num_rows($result); ?>

		<div class="x-flex__col-xs-12">
		    <div class="x-flex__content">
		      <div class="x-field--text">
				Add Address To Plan:
				<?php if($num_addresses > 0) { ?>
					<select name="address">
					
					<?php for($i=0; $i<$num_addresses; $i++){
						$this_address = mysqli_fetch_row($result); ?>
						<option value="<?php echo $this_address[0] ?>"><?php echo $this_address[1] . ' ' . $this_address[2] . ' ' . $this_address[3] . ' ' . $this_address[4] . ' ' . $this_address[5] ?></option>
					<?php } ?>
				
					</select>
					<input class="x-button--solid" type="submit" name="action" value="Add Address">
				
				<?php } ?>
				</div>
		    </div>
	      </div>
	  </fieldset>	  
    </form>
  </body>
</html>
