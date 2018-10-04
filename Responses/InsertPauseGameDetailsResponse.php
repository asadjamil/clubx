<?php
	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	// Table Stage is Pause refer tbl = table_stage
	$TableStageID = 2;
	// get current Time 
	$timezone  = 5; //(GMT 5:00) EST (Pak) 
	$PauseTime = gmdate("H:i:s ", time() + 3600*($timezone+date("I")));
	
	// Update CurrentTime i.e PauseGameTime in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	$sql = "UPDATE `table_state` SET `GameTypeID` = '$GameTypeID',`PauseTime`='$PauseTime',`TableStageID`='$TableStageID'
			 WHERE `TableID` = $TableID  ";
	$result = mysqli_query($conn,$sql);

	// Get GameID associated with TableID
	$sql1 = "SELECT table_state.GameID AS GameID FROM `table_state` WHERE `TableID`='$TableID' ";
	$result1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$GameID = $row1['GameID'];

	// Update Pause Time in tbl='game_transactions'
	$sql2 = "UPDATE `game_transactions` SET `PauseTime`='$PauseTime' WHERE `GameID` = '$GameID'  ";
	$result2 = mysqli_query($conn,$sql2);

?>