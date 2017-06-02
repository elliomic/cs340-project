<?php include '_header.php' ?>

<h1> Log In </h1>
<form action="insert.php"  method="post">
  Username:
  <input type="text" name="username" placeholder="smithers" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters" ><br>
  Password:
  <input type="password" name="password"placeholder="*******" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters"><br>

<input type="submit" name="submit">
</form>

<?php include '_footer.php' ?>
