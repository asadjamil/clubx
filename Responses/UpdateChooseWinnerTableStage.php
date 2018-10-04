<?php
	require('../connection.php');
	// Get GameTypeID
	//$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	$WinnerID = $_POST['WinnerID'];
	$WinnerName = $_POST['WinnerName'];
	$LoserID = $_POST['LoserID'];
	$LoserName = $_POST['LoserName'];

	// TableStageID = 6 i.e EndGame
	$TableStageID = 6;
	
	
	/* 
		Update EndTime and set StartTime = 00:00:00 , PauseTime = 00:00:00, ResumeTime = 00:00:00, ExtraTime = 00:00:00 , ClockFace = 00:00:00 in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	*/	
	$sql = "UPDATE `table_state` SET `TableStageID` = '$TableStageID' 
			WHERE `TableID` = $TableID  ";		
	$result = mysqli_query($conn,$sql);

	$sql1 = "SELECT table_state.GameID AS GameID FROM `table_state` WHERE `TableID`='$TableID' ";
	$result1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$GameID = $row1['GameID'];

	$sq2 = "UPDATE `game_transactions` SET `WinnerID`='$WinnerID',`WinnerName`='$WinnerName',`LoserID`='$LoserID',
			`LoserName`='$LoserName' WHERE `GameID`='$GameID'";
	$result2 = mysqli_query($conn,$sq2);
?>