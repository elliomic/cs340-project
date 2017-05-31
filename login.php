<?php include '_header.php' ?>

<div id="wrap">
		<div id="header">
			<p class="login" ><a href="login.php"></a></p>
		</div>
	
		<nav>
		<ul id="menu">
			<li><a href="index.php">Home</a> </li>
			<li><a href="plans.php">Browse Plans</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="employee_login.php">Employees</a></li>
		</ul> 
	</nav>
		<main>


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
<h1> Log In </h1>
<form action="insert.php"  method="post">
  Username:
  <input type="text" name="username" placeholder="smithers" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters" ><br>
  Password:
  <input type="password" name="password"placeholder="*******" autocomplete=off pattern=".{5,20}" required title="5 to 20 characters"><br>

<input type="submit" name="submit">
</form>


<ul>
<li><h2> Restrictions: </h2></li></br>
<li> all fields must be less than 20 characters in length</li><br>
<li> all fields must be more than 5 characters in length (other than age)</li>
</ul>

</div>






<?php

include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
/*
$sql = " INSERT INTO `Users` (`username`, `firstName`, `lastName`, `email`, `age`) 
VALUES 
('corny', 'Cornell', 'Cornell', 'corny@gmail.com', '52'), 
('bernster', 'Mac', 'bernie', 'laughs@gmail.com', '25'), 
('IdiotSandwich', 'Gordon', 'Ramsey', 'cook@gmail.com', '32'), 
('Nightman', 'Stephen', 'Colbert', 'colbert@gmail.com', '64')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/






$conn->close();



?>


<?php include '_footer.php' ?>
