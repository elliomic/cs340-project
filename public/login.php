<?php include '_header.php' ?>

<!--
<h1> Sign Up </h1>

<form action="insert.php"  method="post">
  Username:
  <input type="text" name="username" placeholder="bentown" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters" ><br>
  First name:
  <input type="text" name="firstname" placeholder="benny" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters"><br>
  Last name:
  <input type="text" name="lastname"placeholder="beaver" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters"><br>
  Password:
  <input type="password" name="password"placeholder="*******" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters"><br>
  Email:
  <input type="text" name="email" placeholder="email@gmail.com" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters"><br>
  Age:
  <input type="text" name="age" placeholder="25" autocomplete=off ><br>

<input type="submit" name="submit">
</form>
-->

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

<input type="submit" name="submit">
</form>




<?php include '_footer.php' ?>
