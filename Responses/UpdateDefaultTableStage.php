<?php
	require('../connection.php');
	// Get GameTypeID
	//$GameTypeID = $_POST['GameTypeID'];
	// Get TableID 
	$TableID = $_POST['TableID'];
	// TableStageID = NULL i.e Default
	//$TableStageID = NULL;
	
	
	/* 
		Update TableStageID = NULL i.e to default TableStage
	*/	
	$sql = "UPDATE `table_state` SET `TableStageID` = NULL
			WHERE `TableID` = $TableID  ";
			
	$result = mysqli_query($conn,$sql);


?>