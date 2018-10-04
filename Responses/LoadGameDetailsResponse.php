<?php
	require("../connection.php");

	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];

	//$GameTypeID = 1;
	//$TableID = 1;
	
	// Fetch Current Value of Clock Face Timer from tbl = 'table_state' 
	$sql = "SELECT table_state.ClockFace AS ClockFace, table_state.ClockFaceExtra AS ClockFaceExtra FROM table_state
		 WHERE `TableID` = $TableID AND `GameTypeID` = $GameTypeID";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	// Fetch columns from DB 
	$ClockFace = $row['ClockFace'];
	$ClockFaceExtra = $row['ClockFaceExtra'];
	// Convert into time format
	//$ClockFace = date("H:i:s",strtotime($ClockFace));
	// Convert Time(ClockFace) into Seconds
	$ClockFace = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $ClockFace);

	sscanf($ClockFace, "%d:%d:%d", $hours, $minutes, $seconds);

	$ClockFaceSeconds = $hours * 3600 + $minutes * 60 + $seconds;
		
	// Convert Time(ClockFace) into Seconds
	$ClockFaceExtra = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $ClockFaceExtra);

	sscanf($ClockFaceExtra, "%d:%d:%d", $hours, $minutes, $seconds);

	$ClockFaceExtraSeconds = $hours * 3600 + $minutes * 60 + $seconds;
		
	$JSON='{"t" : [';
	// Create JSON
	$JSON.='{"ClockFaceSeconds" : "'.$ClockFaceSeconds.'",';
	$JSON.='"ClockFaceExtraSeconds" : "'.$ClockFaceExtraSeconds.'"}';
	//$JSON.='"SingleRate" : "'.$SingleRate.'",';
	//$JSON.='"SingleExtraTime" : "'.$SingleExtraTime.'"}';

	
	$JSON.=']}';
	echo $JSON;
	// run your query here
	//echo $sql;
	//$result = mysqli_query($conn, $sql); 
	if ( false===$sql ) { 
	printf("error: %s\n", mysqli_error($conn)); 
	}
?>