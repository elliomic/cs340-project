<?php session_start() ?>
<html>
<head>
<title>Pebcak</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="wrap">
<h1> Pebcak Enterprises </h1>
<nav>
<ul id="menu">
<li><a href="index.php">Home</a> </li>
<li><a href="plans.php">Browse Plans</a></li>

<?php
	if (isset($_SESSION['type']) && $_SESSION['type'] == 'customer') {
		echo '<li><a href="account.php">My Account</a></li>';
		echo '<li><a href="logout.php">Log Out</a></li>';
	} else {
		echo '<li><a href="login.php">Login</a></li>';
	}
?>

<li><a href="employee_login.php">Employees</a></li>
</ul> 
</nav>
<main>