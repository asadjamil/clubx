<?php
	require("../connection.php");

	/*  GameType = 2 is for Double so return row from tbl = game_details
		game_details(GameTypeID,GameTypeName,GameDuration(Min),GameRate,ExtraTime(Min) ) 
	*/
	$query = "SELECT * FROM game_details WHERE GameTypeID = 2";
	$result = mysqli_query($conn,$query);
	$rows = mysqli_num_rows($result);	
	$JSON='{"t" : [';
	$count = 0;
	if($rows == 1)
	{
		$row = mysqli_fetch_assoc($result);
		// Fetch columns from DB 
		$DoubleDuration = $row["GameDuration(Min)"];
		$DoubleRate = $row["GameRate"];
		$DoubleExtraTime = $row["ExtraTime(Min)"];
		// Create JSON
 		$JSON.='{"DoubleDuration" : "'.$DoubleDuration.'",';
 		$JSON.='"DoubleRate" : "'.$DoubleRate.'",';
 		$JSON.='"DoubleExtraTime" : "'.$DoubleExtraTime.'"}';
	}
	
	$JSON.=']}';
	echo $JSON;
	// run your query here
	//echo $sql;
	//$result = mysqli_query($conn, $sql); 
	if ( false===$query ) { 
	printf("error: %s\n", mysqli_error($conn)); 
	}
?>