<?php
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
// Check connection
if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$firstName = mysqli_real_escape_string($conn, $_REQUEST['firstname']);
$lastName = mysqli_real_escape_string($conn, $_REQUEST['lastname']);
$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
$username = mysqli_real_escape_string($conn, $_REQUEST['username']);
$age = mysqli_real_escape_string($conn, $_REQUEST['age']);
$password = mysqli_real_escape_string($conn, $_REQUEST['password']);
 
// attempt insert query execution
$sql = " INSERT INTO `Users` (`firstName`, `lastName`, `password`, `email`, `username`, `age`) 
VALUES 
('$firstName', '$lastName', '$password','$email', '$username', '$age')";
if($conn->query($sql) === TRUE){
   echo "Record added successfully.";
	echo"<script type='text/javascript'>

	location.replace('http://web.engr.oregonstate.edu/~anderrob/cs340/HW1/add.php');

	</script>";
} else{
    echo "Record already exists";
	echo"<script type='text/javascript'>

	location.replace('http://web.engr.oregonstate.edu/~anderrob/cs340/HW1/add.php');

	</script>";
}
 
// close connection
mysqli_close($conn);

?>