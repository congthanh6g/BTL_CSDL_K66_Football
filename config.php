<?php
	$servername = "us-cdbr-east-06.cleardb.net";
	$username = "bae52b6817184e";
	$password = "5cf0ab3a";
	$databaseName = "heroku_859cfdb3d7455f4";

	$conn = new mysqli($servername, $username, $password, $databaseName);

	if ($conn->connect_error) {
  	die("Connection failed: " . $conn->connect_error);
	}
?>
