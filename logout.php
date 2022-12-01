<?php 
	session_start();
	unset($_SESSION["username"]);
	unset($_SESSION["login"]);
	header("Location:login.php");
?>