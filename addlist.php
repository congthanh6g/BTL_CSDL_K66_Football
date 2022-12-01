<?php 
	@include 'config.php';
	session_start();
	$ids = $_SESSION["id"];
	$id = $_GET['index'];
	$sql = mysqli_query($conn, "
			INSERT INTO user_choose_post
                        (user_id, post_id, created_at, updated_at) 
                        VALUES
                        ('$ids' , '$id' , now() , now())
		");
	if ($sql === true) {
		header("Location: user_profile.php");
	} else {
		echo $conn -> error;
	}
?>
