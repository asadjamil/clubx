<?php 
	require('../connection.php');
	if(isset($_POST['userName']))
	{
		$userName = $_POST['userName'];	
	}
	if(isset($_POST['password']))
	{
		$password = $_POST['password'];
	}
	if(isset($_POST['access']))
	{
		$access = $_POST['access'];	
	}
	if(isset($_POST['contact']))
	{
		$contact = $_POST['contact'];	
	}
	if(isset($_POST['fName']))
	{
		$fName = $_POST['fName'];	
	}
	if(isset($_POST['lName']))
	{
		$lName = $_POST['lName'];	
	}
	if(isset($_POST['address']))
	{
		$address = $_POST['address'];	
	}
	
	$query = "INSERT INTO users VALUES(NULL,'$userName','$password','$fName','$lName','$contact','$address','$access')";
	$result = mysqli_query($conn,$query);
	echo $query;
?>