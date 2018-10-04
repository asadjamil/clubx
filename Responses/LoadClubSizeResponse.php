<?php
	require("../connection.php");

	/*  GameType = 1 is for Single so return row from tbl = game_details
		game_details(GameTypeID,GameTypeName,GameDuration(Min),GameRate,ExtraTime(Min) ) 
	*/
	$query = "SELECT * FROM club_size";
	$result = mysqli_query($conn,$query);
	$rows = mysqli_num_rows($result);	
	$JSON='{"t" : [';
	$count = 0;
	if($rows == 1)
	{
		$row = mysqli_fetch_assoc($result);
		// Fetch columns from DB 
		$NoOfTables = $row["NoOfTables"];
		// Create JSON
 		$JSON.='{"NoOfTables" : "'.$NoOfTables.'"}';
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