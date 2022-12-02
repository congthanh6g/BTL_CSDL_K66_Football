<?php
	$servername = "us-cdbr-east-06.cleardb.net";
	$username = "b712e7fbf5fd96";
	$password = "9806b2b1";
	$databaseName = "heroku_23f83a515254732";

	$conn = new mysqli($servername, $username, $password, $databaseName);

	if ($conn->connect_error) {
  	die("Connection failed: " . $conn->connect_error);
	}
?>
