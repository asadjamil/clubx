<?php
    //header("Access-Control-Allow-Origin: *");
    session_start();
    $username = $_SESSION["UserName"];
    $AccessLevel = $_SESSION["AccessLevel"];
    // Check if Session has username and it is not empty
    if(!(isset($_SESSION["UserName"]) && $_SESSION["UserName"]!=''))
    {   
        header('Location: index.html');
        exit;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/clubx-favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Club X</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!-- Bootstrap Toggle CSS -->
    <link href="assets/css/bootstrap-toggle.css" rel="stylesheet">

    <!-- Flip Clock Timer CSS -->
    <link rel="stylesheet" href="assets/plugins/FlipClock/compiled/flipclock.css">

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Fonts and icons     -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>-->
    <link href="assets/css/template-font.css">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/flipclock-responsive.css">
    <style type="text/css">
        
    </style>
</head>

<?php 
   // Get Value of no_of_table from DB & table = club_size

   //$NoOfTables = 4; 
    require('connection.php');
    $sql = "SELECT NoOfTables FROM club_size";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result);
    
    if($rows == 1)
    {
        $row=mysqli_fetch_assoc($result);
        $NoOfTables = $row['NoOfTables'];
    }
?>
<body>
	
	<h1>Access Denied</h1>

</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>

    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Google Maps Plugin    -->
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Bootstrap Toggle JS -->
    <script src="assets/js/bootstrap-toggle.js"></script>
       
    </script>

    
    
</html>
