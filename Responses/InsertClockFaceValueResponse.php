<?php
	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	// Default RduceSec = 1 sec 
	//$Time5Min = date(':i:s',time());
	//$Time5Min = '00:01:00';
	
	
	$sql = "SELECT table_state.ClockFace AS ClockFace FROM table_state WHERE `TableID` = $TableID ";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$ClockFace = $row['ClockFace'];
	//$secs = strtotime($ClockFace)-strtotime("00:00:00");
	$ClockFace = date("H:i:s",strtotime($ClockFace)-1);
	
	// Update CurrentTime  in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	$sql = "UPDATE `table_state` SET `ClockFace`='$ClockFace' WHERE `TableID` = $TableID  ";
	$result = mysqli_query($conn,$sql);
	//echo $TableID
	$ClockFaceIs5Min = 0;
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
	if($ClockFace <= date('H:i:s',strtotime('00:00:00')))
	{
		$ClockFaceEnd = 1;
	}
	// Return ClockFaceFlag
	$JSON='{"t" : [';
	$JSON.='{"ClockFaceIs5Min" : "'.$ClockFaceIs5Min.'",';
	$JSON.='"ClockFaceEnd" : "'.$ClockFaceEnd.'",';
	$JSON.='"ClockFace" : "'.$ClockFace.'"}';
	$JSON.=']}';
	echo $JSON;
?>