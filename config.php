<?php
	$conn = mysqli_connect("localhost", "root", "", "e-commerce-store");
	if (!$conn) {
		die("Connection Failed: " . mysqli_connect_error());
	}	
?>