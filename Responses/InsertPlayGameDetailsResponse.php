<?php
	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	//$GameTypeID = 1;
	// Get TableID 
	$TableID = $_POST['TableID'];
	//$TableID = 1;
	// TableStage is StartGame or pause btn is enable
	$TableStageID = 1;
	// get current Time 
	$timezone  = 5; //(GMT 5:00) EST (Pak) 
	$PlayTime = gmdate("H:i:s ", time() + 3600*($timezone+date("I")));
	
	// Update CurrentTime i.e PauseGameTime in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	$sql = "UPDATE `table_state` SET `GameTypeID` = '$GameTypeID',`ResumeTime`='$PlayTime',`TableStageID` = '$TableStageID'
			 WHERE `TableID` = '$TableID '";
	$result = mysqli_query($conn,$sql);

	// Find Difference Between PauseTime and ResumeTime then add previous added TotalPauseTime
	$sql1 = "SELECT table_state.TotalPauseTime AS TotalPauseTime,table_state.GameID AS GameID,
			ADDTIME(TIMEDIFF(table_state.ResumeTime,table_state.PauseTime),TotalPauseTime) AS TotalPauseTimeCalculated  
			 FROM `table_state` WHERE `TableID`='$TableID' ";
		 
	$result1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$TotalPauseTimeCalculated = $row1['TotalPauseTimeCalculated'];
	$GameID = $row1['GameID'];
	//$TotalPauseTime = $row1['TotalPauseTime'];
	//echo $TotalPauseTimeCalculated;
	// Explode TotalPauseTime in Hrs,Min,Sec
	//echo $TotalPauseTimeCalculated;
	$TotalPauseTimeCalculatedArr = explode(":",$TotalPauseTimeCalculated);
	$TotalPauseTimeHrs = $TotalPauseTimeCalculatedArr[0];
	$TotalPauseTimeMin = $TotalPauseTimeCalculatedArr[1];
	$TotalPauseTimeSec = $TotalPauseTimeCalculatedArr[2];
	
	//echo $TotalPauseTimeHrs.'/';
	// Concate Time 
	$TotalPauseTimeStr = $TotalPauseTimeHrs.':'.$TotalPauseTimeMin.':'.$TotalPauseTimeSec;
	// Convert Time into Standard Format
	$TotalPauseTimeCalculated = date("H:i:s",strtotime($TotalPauseTimeStr));
	//echo $TotalPauseTimeCalculated;
	
	$sql = "UPDATE `table_state` SET `GameTypeID` = '$GameTypeID',`ResumeTime`='$PlayTime',`TableStageID` = '$TableStageID',
			`TotalPauseTime`='$TotalPauseTimeCalculated'
			 WHERE `TableID` = '$TableID '";
	$result = mysqli_query($conn,$sql);

	$sql = "UPDATE `game_transactions` SET `ResumeTime`='$PlayTime'
			 WHERE `GameID` = '$GameID '";
	$result = mysqli_query($conn,$sql);

?>