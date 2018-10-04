<?php

	require('../connection.php');
	
	// Get TableID 
	$TableID = $_POST['TableID'];
	// Get PlayerIds and PlayerNames

	$Player1ID = $_POST['Player1ID'];
	$Player1Name = $_POST['Player1Name'];
	$Player2ID = $_POST['Player2ID'];
	$Player2Name = $_POST['Player2Name'];
	$Player3ID = $_POST['Player3ID'];
	$Player3Name = $_POST['Player3Name'];
	$Player4ID = $_POST['Player4ID'];
	$Player4Name = $_POST['Player4Name']; 

	$sql1 = "SELECT table_state.GameID AS GameID FROM `table_state` WHERE `TableID`='$TableID' ";
	$result1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$GameID = $row1['GameID'];

	$sql2 = "UPDATE `game_transactions` SET `Player1ID`='$Player1ID',`Player1Name`='$Player1Name',`Player2ID`='$Player2ID',
			`Player2Name`='$Player2Name',`Player3ID`='$Player3ID',`Player3Name`='$Player3Name',`Player4ID`='$Player4ID',
			`Player4Name`='$Player4Name' WHERE `GameID`='$GameID'";
	$result2 = mysqli_query($conn,$sql2);


?>