<?php include '_header.php' ?>
<h1> Log In </h1>
<?php
	if(isset($_GET['failed'])) {
		echo '<div class="loginfailed">Login failed</div>';
	}
?>
<form action="doemplogin.php"  method="post">
  Username:
  <input type="text" name="user" autocomplete=off pattern=".{3,20}" required title="3 to 20 characters" ><br>
  Password:
  <input type="password" name="password" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters"><br>
<input type="submit" name="submit">
</form>
<?php include '_footer.php' ?>
