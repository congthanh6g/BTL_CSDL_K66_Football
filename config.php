<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$databaseName = "sem2_football";

	$conn = new mysqli($servername, $username, $password, $databaseName);

	if ($conn->connect_error) {
  	die("Connection failed: " . $conn->connect_error);
	}
?>