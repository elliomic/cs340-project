<?php require_once '_header.php' ?>

<h1> Log In </h1>

<?php

	if(isset($_GET['failed'])) {
		echo '<div class="loginfailed">Login failed</div>';
	}

?>

<form action="dologin.php"  method="post">
  Username:
  <input type="text" name="user" autocomplete=off pattern=".{3,20}" required title="3 to 20 characters" ><br>
  Password:
  <input type="password" name="password" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters"><br>
	Employee?
  <input type="checkbox" name="employee"><br>

<div class="x-flex__content"><input type="submit" name="submit" class="x-button--solid"></div>
</form>




<?php include '_footer.php' ?>
