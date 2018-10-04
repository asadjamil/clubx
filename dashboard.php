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

<div class="wrapper">
    <div class="sidebar" data-color="red" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper" style="background:black">
            <div class="logo" style="background-color:black">
                <a href="#" class="simple-text">
                    Club X
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php 
                    // if Admin
                    if($AccessLevel == 1)
                    {
                ?>
                <li>
                    <a href="settings.php" target="_blank" id="settingsTab">
                        <i class="pe-7s-settings"></i>
                        <p>Settings</p>
                    </a>
                </li>
                
                <li>
                    <a href="#" id="reportsTab">
                        <i class="pe-7s-note2"></i>
                        <p>Reports</p>

                    </a>
                    <ul class="nav" style="margin-left:10px;">
                        <li>
                            <a href="Reports/WorkPeriodReport.php" target="_blank" id="reportsTab">
                                <i class="pe-7s-calculator"></i>
                                <p>Work Period</p>
                            </a>
                        </li>
                        <li>
                            <a href="Reports/TableReport.php" target="_blank" id="reportsTab">
                                <i class="pe-7s-airplay"></i>
                                <p>Table</p>
                            </a>
                        </li>       
                    </ul>
                </li>
                <?php 
                    }
                ?>
                <!--
                <li>
                    <a href="typography.html">
                        <i class="pe-7s-news-paper"></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li>
                    <a href="icons.html">
                        <i class="pe-7s-science"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="maps.html">
                        <i class="pe-7s-map-marker"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html">
                        <i class="pe-7s-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                -->
                <li class="active-pro">
                    <a href="logout.php">
                        <i class="pe-7s-rocket"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel" style="background-color:black">
        
        <nav class="navbar navbar-default navbar-fixed" style="background-color:black">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">

                </div>
            </div>
        </nav>
        

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php 
                        //$NoOfTables = echo $NoOfTables;
                        $TableNo = 0;
                        $id = 0;
                        for($i = 0 ; $i < $NoOfTables ; $i++)
                        {
                            $TableNo = $i + 1;
                            $id = $i + 1;
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 snooker-table">
                      <img src="assets/img/snooker-table.png" class="img-responsive image" alt="Snooker Table">
                      <div class="text-div">  
                        <div class="text"> <?php echo $TableNo ?></div>
                      </div>
                      <div class="button-div" id="button-div<?php echo $id ?>">
                        <button class="btn btn-fill btn-wd btn-warning btn-block" value="a" id="single<?php echo $id ?>" 
                            onclick="Single(<?php echo $id ?>)">Single</button><br>
                        <button class="btn btn-fill btn-wd btn-info btn-block" id="double<?php echo $id ?>" 
                            onclick="Double(<?php echo $id ?>)">Double</button><br>
                        <button class="btn btn-fill btn-wd btn-default btn-block" id="timer<?php echo $id ?>" 
                            onclick="Timer(<?php echo $id ?>)">Timer</button>
                      </div>

                      <div class="player-div form-group col-md-12 " id="player-div<?php echo $id ?>" >
                        <div class="col-md-5 ">
                            
                            <input type="text" name="search" id="searchplayer1table<?php echo $id ?>" placeholder="Player Name" 
                                class="form-control" onkeyup="SearchPlayer1(<?php echo $id ?>)" style="display: none;"/>
                           
                            <ul class="list-group" id="resultplayer1table<?php echo $id ?>" style="list-style-position: inside;">
                            </ul>
                            <input type="text" name="search" id="searchplayer2table<?php echo $id ?>" placeholder="Player Name" 
                                class="form-control" onkeyup="SearchPlayer2(<?php echo $id ?>)" style="display: none;"/>
                           
                            <ul class="list-group" id="resultplayer2table<?php echo $id ?>" style="list-style-position: inside;">
                              
                            </ul>
                           
                            
                            <button class="btn btn-fill btn-info" style="display: none" id="player1-btn<?php echo $id ?>" 
                                onclick="Player1(<?php echo $id ?>)" value="">Player1</button>
                        </div>
                        <div class="col-md-2">
                            <div id="check-player-div<?php echo $id ?>" hidden>
                                <!--<input id="check-player-btn<?php echo $id ?>" data-toggle="toggle" data-style="ios" type="checkbox" onchange="CheckPlayer(<?php echo $id ?>)">-->
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-danger">
                                        <input id="check-player-btn<?php echo $id ?>" type="checkbox" autocomplete="off" onchange="CheckPlayer(<?php echo $id ?>)" >
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <input type="text" name="search" id="searchplayer3table<?php echo $id ?>" placeholder="Player Name" 
                                class="form-control" onkeyup="SearchPlayer3(<?php echo $id ?>) " style="display: none;"/>
                           
                            <ul class="list-group" id="resultplayer3table<?php echo $id ?>" style="list-style-position: inside;">
                            </ul>
                            
                            <input type="text" name="search" id="searchplayer4table<?php echo $id ?>" placeholder="Player Name" 
                                class="form-control" onkeyup="SearchPlayer4(<?php echo $id ?>)" style="display: none;"/>
                           
                            <ul class="list-group" id="resultplayer4table<?php echo $id ?>" style="list-style-position: inside;">
                              
                            </ul>
                            
                            <button class="btn btn-fill btn-danger" style="display: none" id="player2-btn<?php echo $id ?>" 
                                onclick="Player2(<?php echo $id ?>)" value="">Player2</button>
                        </div>

                      </div>
                      <div class="clock clock-div" id="clock<?php echo $id ?>" hidden></div>

                      <div class="clock clock-div" id="extra-time-clock<?php echo $id ?>" hidden></div>

                      <div class="game-control-div col-md-12 col-sm-12 " id="game-control-div<?php echo $id ?>"> 
                        
                        <div class="col-md-6 col-sm-6" style="text-align:center;">
                            <button class="btn btn-fill btn-danger" id="end-btn<?php echo $id ?>" 
                                onclick="End(<?php echo $id ?>)" style="display: none">End Game</button>
                            <button class="btn btn-fill btn-danger " id="finished-btn<?php echo $id ?>" 
                                onclick="Finished(<?php echo $id ?>)" style="display: none">Finished</button>    
                        </div>        
                        
                        <div class="col-md-6 col-sm-6" style="text-align:center;">
                            <button class="btn btn-fill btn-info" id="pause-btn<?php echo $id ?>" 
                                onclick="Pause(<?php echo $id ?>)" style="display: none">Pause</button>
                             <button class="btn btn-fill btn-info " id="extra-pause-btn<?php echo $id ?>" 
                                onclick="ExtraPause(<?php echo $id ?>)" style="display: none">Pause</button>   
                            <button class="btn btn-fill btn-info " id="play-btn<?php echo $id ?>" 
                                onclick="Play(<?php echo $id ?>)" style="display: none">Play</button>
                            <button class="btn btn-fill btn-info " id="extra-play-btn<?php echo $id ?>" 
                                onclick="ExtraPlay(<?php echo $id ?>)" style="display: none">Play</button>        
                            <button class="btn btn-fill btn-info " id="extra-btn<?php echo $id ?>" 
                                onclick="ExtraTime(<?php echo $id ?>)" style="display: none">Extra Time</button>     
                            <button class="btn btn-fill btn-info " id="restart-btn<?php echo $id ?>" 
                                onclick="Restart(<?php echo $id ?>)" style="display: none">Restart</button>        
                        </div>
                           
                      </div>
                    </div>
                    <?php
                            // Create Line Break after 2 tables in a row
                            if ($id == 2) {
                               echo '<h7 style="color:black">'.$id.'</h7>';
                    ?>
                    <br/>
                    <?php           
                                
                            } // EndIf
                        } // EndLoop
                    ?>
                </div>
                <br>
            </div>
        </div>


        <!--<footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>-->

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>

    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Bootstrap Toggle JS -->
    <script src="assets/js/bootstrap-toggle.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript" src="assets/js/SnookerJS/functions.js"></script>

    <script type="text/javascript">
        
      $(window).on('load', function () {
         LoadAllTableStage();
       
         /* Toggle Color */
         /*$('.toggle-off').css('background-color','#FFFFFF');
         $('.toggle-on').css('background-color','#FFFFFF');*/
        });

       
    </script>

    
    
    <!-- Flip Clock Timer JS (Always in End )-->
    <script src="assets/plugins/FlipClock/compiled/flipclock.js"></script>  

    
    
</html>
