<?php 
	@include 'config.php';
	$id = $_GET['post'];
	$sql = mysqli_query($conn, "
			UPDATE post
                        SET 
                            status = if(status = 1 , 0 , 1)
                        WHERE 
                            id = '$id';
		");
	header("Location: yourpost.php");
?>
