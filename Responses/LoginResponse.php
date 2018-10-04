<?php
	
	// require database connection file
	require('../connection.php');
	// session Start
	session_start(); 
	// Get username and password from login.html from string that was passed in Ajax hit on line 81
	//$username = $_POST["username"];
	$password = $_POST["password"];
	$accessLevel = $_POST["accessLevel"];
	//$accessLevel = 2;
	//echo $password;
	//$password = 123;
	$sql = "SELECT UserName,Password,AccessLevel FROM users WHERE Password = $password AND AccessLevel = $accessLevel";
	$result = mysqli_query($conn,$sql);
	$rows = mysqli_num_rows($result);
	//echo $sql;
	if($rows == 1)
	{
		$row=mysqli_fetch_assoc($result);
		$username=$row["UserName"];
		$AccessLevel = $row["AccessLevel"];
		// Add username in session
		$_SESSION["UserName"]=$username;
		$_SESSION["AccessLevel"]= $AccessLevel;
		//return true if username and password is correct
		echo "true";
	}
	else
	{
		//return true if username and password is incorrect
		echo  'false';
	}
	
?>