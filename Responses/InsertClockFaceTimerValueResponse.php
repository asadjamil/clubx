<?php
	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	// Default RduceSec = 1 sec 
	//$ReduceSec = date('H:i:s',time());
	//$ReduceSec = '00:00:01';
	
	
	$sql = "SELECT table_state.ClockFace AS ClockFace FROM table_state WHERE `TableID` = $TableID ";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$ClockFace = $row['ClockFace'];
	//$secs = strtotime($ClockFace)-strtotime("00:00:00");
	$ClockFace = date(":i:s",strtotime($ClockFace)+1);
	
	// Update CurrentTime  in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	$sql = "UPDATE `table_state` SET `ClockFace`='$ClockFace' WHERE `TableID` = $TableID  ";
	$result = mysqli_query($conn,$sql);
	//echo $TableID;
	
?>