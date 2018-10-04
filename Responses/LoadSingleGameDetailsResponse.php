<?php
	require("../connection.php");

	/*  GameType = 1 is for Single so return row from tbl = game_details
		game_details(GameTypeID,GameTypeName,GameDuration(Min),GameRate,ExtraTime(Min) ) 
	*/
	$query = "SELECT * FROM game_details WHERE GameTypeID = 1";
	$result = mysqli_query($conn,$query);
	$rows = mysqli_num_rows($result);	
	$JSON='{"t" : [';
	$count = 0;
	if($rows == 1)
	{
		$row = mysqli_fetch_assoc($result);
		// Fetch columns from DB 
		$SingleDuration = $row["GameDuration(Min)"];
		$SingleRate = $row["GameRate"];
		$SingleExtraTime = $row["ExtraTime(Min)"];
		// Create JSON
 		$JSON.='{"SingleDuration" : "'.$SingleDuration.'",';
 		$JSON.='"SingleRate" : "'.$SingleRate.'",';
 		$JSON.='"SingleExtraTime" : "'.$SingleExtraTime.'"}';
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