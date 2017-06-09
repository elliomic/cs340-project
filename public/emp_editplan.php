<? include '_header.php';?>
<?
	include 'connectvarsEECS.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	
	$result = mysqli_query($conn, "SELECT * FROM Plan");

<? include '_footer.php';?>
