<?php
	require("../connection.php");
	// get noOfTables from activation.js
	$clubSize = $_POST['clubSize'];
	/* Make dynamic query and iterate till noOfTables
	   Add TableID values in tbl = table_state with var $id using for loop */
	$sql = "INSERT INTO table_state (TableID) VALUES ";
	for ($id = 1; $id < $clubSize + 1; $id++) {
	    $sql .= "('".$id."'),";
	}
	$sql = rtrim($sql, ',');
	// run your query here
	//echo $sql;
	$result = mysqli_query($conn, $sql); 
	if ( false===$sql ) { 
	printf("error: %s\n", mysqli_error($conn)); 
	}
?>