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
    <form action="doplanedit.php" method="post">
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
                <label class="x-field__label x-heading5 x-field__label--floating-label" for="name">Added by</label>
                <input type="text" name="added_by" autocomplete="off" required value="<?php echo $plan[3] ?>" placeholder="Added by">
                </div>
		    </div>
	      </div>
	      <input class="x-button--solid" type="submit" name="action" value="Edit plan">
	      <input type="hidden" name="planID" value="<?php echo $planID ?>">
      </fieldset>
    </form>
  </body>
</html>
