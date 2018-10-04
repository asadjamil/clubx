<?php
	require('../connection.php');
	// Get TableID 
	$TableID = $_POST['TableID'];
	// PlayerSelectedStage
	$PlayerSelectStageID;
	

	// Get GameTypeID
	$query = "SELECT * FROM `table_state` WHERE `TableID` = $TableID ";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_assoc($result);
	$GameTypeID = $row['GameTypeID'];
	
	// Compare GameTypeID 
	// If GameType == 'Single' , then PlayerSelectedStageID = 2 (player1select = 0, player2select = 0,check-player-btn = 0)
	if($GameTypeID == 1)
	{
		$PlayerSelectStageID = 2;
	}
	/*If GameType == 'Double' , then PlayerSelectedStageID = 4 (player1select = 0, player2select = 0, player3select = 0, player4select = 0 ,check-player-btn = 0)*/
	if($GameTypeID == 2)
	{
		$PlayerSelectStageID = 4;
	}
	// If GameType == 'Timer' , then PlayerSelectedStageID = 6 (player1select = 0,check-player-btn = 0)
	if($GameTypeID == 3)
	{
		$PlayerSelectStageID = 6;
	}

	// Now update ClockFace Value in tbl = 'table_state',set TableStageID = 1 refer tbl = table_state
	$sql = "UPDATE `table_state` SET `PlayerSelectStageID`='$PlayerSelectStageID' WHERE `TableID` = $TableID  ";

	
	$result = mysqli_query($conn,$sql);


?>