<?php
	require('../connection.php');
	// Get GameTypeID
	//$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	//$TableID = 1;
	// TableStageID = 3 (TimerEnd)
	$TableStageID = 3;

	$sql = "SELECT table_state.ClockFace AS ClockFace FROM table_state WHERE `TableID` = $TableID ";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$ClockFace = $row['ClockFace'];
	
	
	// Update CurrentTime  in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	if($ClockFace <= date('H:i:s',strtotime('00:00:01')))
	{
		$sql = "UPDATE `table_state` SET `TableStageID` = '$TableStageID' 
				WHERE `TableID` = $TableID ";
		echo $sql;		
		$result = mysqli_query($conn,$sql);
	}
	//echo $ClockFaceExtra;

?>