<?php
	
	// require database connection file
	require('../connection.php');
	// session Start
	session_start(); 
	// Get Club Size from 
	$clubSize = $_POST["clubSize"];
	$sql = "INSERT INTO club_size(NoOfTables) VALUES ('$clubSize') ";
	$result = mysqli_query($conn,$sql);
	
?>