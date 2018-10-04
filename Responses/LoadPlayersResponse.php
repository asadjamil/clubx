<?php 
	require('../connectToSQLServer.php');
	// Create JSON
	//$request = mysqli_real_escape_string($connect, $_POST["query"]);
	$searchField = $_POST['searchField'];
	//$searchField = 'a';
	//$searchField = 'asad';
	$JSON='{"t" : [';
	$sql = "SELECT TOP 3 Id,Name,PhoneNumber FROM dbo.Customers WHERE Name LIKE '%".$searchField."%'";
	//$sql = "SELECT Id,Name,PhoneNumber FROM dbo.Customers ";
	$stmt = sqlsrv_query( $conn, $sql );
	if( $stmt === false) {
	    die( print_r( sqlsrv_errors(), true) );
	}

	//$i = 0;
	
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		$PlayerID = $row['Id'];
		$PlayerName = $row['Name'];
		$PhoneNumber = $row['PhoneNumber'];
		$JSON.='{"PlayerID" : "'.$PlayerID.'",';
		$JSON.='"PlayerName" : "'.$PlayerName.'",';
		$JSON.='"PhoneNumber" : "'.$PhoneNumber.'"}';
	    //echo $row['Id'].", ".$row['Name']."<br />";
	    $JSON.=',';	
 
	}
	$JSON.=']}';
	// Remove Last Comma
	$JSON = preg_replace("/,(?!.*,)/", "", $JSON);
	echo $JSON;
	sqlsrv_free_stmt( $stmt);
?>