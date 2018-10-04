<?php
	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	// TableStageID = 4 i.e ExtraTime is clicked
	$TableStageID = 4;
	// Default RduceSec = 1 sec 
	//$Time5Min = date(':i:s',time());
	//$Time5Min = '00:01:00';
	//$GameTypeID = 1;
	//$TableID = 1;
	
	$sql = "SELECT table_state.ClockFaceExtra AS ClockFaceExtra,table_state.ExtraTime AS ExtraTime FROM table_state 
			WHERE `TableID` = $TableID ";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$ClockFaceExtra = $row['ClockFaceExtra'];
	$ExtraTime = $row['ExtraTime'];
	//$secs = strtotime($ClockFace)-strtotime("00:00:00");
	$ClockFaceExtra = date("H:i:s",strtotime($ClockFaceExtra)-1);
	$ExtraTime = date("H:i:s",strtotime($ExtraTime)+1);
	// Update CurrentTime  in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	$sql = "UPDATE `table_state` SET `ClockFaceExtra`='$ClockFaceExtra', `ExtraTime`='$ExtraTime',`TableStageID`='$TableStageID'
		 WHERE `TableID` = $TableID  ";
	$result = mysqli_query($conn,$sql);

	//echo $TableID
	/*$ClockFaceIs5Min = 0;
	// Set Flag if ClockFace <= 5 min
	if($ClockFace <= date('H:i:s',strtotime('00:05:00')))
	{
		$ClockFaceIs5Min = 1;
	}
	if($ClockFace == date('H:i:s',strtotime('00:00:00')))
	{
		$sql = "UPDATE `table_state` SET `ClockFace`='00:00:00' WHERE `TableID` = $TableID  ";
		$result = mysqli_query($conn,$sql);
	}
	// Return ClockFaceFlag
	$JSON='{"t" : [';
	$JSON.='{"ClockFaceIs5Min" : "'.$ClockFaceIs5Min.'"}';
	$JSON.=']}';
	echo $JSON;*/
?>