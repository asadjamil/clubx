<?php 
    // Connection to SQL SERVER 2008 R2
    require('../connectToSQLServer.php');
    // Connect to MySql 
    //require('../connection.php');
    //set up mysql connection
 
    function getTimeDiff($dtime,$atime){
     
     $nextDay=$dtime>$atime?1:0;
     $dep=EXPLODE(':',$dtime);
     $arr=EXPLODE(':',$atime);

     $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
     $hours=FLOOR($diff/(60*60));
     $mins=FLOOR(($diff-($hours*60*60))/(60));
     $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
     IF(STRLEN($hours)<2){$hours="0".$hours;}
     IF(STRLEN($mins)<2){$mins="0".$mins;}
     IF(STRLEN($secs)<2){$secs="0".$secs;}
     RETURN $hours.':'.$mins.':'.$secs;
    }
    
    function getTimeAdd($dtime,$atime){
     
     $nextDay=$dtime>$atime?1:0;
     $dep=EXPLODE(':',$dtime);
     $arr=EXPLODE(':',$atime);
     $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))+MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j'),DATE('y')+$nextDay));
     $hours=FLOOR($diff/(60*60));
     $mins=FLOOR(($diff-($hours*60*60))/(60));
     $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
     IF(STRLEN($hours)<2){$hours="0".$hours;}
     IF(STRLEN($mins)<2){$mins="0".$mins;}
     IF(STRLEN($secs)<2){$secs="0".$secs;}
     RETURN $hours.':'.$mins.':'.$secs;
    }

    $connMySql = mysqli_connect("localhost", "root", "") or die(mysql_error());
    //select database
    mysqli_select_db($connMySql,"sms") or die(mysql_error());

    // Get Date from HTML field
    $datefrom = $_POST['dtfrom'];
    // Get Date from HTML field
    $dateto = $_POST['dtto'];
    // Convert Into Y-m-d H:i:s format
    $datefrom = $datefrom.' 00:00:00';
    // Convert Into Y-m-d H:i:s format
    $dateto = $dateto.' 00:00:00';
    // Get Records from SQL Server against valid Work Period
    $sql = "SELECT StartDate,EndDate FROM dbo.WorkPeriods WHERE StartDate > '$datefrom' AND StartDate < '$dateto' ";
    //$sql = "SELECT Id,Name,PhoneNumber FROM dbo.Customers ";
    $stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    //$i = 0;
    
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $StartDate = date_format($row['StartDate'],"Y-m-d ");
        //$StartDate = $row['StartDate']; 
        $StartTime = date_format($row['StartDate'],"H:i:s");
        $EndDate = date_format($row['EndDate'],"Y-m-d ");
        $EndTime = date_format($row['EndDate'],"H:i:s");  
        // Get Game Transaction Records against valid Work Period Time
        $sql1="SELECT * FROM `game_transactions` WHERE `GameDate` = '$StartDate' AND `StartTime` > '$StartTime'";
        $result1 = mysqli_query($connMySql,$sql1);
        $rows1 = mysqli_num_rows($result1);
        
        for($i = 0; $i < $rows1 ; $i++)
        {
            $row1 = mysqli_fetch_assoc($result1);
            $GameTypeID = $row1['GameTypeID'];
            $GameDate = $row1['GameDate'];
            $GameDateArr = explode("-", $GameDate);
            $GameDateYear = $GameDateArr[0];
            $GameDateMonth = $GameDateArr[1];
            $GameDateDay = $GameDateArr[2];
            $GameDateFormatted = $GameDateDay . '-' . $GameDateMonth . '-' . $GameDateYear;
            $TableID = $row1['TableID'];
            $StartTime = $row1['StartTime'];
            $PauseTime = $row1['PauseTime'];
            $ResumeTime = $row1['ResumeTime'];
            $EndTime = $row1['EndTime'];
            $TotalPauseTime = $row1['TotalPauseTime'];
            $TotalExtraTime = $row1['ExtraTime'];
            $TotalTime = getTimeDiff($StartTime,$EndTime);
            $TotalTimeArr = explode(":", $TotalTime);
            $TotalTimeMin = $TotalTimeArr[1];
            $LightTime = getTimeDiff($TotalPauseTime,$TotalTime);
            //$LightTime = getTimeDiff('00:05:09','00:10:00');
            $LightTimeArr = explode(":", $LightTime);
            $LightTimeMin = $LightTimeArr[1];

            //$TotalTime = 0;
            $WinnerName = $row1['WinnerName'];
            $LoserName = $row1['LoserName'];
            $sql2 = "SELECT * FROM `game_details` WHERE `GameTypeID`='$GameTypeID'";
            $result2 = mysqli_query($connMySql,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $GameTypeName = $row2['GameTypeName'];
?>
    <tr>
        <td><?php echo $i + 1 ?></td>
        <td><?php echo $GameDateFormatted ?></td>
        <td><?php echo $GameTypeName ?></td>
        <td><?php echo $TableID ?></td>
        <td><?php echo $StartTime ?></td>
        <td><?php echo $PauseTime ?></td>
        <td><?php echo $ResumeTime ?></td>
        <td><?php echo $EndTime ?></td>
        <td><?php echo $TotalPauseTime ?></td>
        <td><?php echo $TotalExtraTime ?></td>
        <td><?php echo $TotalTimeMin ?></td>
        <td><?php echo $LightTimeMin ?></td>
        <td><?php echo $WinnerName ?></td>
        <td><?php echo $LoserName ?></td>
    </tr>
        
<?php
    }  
  }
  sqlsrv_free_stmt( $stmt);
?>