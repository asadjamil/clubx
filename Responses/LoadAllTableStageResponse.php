<?php
	require("../connection.php");

	// Get GameTypeID
	//$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	//$TableID = $_POST['TableID'];

	//$GameTypeID = 1;
	//$TableID = 1;
	$JSON='{"t" : [';
	// Fetch Current Value of Clock Face Timer from tbl = 'table_state' 
	$sql = "SELECT * FROM table_state";
	$result = mysqli_query($conn,$sql);
	$rows = mysqli_num_rows($result);
	$count = 0;
	for ($i=0; $i<$rows; $i++)
	{
		$row = mysqli_fetch_assoc($result);

		// Fetch columns from DB 
		// Set TableStageID = 'NULL'
		$TableStageID = $row['TableStageID'];
		$GameTypeID = $row['GameTypeID'];
		$GameID = $row['GameID'];

		// Fetch PlayerSelectedID i.e Search is enable or not
		$PlayerSelectStageID = $row['PlayerSelectStageID'];
		if($TableStageID == '')
		{
			$TableStageID = 'NULL';
		}
		$sql1 = "SELECT * FROM table_stage WHERE TableStageID = '$TableStageID' ";	
		$result1 = mysqli_query($conn,$sql1);
		$rows1 = mysqli_num_rows($result1);

		$row1 = mysqli_fetch_assoc($result1);

		$sql2 = "SELECT * FROM game_transactions WHERE GameID = '$GameID' ";	
		$result2 = mysqli_query($conn,$sql2);
		$rows2 = mysqli_num_rows($result2);
		$row2 = mysqli_fetch_assoc($result2);

		$Player1Name = $row2['Player1Name'];
		$Player2Name = $row2['Player2Name'];
		$Player3Name = $row2['Player3Name'];
		$Player4Name = $row2['Player4Name'];

		$Player1ID = $row2['Player1ID'];
		$Player2ID = $row2['Player2ID'];
		$Player3ID = $row2['Player3ID'];
		$Player4ID = $row2['Player4ID'];
		// Fetch columns from DB 
		$clock = $row1['clock'];
		$extraTimeClock = $row1['extraTimeClock'];
		$endBtn = $row1['endBtn'];
		$pauseBtn = $row1['pauseBtn'];
		$playBtn = $row1['playBtn'];
		$extraBtn = $row1['extraBtn'];
		$player1Btn = $row1['player1Btn'];
		$player2Btn = $row1['player2Btn']; 
		$finishedBtn = $row1['finishedBtn'];
		$restartBtn = $row1['restartBtn'];
		// Create JSON
		
		$JSON.='{"TableStageID" : "'.$TableStageID.'",';
		$JSON.='"PlayerSelectStageID" : "'.$PlayerSelectStageID.'",';
		$JSON.='"clock" : "'.$clock.'",';
		$JSON.='"extraTimeClock" : "'.$extraTimeClock.'",';
		$JSON.='"endBtn" : "'.$endBtn.'",';
		$JSON.='"pauseBtn" : "'.$pauseBtn.'",';
		$JSON.='"playBtn" : "'.$playBtn.'",';
		$JSON.='"extraBtn" : "'.$extraBtn.'",';
		$JSON.='"player1Btn" : "'.$player1Btn.'",';
		$JSON.='"player2Btn" : "'.$player2Btn.'",';
		$JSON.='"finishedBtn" : "'.$finishedBtn.'",';
		$JSON.='"restartBtn" : "'.$restartBtn.'",';
		$JSON.='"GameTypeID" : "'.$GameTypeID.'",';
		$JSON.='"Player1Name" : "'.$Player1Name.'",';
		$JSON.='"Player2Name" : "'.$Player2Name.'",';
		$JSON.='"Player3Name" : "'.$Player3Name.'",';
		$JSON.='"Player4Name" : "'.$Player4Name.'",';
		$JSON.='"Player1ID" : "'.$Player1ID.'",';
		$JSON.='"Player2ID" : "'.$Player2ID.'",';
		$JSON.='"Player3ID" : "'.$Player3ID.'",';
		$JSON.='"Player4ID" : "'.$Player4ID.'"}';
		//$JSON.='"SingleRate" : "'.$SingleRate.'",';
		//$JSON.='"SingleExtraTime" : "'.$SingleExtraTime.'"}';

		$count++;
 		$tmp = $rows - $count;
 		if($i < $rows - 1)
 		{
 			$JSON.=',';	
 		}
			
	}
	$JSON.=']}';
	echo $JSON;
	// run your query here
	//echo $sql;
	//$result = mysqli_query($conn, $sql); 
	if ( false===$sql ) { 
	printf("error: %s\n", mysqli_error($conn)); 
	}
?>