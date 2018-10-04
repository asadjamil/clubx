<?php
	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	// TableStageID = 5 i.e ChooseWinner
	$TableStageID = 5;
	// get current Time 
	$timezone  = 5; //(GMT 5:00) EST (Pak) 
	$EndTime = gmdate("H:i:s ", time() + 3600*($timezone+date("I")));
	

	// Get GameID associated with TableID
	$sql1 = "SELECT * FROM `table_state` WHERE `TableID`='$TableID' ";
	$result1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$GameID = $row1['GameID'];
	$ResumeTime = $row1['ResumeTime'];
	//$EndTime = $row1['EndTime'];
	$TotalPauseTime = $row1['TotalPauseTime'];
	$ExtraTime = $row1['ExtraTime'];

	// Update Pause Time in tbl='game_transactions'
	$sql2 = "UPDATE `game_transactions` SET `ResumeTime`='$ResumeTime',`EndTime`='$EndTime',`TotalPauseTime`='$TotalPauseTime',
			`ExtraTime`='$ExtraTime' WHERE `GameID` = '$GameID'  ";
	$result2 = mysqli_query($conn,$sql2);

	/* 
		Update EndTime and set StartTime = 00:00:00 , PauseTime = 00:00:00, ResumeTime = 00:00:00, ExtraTime = 00:00:00 , ClockFace = 00:00:00 in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	*/	
	$sql = "UPDATE `table_state` SET `EndTime`='$EndTime',`StartTime`= '00:00:00',
			`PauseTime` = '00:00:00',`ResumeTime` = '00:00:00',`ExtraTime` = '00:00:00', `ClockFace` = '00:00:00',
			ClockFaceExtra = '00:00:00',`TotalPauseTime`='00:00:00',`TableStageID` = '$TableStageID' 
			WHERE `TableID` = $TableID  ";
	$result = mysqli_query($conn,$sql);

?>