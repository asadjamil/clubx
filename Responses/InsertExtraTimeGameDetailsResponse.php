<?php
	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	// Default Extra Time
	$ExtraTimeDefault = date('H:i:s',time());
	//$ExtraTimeDefault = '00:05:00';
	$sql = "SELECT * FROM `game_details` WHERE `GameTypeID` = $GameTypeID";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$ExtraTimeDefault = $row['ExtraTime(Min)'];
	$ExtraTimeDefault = date("H:i:s",strtotime('00:'.$ExtraTimeDefault.':00'));
	// get current Time 
	$timezone  = 5; //(GMT 5:00) EST (Pak) 
	$EndTime = gmdate("H:i:s ", time() + 3600*($timezone+date("I")));
	
	$sql = "SELECT table_state.ClockFaceExtra AS ClockFaceExtra FROM table_state WHERE `TableID` = $TableID ";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$ClockFaceExtra = $row['ClockFaceExtra'];
	
	
	// Update CurrentTime  in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	if($ClockFaceExtra <= date('H:i:s',strtotime('00:00:01')))
	{
		$sql = "UPDATE `table_state` SET `ClockFaceExtra` = '$ExtraTimeDefault' 
				WHERE `TableID` = $TableID ";
		$result = mysqli_query($conn,$sql);
	}
	//echo $ClockFaceExtra;

?>