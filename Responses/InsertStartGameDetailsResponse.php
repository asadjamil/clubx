<?php
	// Get UserName from Session 
	session_start();
    $username = $_SESSION["UserName"];

	require('../connection.php');
	// Get GameTypeID
	$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	// TableStageID = 1 i.e StartStage
	$TableStageID = 1;
	// PlayerSelectedStage
	$PlayerSelectStageID;
	//$GameTypeID = 1;
	//$TableID = 4;
	// get current Time 
	$timezone  = 5; //(GMT 5:00) EST (Pak) 
	$StartTime = gmdate("H:i:s ", time() + 3600*($timezone+date("I")));
	$GameDate = gmdate("Y-m-j ", time() + 3600*($timezone+date("I")));
	// Update CurrentTime i.e StartGameTime in tbl = table_state WHERE TableID = $TableID, GameTypeID = GameTypeID
	// if GameTypeID == 1 i.e SingleType so ClockFace = 30 min at initial
	
	// Get SingleTimer Value From tbl = 'game_details' i.e GameDuration(Min) = 30 
	$query = "SELECT * FROM game_details WHERE `GameTypeID` = $GameTypeID ";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_assoc($result);
	$GameDuration = $row['GameDuration(Min)'];
	// Convert int return from above query into time format
	$GameDuration = date("H:i:s",strtotime('00:'.$GameDuration.':00'));
	//echo $SingleDuration;

	// Compare GameTypeID
	// If GameType == 'Single' , then PlayerSelectedStageID = 1 (player1select = 1, player2select = 1,check-player-btn = 1)
	if($GameTypeID == 1)
	{
		$PlayerSelectStageID = 1;
	}
	/*If GameType == 'Double' , then PlayerSelectedStageID = 3 (player1select = 1, player2select = 1, player3select, player4select,check-player-btn = 1)*/
	if($GameTypeID == 2)
	{
		$PlayerSelectStageID = 3;
	}
	// If GameType == 'Timer' , then PlayerSelectedStageID = 5 (player1select = 1,check-player-btn = 1)
	if($GameTypeID == 3)
	{
		$PlayerSelectStageID = 5;
	}
	// Check if Game is already started or its new entry
	
	$sql5 = "SELECT table_state.TableStageID AS TableStageIDFK FROM `table_state` WHERE `TableID`='$TableID'";
	$result5 = mysqli_query($conn,$sql5);
	$row5 = mysqli_fetch_assoc($result5);
	$TableStageIDFK = $row5['TableStageIDFK'];

	//echo $TableStageIDFK;
	
	// if TableStageID = "NULL" i.e new game is started and 6 is for EndGame for Restart
	if($TableStageIDFK == '' || $TableStageIDFK == 6)
	{
		// Insert Game Transaction , tbl = game_transactions
		$sql2 = "INSERT INTO `game_transactions`(`GameTypeID`,`GameDate`,`TableID`,`StartTime`,`Player1Name`,`Player2Name`,
				`Player3Name`,`Player4Name`,`LoggedBy`)
			 VALUES ('$GameTypeID','$GameDate','$TableID','$StartTime','Player1Name','Player2Name','Player3Name','Player4Name',
			 '$username') ";	 
		$result2 = mysqli_query($conn,$sql2);	 

		// Fetch GameID from tbl = game_transaction and insert in table_state
		$sql3 = "SELECT game_transactions.GameID FROM game_transactions ORDER BY GameID DESC LIMIT 1";
		$result3 = mysqli_query($conn,$sql3); 	
		$row3 = mysqli_fetch_assoc($result3);
		$GameID = $row3['GameID'];	

		// Update GameID in table_state

		$sql6 = "UPDATE `table_state` SET `GameID`='$GameID' WHERE `TableID` = '$TableID' ";
		$result6 = mysqli_query($conn,$sql6);
	}		 
	
	
	

	// Now update ClockFace Value in tbl = 'table_state',set TableStageID = 1 refer tbl = table_state
	$sql = "UPDATE `table_state` SET `GameTypeID` = '$GameTypeID',`GameID`='$GameID',`TableStageID`='$TableStageID',
			`PlayerSelectStageID`='$PlayerSelectStageID',`StartTime`='$StartTime'		
		 	WHERE `TableID` = $TableID  ";

		 
	// Get ClockFace Value from tbl = 'table_state'
	$sql1 = "SELECT table_state.ClockFace AS ClockFace, table_state.TableID AS TableID FROM `table_state`
			 WHERE `TableID` = $TableID";		 
	$result1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$ClockFace = $row1['ClockFace'];
	// Convert in Time format
	$ClockFace = date("H:i:s",strtotime($ClockFace));
	// Check if ClockFace < 1 sec then Set Timer = 30 min for Single	
	//echo $ClockFace;	
	// Margin of 30 sec i.e if ClockTimer < 30 and Clock Stops
	if($ClockFace <= date('H:i:s',strtotime('00:00:01')))
	{
		// Now update ClockFace Value in tbl = 'table_state'
		$sql1 = "UPDATE `table_state` SET `GameTypeID` = '$GameTypeID',`TableStageID`='$TableStageID',`ClockFace`= '$GameDuration'
		 WHERE `TableID` = $TableID  ";
		 $result1 = mysqli_query($conn,$sql1);
	} 
		//echo $sql;	 
	
	// if GameTypeID == 2 i.e Double Type so ClockFace = 45 min at initial
	/*if($GameTypeID == 2)
	{
		$sql = "UPDATE `table_state` SET `GameTypeID` = '$GameTypeID',`StartTime`='$StartTime',`ClockFace`='00:45:00'
			 WHERE `TableID` = $TableID  ";
	}
	// if GameTypeID == 3 i.e Timer Type so ClockFace = 00 min at initial
	if($GameTypeID == 3)
	{
		$sql = "UPDATE `table_state` SET `GameTypeID` = '$GameTypeID',`StartTime`='$StartTime',`ClockFace`='00:00:00'
			 WHERE `TableID` = $TableID  ";
	}*/
	$result = mysqli_query($conn,$sql);


?>