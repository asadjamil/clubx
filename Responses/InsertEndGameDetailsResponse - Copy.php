<?php
	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	
	// get current Time 
	$timezone  = 4; //(GMT 4:00) EST (Pak) 
	$EndTime = gmdate("H:i:s ", time() + 3600*($timezone+date("I")));
	
	// Update CurrentTime i.e PauseGameTime in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	$sql = "UPDATE `table_state` SET `GameTypeID` = '$GameTypeID',`EndTime`='$EndTime' WHERE `TableID` = $TableID  ";
	$result = mysqli_query($conn,$sql);


?>