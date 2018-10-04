/*
    Declaring following var to hold data returned from "Responses/LoadSingleGameDetailsResponse.php" 
    that has all details related to Single GameType
    
*/
var SingleDuration; 
var SingleExtraTime; 
var SingleRate;

/*
    Declaring following var to hold data returned from "Responses/LoadDoubleGameDetailsResponse.php" 
    that has all details related to Double GameType
    
*/
var DoubleDuration; 
var DoubleExtraTime; 
var DoubleRate;

var ClockFaceSeconds;
//var ClockFaceTimer;

// Global Team1,Team2
var Team1ID='',Team1Name='',Team2ID='',Team2Name='',Team1NameShort='',Team2NameShort='';
var Player1NameFlag=0,Player2NameFlag = 0,Player3NameFlag = 0,Player4NameFlag = 0;
var TimerFlag = 0;

function LoadAllTableStage()
{
    $.ajax({
          url:"Responses/LoadAllTableStageResponse.php",
          method:"POST",
          //data:{GameTypeID:GameTypeID,TableID:TableID},
          success:function(data){
            
            var jsn = $.parseJSON(data); 
            var id = 1;
            //console.log(data);
            for(var i =  0 ; i < jsn.t.length ; i++)
            {
                
                var TableStageID = jsn.t[i].TableStageID;
                //console.log(TableStageID);
                if(TableStageID != "NULL")
                {

                    var clock = jsn.t[i].clock;
                    var extraTimeClock = jsn.t[i].extraTimeClock;
                    var endBtn = jsn.t[i].endBtn;
                    var pauseBtn = jsn.t[i].pauseBtn;
                    var playBtn = jsn.t[i].playBtn;
                    var extraBtn = jsn.t[i].extraBtn;
                    var player1Btn = jsn.t[i].player1Btn;
                    var player2Btn = jsn.t[i].player2Btn;
                    var finishedBtn = jsn.t[i].finishedBtn;
                    var restartBtn = jsn.t[i].restartBtn;
                    var GameTypeID = jsn.t[i].GameTypeID;
                    var PlayerSelectStageID = jsn.t[i].PlayerSelectStageID;
                    var Player1Name = jsn.t[i].Player1Name;
                    var Player2Name = jsn.t[i].Player2Name;
                    var Player3Name = jsn.t[i].Player3Name;
                    var Player4Name = jsn.t[i].Player4Name;
                    var Player1ID = jsn.t[i].Player1ID;
                    var Player2ID = jsn.t[i].Player2ID;
                    var Player3ID = jsn.t[i].Player3ID;
                    var Player4ID = jsn.t[i].Player4ID;
                    $('#button-div'+id).hide();
                    // TableStage = 1 (StartGame) 
                    if(clock == 1 && endBtn == 1 && extraBtn == 0)
                    {   
                        // Single Type
                        console.log('Stage:1');
                        if(GameTypeID == 1)
                        {
                            if(playBtn == 1)
                            {
                                window['pauseBtnState'+id] = 1;    
                            }
                            else
                            {
                                window['pauseBtnState'+id] = 0;    
                            }
                            
                            Single(id);
                        }
                        // Double Type
                        if(GameTypeID == 2)
                        {
                            if(playBtn == 1)
                            {
                                window['pauseBtnState'+id] = 1;    
                            }
                            else
                            {
                                window['pauseBtnState'+id] = 0;    
                            }
                            Double(id);
                        }
                        // Timer
                        if(GameTypeID == 3)
                        {
                            if(playBtn == 1)
                            {
                                window['pauseBtnState'+id] = 1;    
                            }
                            else
                            {
                                window['pauseBtnState'+id] = 0;    
                            }
                            Timer(id);
                        }
                    }
                    // TableStage = 2 (PauseGame)
                    if(playBtn == 1)
                    {
                    	console.log('Stage:2');
                        Pause(id);
                    }
                    // TableStage = 3 (TimerEnd)
                    if(extraBtn == 1)
                    {
                    	console.log('Stage:3');
                        // Check for Single 
                        if(GameTypeID == 1)
                        {
                            window['clockSingle'+id] = $('#clock'+id).FlipClock(1,{
                            countdown: true,
                            clockFace: 'MinuteCounter',
                            
                            callbacks: {
                                 
                                stop: function (){
                                    //clearInterval(window['ClockFaceSingleValue'+id]);
                                    //$('#pause-btn'+id).hide();
                                    //$('#extra-btn'+id).show();
                                    //UpdateTimerEndTableStage(id)      
                                }
                            }
                                
                            });
                            window['gameSingleTable'+id] = 1;
                            // Show Player Search
						    $('#searchplayer1table'+id).show();
						    $('#searchplayer3table'+id).show();
						    // Disable Player Search
						    $('#searchplayer1table'+id).prop('disabled',false);
						    $('#searchplayer3table'+id).prop('disabled',false);
						    $('#check-player-div'+id).show();
						    var CheckDiv = $('#check-player-btn'+id).parent();
						    CheckDiv.removeClass("active");
						    CheckDiv.attr("disabled");
						    $('#check-player-btn'+id).attr("checked");
                        }
                        // Check for Double
                        if(GameTypeID == 2)
                        {
                            window['clockDouble'+id] = $('#clock'+id).FlipClock(1,{
                            countdown: true,
                            clockFace: 'MinuteCounter',
                            
                            callbacks: {
                                 
                                stop: function (){
                                    //clearInterval(window['ClockFaceSingleValue'+id]);
                                    //$('#pause-btn'+id).hide();
                                    //$('#extra-btn'+id).show();
                                    //UpdateTimerEndTableStage(id)
                                    //console.log('Fake Stop');
                                }
                            }
                                
                            });
                            window['gameDoubleTable'+id] = 1;
                            // Show Player Search
						    $('#searchplayer1table'+id).show();
						    $('#searchplayer2table'+id).show();
						    $('#searchplayer3table'+id).show();
						    $('#searchplayer4table'+id).show();
						    // Disable Player Search
						    $('#searchplayer1table'+id).prop('disabled',false);
						    $('#searchplayer2table'+id).prop('disabled',false);
						    $('#searchplayer3table'+id).prop('disabled',false);
						    $('#searchplayer4table'+id).prop('disabled',false);
						    $('#check-player-div'+id).show();
						    var CheckDiv = $('#check-player-btn'+id).parent();
						    CheckDiv.removeClass("active");
						    CheckDiv.attr("disabled");
						    $('#check-player-btn'+id).attr("checked");
                        }
                        $('#end-btn'+id).show();
                        $('#extra-btn'+id).show();
                    }
                    // TableStage = 4 (ExtraTime)
                    if(extraTimeClock == 1)
                    {
                    	console.log('Stage:4');
                        // Check for Single 
                        if(GameTypeID == 1)
                        {
                            window['clockSingle'+id] = $('#clock'+id).FlipClock(1,{
                            countdown: true,
                            clockFace: 'MinuteCounter',
                            
                            callbacks: {
                                 
                                stop: function (){
                                    //clearInterval(window['ClockFaceSingleValue'+id]);
                                    //$('#pause-btn'+id).hide();
                                    //$('#extra-btn'+id).show();
                                    //UpdateTimerEndTableStage(id)
                                }
                            }
                                
                            });
                            window['gameSingleTable'+id] = 1;
                            // Show Player Search
						    $('#searchplayer1table'+id).show();
						    $('#searchplayer3table'+id).show();
						    // Disable Player Search
						    $('#searchplayer1table'+id).prop('disabled',false);
						    $('#searchplayer3table'+id).prop('disabled',false);
						    $('#check-player-div'+id).show();
						    var CheckDiv = $('#check-player-btn'+id).parent();
						    CheckDiv.removeClass("active");
						    CheckDiv.attr("disabled");
						    $('#check-player-btn'+id).attr("checked");
                        }
                        // Check for Double
                        if(GameTypeID == 2)
                        {
                            window['clockDouble'+id] = $('#clock'+id).FlipClock(1,{
                            countdown: true,
                            clockFace: 'MinuteCounter',
                            
                            callbacks: {
                                 
                                stop: function (){
                                    //clearInterval(window['ClockFaceSingleValue'+id]);
                                    //$('#pause-btn'+id).hide();
                                    //$('#extra-btn'+id).show();
                                    //UpdateTimerEndTableStage(id)
                                    //console.log('Fake Stop');
                                }
                            }
                                
                            });
                            window['gameDoubleTable'+id] = 1;
                            // Show Player Search
						    $('#searchplayer1table'+id).show();
						    $('#searchplayer2table'+id).show();
						    $('#searchplayer3table'+id).show();
						    $('#searchplayer4table'+id).show();
						    // Disable Player Search
						    $('#searchplayer1table'+id).prop('disabled',false);
						    $('#searchplayer2table'+id).prop('disabled',false);
						    $('#searchplayer3table'+id).prop('disabled',false);
						    $('#searchplayer4table'+id).prop('disabled',false);
						    $('#check-player-div'+id).show();
						    var CheckDiv = $('#check-player-btn'+id).parent();
						    CheckDiv.removeClass("active");
						    CheckDiv.attr("disabled");
						    $('#check-player-btn'+id).attr("checked");
                        }
                        ExtraTime(id);
                    }
                    // TableStage = 5 (Choose Winner)
                    if(player1Btn == 1 && player2Btn == 1)
                    {
                        console.log('Stage:5');
                        End(id);
                    }
                    // TableStage = 6 (EndGame)
                    
                    if(finishedBtn == 1 && restartBtn == 1)
                    {

                        //Player1(id);
                        //Player2(id);
                        console.log('Stage:6');
                        // Show Finish button
                        $('#finished-btn'+id).show();
                        // Show Restart Button
                        $('#restart-btn'+id).show();
                        // Hide Player1 
                        $('#player1-btn'+id).hide();
                        // Hide Player2 
                        $('#player2-btn'+id).hide();
                    }
                    
                    // PlayerSelectStageID = 2,4,6 i.e check-player-div = 0
                    // Check Multiple of 2 i.e 2,4,6
                    //console.log(PlayerSelectStageID);
                    if(PlayerSelectStageID % 2 == 0)
                    {
                        //console.log('if');
                        //$('#check-player-div'+id).hide();
                        var CheckDiv = $('#check-player-btn'+id).parent();
                        CheckDiv.addClass("active");
                        CheckDiv.attr("disabled","disabled");
                        $('#searchplayer1table'+id).val(Player1Name);
                        $('#searchplayer2table'+id).val(Player2Name);
                        $('#searchplayer3table'+id).val(Player3Name);
                        $('#searchplayer4table'+id).val(Player4Name);
                        $('#searchplayer1table'+id).prop('disabled',true);
                        $('#searchplayer2table'+id).prop('disabled',true);
                        $('#searchplayer3table'+id).prop('disabled',true);
                        $('#searchplayer4table'+id).prop('disabled',true);
                        // Check if Timer
                        var Team1NameShort,Team2NameShort; 
                        var npfS = true;
                        var npfD = true;
                        var npfT = true;
                        if(Player1Name == 'Player1')
                        {
                        	npfT = false;
                        }
                       //if(npfT)
                        //{
	                        if(Player1Name != '')
	                        {
	                            Team1Name = Player1Name;
	                            // Get First three letters
	                            Team1NameShort = Player1Name.substr(0,3);
	                            Team1ID = Player1ID;
	                            Team2ID = Player1ID;
	                            Team2NameShort = Team1NameShort;
	                        }
                        //}
                        console.log(Player1Name);
                        console.log(Player2Name);
                        console.log(Player3Name);
                        console.log(Player4Name);
                        if(Player1Name == 'Player1' && Player3Name=='Player3')
                        {
                        	npfS = false;
                        }

                        console.log(npfS);
                        //if(npfS)
                        //{
                        	console.log('ifs');
                        	// Check if Single
	                        if(Player1Name != '' && Player3Name != '')
	                        {
	                            Team1Name = Player1Name;
	                            Team1NameShort = Player1Name.substr(0,3);
	                            Team2Name = Player3Name;
	                            Team2NameShort = Player3Name.substr(0,3);
	                            Team1ID = Player1ID;
	                            Team2ID = Player3ID;
	                        }
	                   //}
	                   	if(Player2Name =='Player2' && Player4Name =='Player4' )
                        {
                        	npfD = false;
                        } 	
                        //if(npfD)
                        //{
                        	console.log('ifd');
                        	// Check if Double Game Type
	                        if(Player1Name != '' && Player2Name != '' && Player3Name != '' && Player4Name != '')
		                    {	
	                            // Team1
	                            Player1NameTmp = Player1Name;
	                            Player1NameTmpShort = Player1NameTmp.substr(0,3);
	                            Player2NameTmp = Player2Name;
	                            Player2NameTmpShort = Player2NameTmp.substr(0,3);
	                            // Team 2
	                            Player3NameTmp = Player3Name;
	                            Player3NameTmpShort = Player3NameTmp.substr(0,3);
	                            Player4NameTmp = Player4Name;
	                            Player4NameTmpShort = Player4NameTmp.substr(0,3);
	                            // Concate
	                            Team1Name = Player1NameTmp+'/'+Player2NameTmp;
	                            Team1NameShort = Player1NameTmpShort+'/'+Player2NameTmpShort;
	                            Team1ID = Player1ID+'/'+Player2ID;
	                            Team2Name = Player3NameTmp+'/'+Player4NameTmp;
	                            Team2NameShort = Player3NameTmpShort+'/'+Player4NameTmpShort;
	                            Team2ID = Player3ID+'/'+Player4ID;

	                            //console.log(Player4ID);
	                        }
                        
                        //}
                        
                        
                        //console.log(Team1);
                        //console.log(Team2);
                        // Change Player1 Btn Text 
                        $('#player1-btn'+id).text(Team1NameShort);
                        // Change Player2 Btn Text 
                        $('#player2-btn'+id).text(Team2NameShort);
                        // Set Id in value property
                        $('#player1-btn'+id).val(Team1ID);
                        // Set Id in value property
                        $('#player2-btn'+id).val(Team2ID);
                    }

                }
                id++;
            }
          }

        });
}
function LoadAllTableStateResponse(callback)
{
    $.ajax({
      url:"Responses/LoadAllTableStateResponse.php",
      method:"POST",
      async:false,// To Run This First
      //data:{GameTypeID:GameTypeID,TableID:TableID},
      success:function(data){
        callback(data);
      }
    });
}
/* BCM format of GPIO */
function B1On() {
    // GPIO = 17 , ON = 1
    $.get("http://192.168.178.248:8080/18/1").done(function(data){
        console.log(data)
    });
}
function B1Off() {
    // GPIO = 17 , Off = 1
    $.get("http://192.168.178.248:8080/18/0").done(function(data){
        console.log(data)
    });
}
function B2On() {
    // GPIO = 22 , ON = 1
    $.get("http://192.168.178.248:8080/23/1").done(function(data){
        //console.log(data)
    });
}
function B2Off() {
    // GPIO = 22 , Off = 1
    $.get("http://192.168.178.248:8080/23/0").done(function(data){
        //console.log(data)
    });
}
function B3On() {
    // GPIO = 27 , ON = 1
    $.get("http://192.168.178.248:8080/24/1").done(function(data){
        //console.log(data)
    });
}
function B3Off() {
    // GPIO = 27 , Off = 1
    $.get("http://192.168.178.248:8080/24/0").done(function(data){
        //console.log(data)
    });
}
function B4On() {
    // GPIO = 27 , ON = 1
    $.get("http://192.168.178.248:8080/25/1").done(function(data){
        //console.log(data)
    });
}
function B4Off() {
    // GPIO = 27 , Off = 1
    $.get("http://192.168.178.248:8080/25/0").done(function(data){
        //console.log(data)
    });
}
function Single(id)
{
    // Turn On light TableID = 1
    // On Reload Check PauseBtn is visible
    //console.log(window['pauseBtnState'+id]);
    //console.log(window['pauseBtnStatus'+id]);
    //B1On();
    window['endBtnStatus'+id] = 1;
    if(window['pauseBtnState'+id] == 1)
    {
        //console.log('if');
        if(id == 1){
            B1Off();
        }
        // Turn On light TableID = 1
        if(id == 2){
            B2Off();
        }
        // Turn On light TableID = 1
        if(id == 3){
            B3Off();
        }
        // Turn On light TableID = 1
        if(id == 4){
            B4Off();
        }
    }
    else
    {
       if(id == 1){
            B1On();
        }
        // Turn On light TableID = 1
        if(id == 2){
            B2On();
        }
        // Turn On light TableID = 1
        if(id == 3){
            B3On();
        }
        // Turn On light TableID = 1
        if(id == 4){
            B4On();
        } 
    }
    
    
    // GameTypeID = 1 for Single in tbl = game_details
    var GameTypeID = 1;
    // id passed in parameter is TableID
    var TableID = id;
    //console.log(TableID);
    
    // In this function game is started so note StartTime,GameTypeID and insert in tbl = table_state
    InsertStartGameDetails(GameTypeID,TableID);

    LoadAllTableStateResponse(function(data){
        var jsn = $.parseJSON(data);
        // Counter for json 
        var i;
        // counter ClockTimer Variables
        var id = 1;

        for(i = 0 ; i < jsn.t.length; i++)
        {
            
            var GameTypeID = jsn.t[i].GameTypeID;

            // Check for Single Game Type
            if(GameTypeID == 1)
            {
                window['SingleClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
                //console.log(window['SingleClockFaceSeconds'+id]);
            }
            // Check for Double Game Type
            if(GameTypeID == 2)
            {
                window['DoubleClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
            }
            // Check for Timer Game Type
            if(GameTypeID == 3)
            {
                window['TimerClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
                
            }

            window['ClockFaceExtraSeconds'+id] = jsn.t[i].ClockFaceExtraSeconds;
            id++;
        }
        //console.log(data);
    });
    //$(document).fire('_page_ready');
    //console.log(window['SingleDuration'+TableID]);
    // Load Game Details
    //var data = LoadGameDetails(GameTypeID,TableID);
    // Parse the data returned from LoadGameDetails()
    // Convert JSON into JS object
    //var jsn = $.parseJSON(data);  
    // here 0 means there is only 1 object in JSON
    // JSON first element is ClockFace and convert in seconds by * with 60
    //window['SingleClockFaceSeconds'+id] = jsn.t[0].ClockFaceSeconds;
    //window['ClockFaceExtraSeconds'+id] = jsn.t[0].ClockFaceExtraSeconds;

    // Show SearchPlayer1, SearchPlayer2
    $('#searchplayer1table'+id).show();
    $('#searchplayer3table'+id).show();
    $('#check-player-div'+id).show();

    //console.log(window['SingleClockFaceSeconds'+id]);
    $('#button-div'+id).hide();
    $('#clock'+id).show();
    //debugger;
    //$('#game-control-div'+id).show();
    $('#player-div'+id).show();
    $('#end-btn'+id).show();
    $('#pause-btn'+id).show();
    /* var = id passed as param define the table number that is selected 
      clockSingle + id is the instance of clock or timer created below
    */ 
     
    window['clockSingle'+id] = $('#clock'+id).FlipClock(window['SingleClockFaceSeconds'+id],{
        countdown: true,
        clockFace: 'MinuteCounter',
        
        callbacks: {
            start: function (){
                window['ClockFaceSingleValue'+id] = setInterval(function(){
    
                    $.ajax({
                      url:"Responses/InsertClockFaceValueResponse.php",
                      method:"POST",
                      data:{GameTypeID:GameTypeID,TableID:TableID},
                      success:function(data){
                        //alert(data);
                        // Convert JSON into JS object
                        var jsn = $.parseJSON(data); 
                        // Get Clock Face Flag
                        var ClockFaceIs5Min = jsn.t[0].ClockFaceIs5Min;
                        var ClockFaceSingle = jsn.t[0].ClockFace;
                        var ClockFaceSingleEnd = jsn.t[0].ClockFaceEnd;
                        window['ClockFaceSingleIs5Min'+id] = ClockFaceIs5Min;
                        window['ClockFaceSingle'+id] = ClockFaceSingle;
                        window['ClockFaceSingleEnd'+id] = ClockFaceSingleEnd;
                        console.log(ClockFaceSingle);
                        //console.log(window['ClockFaceSingleIs5Min'+id]);
                        // If Flag == 1 means ClockFace < 5 min so Change color else Red that is for ExtaTime
                        if(window['ClockFaceSingleIs5Min'+id] == 1)
                        {
                            ChangeExtraClockColor(id,GameTypeID);
                        }
                        else
                        {
                            ChangeSingleClockColor(id);
                        }
                        if(window['ClockFaceSingle'+id] <= '00:00:02')
                        {
                            InsertEndGameDetailsTimerEnd(GameTypeID,TableID);
                            console.log('End');
                        }
                        
                      }

                    });
                }, 1000);
            },
            stop: function (){
                clearInterval(window['ClockFaceSingleValue'+id]);
                $('#pause-btn'+id).hide();
                $('#extra-btn'+id).show();
                var s = window['pauseBtnState'+id];
                //console.log(s);
                var p = $('#end-btn'+id).is(":visible");
                var len = $('#end-btn'+id).css("display");
                var len1 = $('#extra-btn'+id).css("display");
                //console.log(len);
                //console.log(len1);
                
                //console.log(window['endBtnStatus'+id]);
				var ClockFaceSingle = window['ClockFaceSingle'+id];
				InsertEndGameDetailsTimerEnd(GameTypeID,TableID);
				//var ClockFaceSingleArr = ClockFaceSingle.split(":");
				//console.log(ClockFaceSingleArr[0] + ":" + ClockFaceSingleArr[1] + ":" + ClockFaceSingleArr[2]);
				//if(ClockFaceSingleArr[0] == "00" && ClockFaceSingleArr[1] == "00" && ClockFaceSingleArr[2] == "00")
				//{
					//InsertEndGameDetailsTimerEnd(GameTypeID,TableID);
				//}
				
				
                /*if(window['pauseBtnStatus'+id] == 0){
                	console.log('Single Stop');
                    InsertEndGameDetails(GameTypeID,TableID);
                    UpdateTimerEndTableStage(id);
                }*/
                // Turn On light TableID = 1
                if(id == 1){
                    B1Off();
                }
                // Turn On light TableID = 1
                if(id == 2){
                    B2Off();
                }
                // Turn On light TableID = 1
                if(id == 3){
                    B3Off();
                }
                // Turn On light TableID = 1
                if(id == 4){
                    B4Off();
                }
            }
        }
            
    });
    

    /* var = id passed as param define the table number that is selected
       gameSingleTable defines that GameType = Single on Table = id 
       e.g id = 1 then Table = 1 & GameType = Single 
    */

    window['gameSingleTable'+id] = 1;
    window['gameSingleTableFlag'+id] = 1;
}

function Double(id)
{
    // On Reload Check PauseBtn is visible
    if(window['pauseBtnState'+id] == 1)
    {
        if(id == 1){
            B1Off();
        }
        // Turn On light TableID = 1
        if(id == 2){
            B2Off();
        }
        // Turn On light TableID = 1
        if(id == 3){
            B3Off();
        }
        // Turn On light TableID = 1
        if(id == 4){
            B4Off();
        }
    }
    else
    {
       if(id == 1){
            B1On();
        }
        // Turn On light TableID = 1
        if(id == 2){
            B2On();
        }
        // Turn On light TableID = 1
        if(id == 3){
            B3On();
        }
        // Turn On light TableID = 1
        if(id == 4){
            B4On();
        } 
    }

    $('#button-div'+id).hide();
    $('#clock'+id).show();
    //$('#game-control-div'+id).show();
    $('#player-div'+id).show();
    $('#end-btn'+id).show();
    $('#pause-btn'+id).show();
    
    // Show SearchPlayer1, SearchPlayer2, SearchPlayer3,SearchPlayer4
    $('#searchplayer1table'+id).show();
    $('#searchplayer2table'+id).show();
    $('#searchplayer3table'+id).show();
    $('#searchplayer4table'+id).show();
    $('#check-player-div'+id).show();
    //var clock;
     // GameTypeID = 2 for Double in tbl = game_details
    var GameTypeID = 2;
    // id passed in parameter is TableID
    var TableID = id;
    // In this function game is started so note StartTime,GameTypeID and insert in tbl = table_state
    InsertStartGameDetails(GameTypeID,TableID);

    LoadAllTableStateResponse(function(data){
        var jsn = $.parseJSON(data);
        // Counter for json 
        var i;
        // counter ClockTimer Variables
        var id = 1;

        for(i = 0 ; i < jsn.t.length; i++)
        {
            
            var GameTypeID = jsn.t[i].GameTypeID;

            // Check for Single Game Type
            if(GameTypeID == 1)
            {
                window['SingleClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
                //console.log(window['SingleClockFaceSeconds'+id]);
            }
            // Check for Double Game Type
            if(GameTypeID == 2)
            {
                window['DoubleClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
            }
            // Check for Timer Game Type
            if(GameTypeID == 3)
            {
                window['TimerClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
                
            }

            window['ClockFaceExtraSeconds'+id] = jsn.t[i].ClockFaceExtraSeconds;
            id++;
        }
        //console.log(data);
    });

    /* var = id passed as param define the table number that is selected 
      clockDouble + id is the instance of clock or timer created below
    */ 

    window['clockDouble'+id] = $('#clock'+id).FlipClock(window['DoubleClockFaceSeconds'+id],{
        countdown: true,
        clockFace: 'MinuteCounter',
        callbacks: {
            start: function (){
                window['ClockFaceDoubleValue'+id] = setInterval(function(){
    
                    $.ajax({
                      url:"Responses/InsertClockFaceValueResponse.php",
                      method:"POST",
                      data:{GameTypeID:GameTypeID,TableID:TableID},
                      success:function(data){
                        //alert(data);
                        // Convert JSON into JS object
                        var jsn = $.parseJSON(data); 
                        // Get Clock Face Flag
                        var ClockFaceIs5Min = jsn.t[0].ClockFaceIs5Min;
                        window['ClockFaceDoubleIs5Min'+id] = ClockFaceIs5Min;
                        //console.log(ClockFaceIs5Min);
                        // If Flag == 1 means ClockFace < 5 min so Change color else Red that is for ExtaTime
                        if(window['ClockFaceDoubleIs5Min'+id] == 1)
                        {
                            ChangeExtraClockColor(id,GameTypeID);
                        }
                        else
                        {
                            ChangeDoubleClockColor(id);
                        }
                      }

                    });
                }, 1000);
            },
            stop: function (){
                clearInterval(window['ClockFaceDoubleValue'+id]);
                $('#pause-btn'+id).hide();
                $('#extra-btn'+id).show();
                /*if(window['pauseBtnStatus'+id] == 0){
                	InsertEndGameDetails(GameTypeID,TableID);
                    UpdateTimerEndTableStage(id)
                }*/
                InsertEndGameDetailsTimerEnd(GameTypeID,TableID);
                // Turn On light TableID = 1
                if(id == 1){
                    B1Off();
                }
                // Turn On light TableID = 1
                if(id == 2){
                    B2Off();
                }
                // Turn On light TableID = 1
                if(id == 3){
                    B3Off();
                }
                // Turn On light TableID = 1
                if(id == 4){
                    B4Off();
                }
            }
        }
            
    });

    /* var = id passed as param define the table number that is selected
       gameDoubleTable defines that GameType = Single on Table = id 
       e.g id = 1 then Table = 1 & GameType = Double
    */
    window['gameDoubleTable'+id] = 1;
    window['gameDoubleTableFlag'+id] = 1;
}

function Timer(id)
{
    // On Reload  PauseBtn is visible
    if(window['pauseBtnState'+id] == 1)
    {
        if(id == 1){
            B1Off();
        }
        // Turn On light TableID = 1
        if(id == 2){
            B2Off();
        }
        // Turn On light TableID = 1
        if(id == 3){
            B3Off();
        }
        // Turn On light TableID = 1
        if(id == 4){
            B4Off();
        }
    }
    else
    {
       if(id == 1){
            B1On();
        }
        // Turn On light TableID = 1
        if(id == 2){
            B2On();
        }
        // Turn On light TableID = 1
        if(id == 3){
            B3On();
        }
        // Turn On light TableID = 1
        if(id == 4){
            B4On();
        } 
    }
    $('#button-div'+id).hide();
    $('#clock'+id).show();
    //$('#game-control-div'+id).show();
    $('#player-div'+id).show();
    $('#end-btn'+id).show();
    $('#pause-btn'+id).show();
    
    // Show SearchPlayer1
    $('#searchplayer1table'+id).show();
    $('#check-player-div'+id).show();

    //var clock;
    // GameTypeID = 3 for Timer in tbl = game_details
    var GameTypeID = 3;
    // id passed in parameter is TableID
    var TableID = id;
    // In this function game is started so note StartTime,GameTypeID and insert in tbl = table_state
    InsertStartGameDetails(GameTypeID,TableID);
    LoadAllTableStateResponse(function(data){
        var jsn = $.parseJSON(data);
        // Counter for json 
        var i;
        // counter ClockTimer Variables
        var id = 1;

        for(i = 0 ; i < jsn.t.length; i++)
        {
            
            var GameTypeID = jsn.t[i].GameTypeID;

            // Check for Single Game Type
            if(GameTypeID == 1)
            {
                window['SingleClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
                //console.log(window['SingleClockFaceSeconds'+id]);
            }
            // Check for Double Game Type
            if(GameTypeID == 2)
            {
                window['DoubleClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
            }
            // Check for Timer Game Type
            if(GameTypeID == 3)
            {
                window['TimerClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
                
            }

            window['ClockFaceExtraSeconds'+id] = jsn.t[i].ClockFaceExtraSeconds;
            id++;
        }
        //console.log(data);
    });
    /* var = id passed as param define the table number that is selected 
      clockTimer + id is the instance of clock or timer created below
    */ 
    window['clockTimer'+id] = $('#clock'+id).FlipClock(window['TimerClockFaceSeconds'+id],{
        clockFace: 'MinuteCounter',
        callbacks: {
            start: function (){
                window['ClockFaceTimerValue'+id] = setInterval(function(){
    
                    $.ajax({
                      url:"Responses/InsertClockFaceTimerValueResponse.php",
                      method:"POST",
                      data:{GameTypeID:GameTypeID,TableID:TableID},
                      success:function(data){
                       //alert(data);
                       //console.log(data);
                       ChangeTimerClockColor(id);
                      }

                    });
                }, 1000);
            },
            stop: function (){
                clearInterval(window['ClockFaceTimerValue'+id]);
                $('#pause-btn'+id).hide();
                $('#extra-btn'+id).show();
                /*if(window['pauseBtnStatus'+id] == 0){
                    InsertEndGameDetails(GameTypeID,TableID);
                    UpdateTimerEndTableStage(id)
                }*/
                //InsertEndGameDetailsTimerEnd(GameTypeID,TableID);
                // Turn On light TableID = 1
                if(id == 1){
                    B1Off();
                }
                // Turn On light TableID = 1
                if(id == 2){
                    B2Off();
                }
                // Turn On light TableID = 1
                if(id == 3){
                    B3Off();
                }
                // Turn On light TableID = 1
                if(id == 4){
                    B4Off();
                }
            }
        }
            
    });

    /* var = id passed as param define the table number that is selected
       gameTimerTable defines that GameType = Timer on Table = id 
       e.g id = 1 then Table = 1 & GameType = STimer 
    */
    window['gameTimerTable'+id] = 1;
    window['gameTimerTableFlag'+id] = 1;
}

function Pause(id)
{
    // Turn On light TableID = 1
    if(id == 1){
        B1Off();
    }
    // Turn On light TableID = 1
    if(id == 2){
        B2Off();
    }
    // Turn On light TableID = 1
    if(id == 3){
        B3Off();
    }
    // Turn On light TableID = 1
    if(id == 4){
        B4Off();
    }
    // Set Pause Button Status
    window['pauseBtnStatus'+id] = 1;
    window['pauseBtnState'+id] = 1; 
    // Check if Single is ON
    if(window['gameSingleTable'+id])
    {
        var clock = window['clockSingle'+id];
        clock.stop();
        //clearTimeout(myvar);
        // GameTypeID = 1 for Single in tbl = game_details
        var GameTypeID = 1;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertPauseGameDetails(GameTypeID,TableID);
    }
    // Check if Double is ON
    if(window['gameDoubleTable'+id])
    {
        var clock = window['clockDouble'+id];
        clock.stop();

        // GameTypeID = 2 for Double in tbl = game_details
        var GameTypeID = 2;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertPauseGameDetails(GameTypeID,TableID);
    }
    // Check if Timer is ON
    if(window['gameTimerTable'+id])
    {
        var clock = window['clockTimer'+id];
        clock.stop();

        // GameTypeID = 3 for Timer in tbl = game_details
        var GameTypeID = 3;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertPauseGameDetails(GameTypeID,TableID);
    }
    
     // Enable Play button
    $('#play-btn'+id).show();
    // Disable Pause button
    $('#pause-btn'+id).hide();
    // Disable Extra Button 
    $('#extra-btn'+id).hide();  
    
}
function Play(id)
{
    // Turn On light TableID = 1
    if(id == 1){
        B1On();
    }
    // Turn On light TableID = 1
    if(id == 2){
        B2On();
    }
    // Turn On light TableID = 1
    if(id == 3){
        B3On();
    }
    // Turn On light TableID = 1
    if(id == 4){
        B4On();
    }
    // Set Pause Button Status
    window['pauseBtnStatus'+id] = 0;
    // Set Pause Button State
    window['pauseBtnState'+id] = 0; 
    // Check if Single is ON
    if(window['gameSingleTable'+id])
    {
        var clock = window['clockSingle'+id];
        clock.start();
        
        // GameTypeID = 1 for Single in tbl = game_details
        var GameTypeID = 1;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertPlayGameDetails(GameTypeID,TableID);
    }
    // Check if Double is ON
    if(window['gameDoubleTable'+id])
    {
        var clock = window['clockDouble'+id];
        clock.start();
        // GameTypeID = 2 for Double in tbl = game_details
        var GameTypeID = 2;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertPlayGameDetails(GameTypeID,TableID);
    }
    // Check if Timer is ON
    if(window['gameTimerTable'+id])
    {
        var clock = window['clockTimer'+id];
        clock.start();
        // GameTypeID = 3 for Timer in tbl = game_details
        var GameTypeID = 3;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertPlayGameDetails(GameTypeID,TableID);
    }
 
    // Enable Pause button
    $('#pause-btn'+id).show();
    // Disable Play button
    $('#play-btn'+id).hide();
}
function End(id)
{
    // Turn Off light TableID = 1
    if(id == 1){
        B1Off();
    }
    // Turn Off light TableID = 2
    if(id == 2){
        B2Off();
    }
    // Turn Off light TableID = 3
    if(id == 3){
        B3Off();
    }
    // Turn Off light TableID = 4
    if(id == 4){
        B4Off();
    }
    // Check if Single is ON
    if(window['gameSingleTable'+id])
    {
        var clock = window['clockSingle'+id];
        clock.stop();
        // GameTypeID = 1 for Single in tbl = game_details
        var GameTypeID = 1;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertEndGameDetails(GameTypeID,TableID);
    }
    // Check if Double is ON
    if(window['gameDoubleTable'+id])
    {
        var clock = window['clockDouble'+id];
        clock.stop();
        // GameTypeID = 2 for Double in tbl = game_details
        var GameTypeID = 2;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertEndGameDetails(GameTypeID,TableID);
    }
    // Check if Timer is ON
    if(window['gameTimerTable'+id])
    {
        var clock = window['clockTimer'+id];
        clock.stop();
        // GameTypeID = 3 for Timer in tbl = game_details
        var GameTypeID = 3;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertEndGameDetails(GameTypeID,TableID);
    }
    
    // Check if Extra is ON
    if(window['gameExtraTable'+id])
    {
        var clock = window['clockExtra'+id];
        clock.stop();
        // GameTypeID = 0 for None
        var GameTypeID = 0;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertEndGameDetails(GameTypeID,TableID);
    }
    // Show Player1 Button
    $('#player1-btn'+id).show();
    // Show Player2 Button
    $('#player2-btn'+id).show();

    // Show Finish button
    //$('#finished-btn'+id).show();
    // Show Restart Button
    //$('#restart-btn'+id).show();
    // Hide End Game 
    $('#end-btn'+id).hide();
    // Disable Extra Time Button
    $('#extra-btn'+id).hide();
    // Disable Pause Button
    $('#pause-btn'+id).hide();
    // Disable Play Button
    $('#play-btn'+id).hide();
    // Disable Main Clock
    $('#clock'+id).hide();
    // Disable Extra 
    $('#extra-time-clock'+id).hide();
    // Hide Player Search
    $('#searchplayer1table'+id).hide();
    $('#searchplayer2table'+id).hide();
    $('#searchplayer3table'+id).hide();
    $('#searchplayer4table'+id).hide();
    // Disable Player Search
    $('#searchplayer1table'+id).prop('disabled',false);
    $('#searchplayer2table'+id).prop('disabled',false);
    $('#searchplayer3table'+id).prop('disabled',false);
    $('#searchplayer4table'+id).prop('disabled',false);

    // Change (8-6-17)
    $('#check-player-div'+id).hide();
    // Clear Player Name Fields

    /*window['Player1Name'+id]='';
    window['Player2Name'+id]='';
    window['Player3Name'+id]='';
    window['Player4Name'+id]='';*/
    
    Player1Name = '';
    Player2Name = '';
    Player3Name = '';
    Player4Name = '';

    $('#searchplayer1table'+id).val('');
    $('#searchplayer2table'+id).val('');
    $('#searchplayer3table'+id).val('');
    $('#searchplayer4table'+id).val('');
    
    //console.log(Team1NameShort);
    //console.log(Team2NameShort);
  
    Player1NameFlag = 0;
    Player2NameFlag = 0;
    Player3NameFlag = 0;
    Player4NameFlag = 0;

    window['gameSingleTableFlag'+id] = 0;
    window['gameDoubleTableFlag'+id] = 0;
    window['gameTimerTableFlag'+id] = 0;
    
    var CheckDiv = $('#check-player-btn'+id).parent();
    CheckDiv.removeClass("active");
    CheckDiv.removeAttr("disabled");
    $('#check-player-btn'+id).removeAttr("checked");
    // Set Pause Button Status
    window['pauseBtnStatus'+id] = 0;
    // Set Pause Button State
    window['pauseBtnState'+id] = 0; 
    window['endBtnStatus'+id] = 0;
    console.log(window['endBtnStatus'+id]);	
    window['Team1Name'+id] = 'Player1';
    window['Team2Name'+id] = 'Player2';
}
function Restart(id)
{
    var TableID = id;
    var GameTypeID;
    // Check GameType
    // Check if Single is ON
    /*var gameSingleTableFlag = window['gameSingleTableFlag'+id];
    var gameDoubleTableFlag = window['gameDoubleTableFlag'+id];
    var gameTimerTableFlag = window['gameTimerTableFlag'+id];
    //console.log(gameSingleTableFlag);
    if(gameSingleTableFlag == 1)
    {
    	Player1NameFlag = 1;
        Player3NameFlag = 1;
        console.log('ifS:');
    }
    if(gameDoubleTableFlag == 1)
    {
    	Player1NameFlag = 1;
        Player2NameFlag = 1;
        Player3NameFlag = 1;
        Player4NameFlag = 1;
        console.log('ifD:');
    }
    if(gameTimerTableFlag == 1)
    {
    	Player1NameFlag = 1;
    	console.log('ifT:');
    }
    if(window['gameSingleTable'+id])
    {
        Single(id);
    }
    // Check if Double is ON
    if(window['gameDoubleTable'+id])
    {
        Double(id);
    }
    // Check if Timer is ON
    if(window['gameTimerTable'+id])
    {
       Timer(id);
    }*/
    
    // Toggle on Check Player Button
    //$('#check-player-btn'+id).bootstrapToggle('on');
    // Set Pause Button Status
    window['pauseBtnStatus'+id] = 0;
    // Set Pause Button State
    window['pauseBtnState'+id] = 0; 
    $.ajax({
      url:"Responses/LoadAllTableStageResponse.php",
      method:"POST",
      async: false,
      //data:{GameTypeID:GameTypeID,TableID:TableID},
      success:function(data){
        
        var jsn = $.parseJSON(data); 
        var TableID = 1;
        //console.log(data);
        for(var i =  0 ; i < jsn.t.length ; i++)
        {
            if(TableID == id)
            {

            	var Player1Name = jsn.t[i].Player1Name;
            	var Player2Name = jsn.t[i].Player2Name;
            	var Player3Name = jsn.t[i].Player3Name;
            	var Player4Name = jsn.t[i].Player4Name;
            	var Player1ID = jsn.t[i].Player1ID;
            	var Player2ID = jsn.t[i].Player2ID;
            	var Player3ID = jsn.t[i].Player3ID;
            	var Player4ID = jsn.t[i].Player4ID;
            	GameTypeID = jsn.t[i].GameTypeID;
            	window['Player1Name'+id] = Player1Name;
            	window['Player2Name'+id] = Player2Name;
            	window['Player3Name'+id] = Player3Name;
            	window['Player4Name'+id] = Player4Name;
            	window['Player1ID'+id] = Player1ID;
            	window['Player2ID'+id] = Player2ID;
            	window['Player3ID'+id] = Player3ID;
            	window['Player4ID'+id] = Player4ID;
            	$('#searchplayer1table'+id).text(Player1Name);
        		$('#searchplayer2table'+id).text(Player2Name);
        		$('#searchplayer3table'+id).text(Player3Name);
        		$('#searchplayer4table'+id).text(Player4Name);
        		$('#searchplayer1table'+id).attr("placeholder",Player1Name);
        		$('#searchplayer2table'+id).attr("placeholder",Player2Name);
        		$('#searchplayer3table'+id).attr("placeholder",Player3Name);
        		$('#searchplayer4table'+id).attr("placeholder",Player4Name);
            	//console.log(GameTypeID);
            	
            	//$('#searchplayer1table'+id).css({'color':'blue'});
            }
            TableID++;
        }

      }
  	});
  	if(GameTypeID == 1)
    {
    	console.log('S');
    	Player1NameFlag = 1;
        Player3NameFlag = 1;
        Single(id);
    }
    // Check if Double is ON
    if(GameTypeID == 2)
    {
    	console.log('D');
    	Player1NameFlag = 1;
        Player2NameFlag = 1;
        Player3NameFlag = 1;
        Player4NameFlag = 1;
        Double(id);
    }
    // Check if Timer is ON
    if(GameTypeID == 3)
    {
    	console.log('T');
    	Player1NameFlag = 1;
       	Timer(id);
    }
    // Hide Finished Button
    $('#finished-btn'+id).hide();
    // Hide Restart Button
    $('#restart-btn'+id).hide();
    
  	//CheckPlayer(id);
  	//console.log('C');

  	$('#check-player-btn'+id).trigger('click');
  	
}
function ExtraTime(id)
{

    // Turn On light TableID = 1
    if(id == 1){
        B1On();
    }
    // Turn On light TableID = 2
    if(id == 2){
        B2On();
    }
    // Turn On light TableID = 3
    if(id == 3){
        B3On();
    }
    // Turn On light TableID = 4
    if(id == 4){
        B4On();
    }
    // Check if Single is ON
    if(window['gameSingleTable'+id])
    {
        // GameTypeID = 1 for Single in tbl = game_details
        var GameTypeID = 1;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertExtraTimeGameDetails(GameTypeID,TableID);
    }
    // Check if Double is ON
    if(window['gameDoubleTable'+id])
    {
        // GameTypeID = 2 for Double in tbl = game_details
        var GameTypeID = 2;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertExtraTimeGameDetails(GameTypeID,TableID);
    }
    // Check if Timer is ON
    if(window['gameTimerTable'+id])
    {
        // GameTypeID = 3 for Timer in tbl = game_details
        var GameTypeID = 3;
        // id passed in parameter is TableID
        var TableID = id;
        // In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        InsertExtraTimeGameDetails(GameTypeID,TableID);
    }
    //console.log(window['SingleDuration'+TableID]);
    // Load Game Details
    //var data = LoadGameDetails(GameTypeID,TableID);
    // Parse the data returned from LoadGameDetails()
    // Convert JSON into JS object
    //var jsn = $.parseJSON(data);  
    // here 0 means there is only 1 object in JSON
    // JSON first element is ClockFace and convert in seconds by * with 60
    //window['SingleClockFaceSeconds'+id] = jsn.t[0].ClockFaceSeconds;
    //window['ClockFaceExtraSeconds'+id] = jsn.t[0].ClockFaceExtraSeconds;

    LoadAllTableStateResponse(function(data){
        var jsn = $.parseJSON(data);
        // Counter for json 
        var i;
        // counter ClockTimer Variables
        var id = 1;

        for(i = 0 ; i < jsn.t.length; i++)
        {
            
            var GameTypeID = jsn.t[i].GameTypeID;

            // Check for Single Game Type
            if(GameTypeID == 1)
            {
                window['SingleClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
                //console.log(window['SingleClockFaceSeconds'+id]);
            }
            // Check for Double Game Type
            if(GameTypeID == 2)
            {
                window['DoubleClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
            }
            // Check for Timer Game Type
            if(GameTypeID == 3)
            {
                window['TimerClockFaceSeconds'+id] = jsn.t[i].ClockFaceSeconds;
                
            }

            window['ClockFaceExtraSeconds'+id] = jsn.t[i].ClockFaceExtraSeconds;
            console.log(window['ClockFaceExtraSeconds'+id]);
            id++;
        }
        //console.log(data);
        //window['ClockFaceExtraSeconds'+id];
        
    });

    // Disable Main Clock
    $('#clock'+id).hide();
    // Enable pause-btn
    $('#end-btn'+id).show();
    // Enable Extra Time Clock
    $('#extra-time-clock'+id).show();
    // Enable Play Button
    //$('#extra-pause-btn'+id).show();
    // Disable Extra Button
    $('#extra-btn'+id).hide();
    /* var = id passed as param define the table number that is selected 
      clockSingle + id is the instance of clock or timer created below
    */ 
    // Replace with const value below
    //window['ClockFaceExtraSeconds'+id]
    window['clockExtra'+id] = $('#extra-time-clock'+id).FlipClock(5*60,{
        countdown: true,
        clockFace: 'MinuteCounter',
        callbacks: {
            start: function (){
                window['ClockFaceExtraValue'+id] = setInterval(function(){
    
                    $.ajax({
                      url:"Responses/InsertClockFaceExtraValueResponse.php",
                      method:"POST",
                      data:{GameTypeID:GameTypeID,TableID:TableID},
                      success:function(data){
                        //alert(data);
                      }

                    });
                }, 1000);
            },
            stop: function (){
                // Enable Extra Button
                $('#extra-btn'+id).show();
                console.log(window['pauseBtnStatus'+id]);
                //if(window['pauseBtnStatus'+id] == 0){
                    UpdateTimerEndTableStage(id)
                //}
                // Stop ExtraTime Update Script
                clearInterval(window['ClockFaceExtraValue'+id]);
                // Turn On light TableID = 1
                if(id == 1){
                    B1Off();
                }
                // Turn On light TableID = 2
                if(id == 2){
                    B2Off();
                }
                // Turn On light TableID = 3
                if(id == 3){
                    B3Off();
                }
                // Turn On light TableID = 4
                if(id == 4){
                    B4Off();
                }
            }
        }
            
    });

    /* var = id passed as param define the table number that is selected
       gameSingleTable defines that GameType = Single on Table = id 
       e.g id = 1 then Table = 1 & GameType = Single 
    */
    window['gameExtraTable'+id] = 1;
   
}
function ExtraPause(id)
{
    // Check if Extra Time is ON
    if(window['gameExtraTable'+id])
    {
        var clock = window['clockExtra'+id];
        clock.stop();
    }

    // Disable Extra Pause Button
    $('#extra-pause-btn'+id).hide();
    // Enable Extra Play Button
    $('#extra-play-btn'+id).show();
}
function ExtraPlay(id)
{
    // Check if Extra Time is ON
    if(window['gameExtraTable'+id])
    {
        var clock = window['clockExtra'+id];
        clock.start();
    }
    // Enable Extra Pause Button
    $('#extra-pause-btn'+id).show();
    // Disable Extra Play Button
    $('#extra-play-btn'+id).hide();
}
function CheckPlayer(id)
{
    var TableID = id;
    Team1NameShort = 'Player1';
    Team2NameShort = 'Player2';
    var CheckDiv = $('#check-player-btn'+id).parent();
    CheckDiv.addClass('active');
    $('#check-player-btn'+id).attr("checked","checked");
    if($('#check-player-btn'+id).is(':checked'))
    {
        console.log('ifc');
        CheckDiv.attr("disabled","disabled");
        // Local Var for PlayerIDs
        var Player1ID='',Player2ID='',Player3ID='',Player4ID='';
        // Local Var for PlayerNames
        var Player1Name='',Player2Name='',Player3Name='',Player4Name='';
        
        // Check if Variable was created or not
        if(typeof window['Player1ID'+id] != 'undefined')
        {
            Player1ID = window['Player1ID'+id];
            //console.log(Player1ID);
        }
        if(typeof window['Player2ID'+id] != 'undefined')
        {
            Player2ID = window['Player2ID'+id];
            //console.log(Player2ID);
        }
        if(typeof window['Player3ID'+id] != 'undefined')
        {
            Player3ID = window['Player3ID'+id];
            //console.log(Player3ID);
        }
        if(typeof window['Player4ID'+id] != 'undefined')
        {
            Player4ID = window['Player4ID'+id];
            //console.log(Player4ID);
        }

        if(typeof window['Player1Name'+id] != 'undefined')
        {
            Player1Name = window['Player1Name'+id];
            //console.log(Player1ID);
        }
        if(typeof window['Player2Name'+id] != 'undefined')
        {
            Player2Name = window['Player2Name'+id];
            //console.log(Player2ID);
        }
        if(typeof window['Player3Name'+id] != 'undefined')
        {
            Player3Name = window['Player3Name'+id];
            //console.log(Player3ID);
        }
        if(typeof window['Player4Name'+id] != 'undefined')
        {
            Player4Name = window['Player4Name'+id];
            //console.log(Player4ID);
        }
        
        // Check if Timer 
        //if(typeof window['Player1Name'+id] != 'undefined')
        if(window['gameTimerTableFlag'+id] == 1)
        {
        	console.log('Timer:');
            Team1Name = Player1Name;
            // Get First three letters
            if(Player1NameFlag == 1)
            {
            	Player1Name = window['Player1Name'+id];
                Player2Name = Player1Name;
                Player2ID = Player1ID
            	Team1NameShort = Player1Name.substr(0,3);
            	Team1ID = Player1ID;
                Team2Name = Player1Name;
            	Team2NameShort = Player1Name.substr(0,3);
            	Team2ID = Player1ID;
            	window['Team1Name'+id] = Team1Name;
            	window['Team2Name'+id] = Team1Name;
            } 
            else
            {
            	Player1Name = 'Player1';
            	Player2Name = 'Player2';
            	Player3Name = 'Player3';
            	Player4Name = 'Player4';
            	Player1ID = '0';
            	Player2ID = '0';
            	Player3ID = '0';
            	Player4ID = '0';
            	Team1NameShort = 'Player1';
            	Team2NameShort = 'Player2';
            	Team1ID = '0';
            	Team2ID = '0';
            }
            
            console.log('Timer:'+Team1NameShort);
        }

        // Check if Single
        //if(typeof window['Player1Name'+id] != 'undefined' && typeof window['Player3Name'+id] != 'undefined')
        if(window['gameSingleTableFlag'+id] == 1)
        {
        	console.log('Single:');
            Team1Name = Player1Name;
            Team2Name = Player3Name;
            if(Player1NameFlag == 1 && Player3NameFlag == 1)
            {
            	Player1Name = window['Player1Name'+id];
            	Player3Name = window['Player3Name'+id];
            	Team1NameShort = Player1Name.substr(0,3);
	            Team2NameShort = Player3Name.substr(0,3);
	            Team1ID = Player1ID;
	            Team2ID = Player3ID;
	            window['Team1Name'+id] = Team1Name;
            	window['Team2Name'+id] = Team2Name;
	            console.log(window['Player1Name'+id]);
            }
            else
            {
            	Player1Name = 'Player1';
            	Player2Name = 'Player2';
            	Player3Name = 'Player3';
            	Player4Name = 'Player4';
            	Player1ID = '0';
            	Player2ID = '0';
            	Player3ID = '0';
            	Player4ID = '0';
            	Team1NameShort = 'Player1';
            	Team2NameShort = 'Player2';
            	Team1ID = '0';
            	Team2ID = '0';
            }
            console.log('Single:'+Team1NameShort);
        }
        // Check if Double Game Type
        //if(typeof window['Player1Name'+id] != 'undefined' && typeof window['Player2Name'+id] != 'undefined' && typeof window['Player3Name'+id] != 'undefined' && typeof window['Player4Name'+id] != 'undefined')
        if(window['gameDoubleTableFlag'+id] == 1)
        {
        	console.log('Double:');
        	if(Player1NameFlag == 1 && Player2NameFlag == 1 && Player3NameFlag == 1 && Player4NameFlag == 1)
        	{
        		// Team1
	            Player1NameTmp = window['Player1Name'+id];
	            Player1NameTmpShort = Player1NameTmp.substr(0,3);
	            Player2NameTmp = window['Player2Name'+id];
	            Player2NameTmpShort = Player2NameTmp.substr(0,3);
	            // Team 2
	            Player3NameTmp = window['Player3Name'+id];
	            Player3NameTmpShort = Player3NameTmp.substr(0,3);
	            Player4NameTmp = window['Player4Name'+id];
	            Player4NameTmpShort = Player4NameTmp.substr(0,3);
	            // Concate
	            Team1Name = Player1NameTmp+'/'+Player2NameTmp;
	            Team1NameShort = Player1NameTmpShort+'/'+Player2NameTmpShort;
	            Team1ID = Player1ID+'/'+Player2ID;
	            Team2Name = Player3NameTmp+'/'+Player4NameTmp;
	            Team2NameShort = Player3NameTmpShort+'/'+Player4NameTmpShort;
	            Team2ID = Player3ID+'/'+Player4ID;
	            window['Team1Name'+id] = Team1Name;
            	window['Team2Name'+id] = Team2Name;
        	}
        	else
        	{
        		Player1Name = 'Player1';
            	Player2Name = 'Player2';
            	Player3Name = 'Player3';
            	Player4Name = 'Player4';
            	Player1ID = '0';
            	Player2ID = '0';
            	Player3ID = '0';
            	Player4ID = '0';
        		Team1NameShort = 'Player1';
            	Team2NameShort = 'Player2';
            	Team1ID = '0';
            	Team2ID = '0';
        	}

            console.log('Double:'+Team1NameShort);
            //console.log(Player4ID);
        }
        
        //console.log(Team1);
        //console.log(Team2);
        // Change Player1 Btn Text

        $('#player1-btn'+id).text(Team1NameShort);
        // Change Player2 Btn Text 
        $('#player2-btn'+id).text(Team2NameShort);
        // Set Id in value property
        $('#player1-btn'+id).val(Team1ID);
        // Set Id in value property
        $('#player2-btn'+id).val(Team2ID);

        // Disable CheckPlayerBtn
        //$('#check-player-div'+id).hide();
        // Disable PlayerSearch
        //console.log($('#searchplayer1table'+id).val());
        $('#searchplayer1table'+id).prop('disabled',true);
        $('#searchplayer2table'+id).prop('disabled',true);
        $('#searchplayer3table'+id).prop('disabled',true);
        $('#searchplayer4table'+id).prop('disabled',true);
        // Hide Result List
        $('#resultplayer1table'+id).html('');
        $('#resultplayer2table'+id).html('');
        $('#resultplayer3table'+id).html('');
        $('#resultplayer4table'+id).html('');
        // Turn Off (Initial Stage)
        //$('#check-player-btn'+id).bootstrapToggle('off');
        // UpdateCheckPlayerStage, tbl = table_state, reftbl = player_stage_stage
        $.ajax({
          url:"Responses/UpdateCheckPlayerStage.php",
          method:"POST",
          data:{TableID:TableID},
          success:function(data){
            //alert(data);
          }

        });

        // Update PlayerIds and PlayerNames in game_transactions
        $.ajax({
          url:"Responses/UpdatePlayerDetails.php",
          method:"POST",
          data:{TableID:TableID,Player1ID:Player1ID,Player1Name:Player1Name,Player2ID:Player2ID,Player2Name:Player2Name,Player3ID:Player3ID,Player3Name:Player3Name,Player4ID:Player4ID,Player4Name:Player4Name},
          success:function(data){
            //alert(data);
          }
        });

    }
}

function Finished(id)
{
    $('#button-div'+id).show();
    $('#player-div'+id).hide();
    $('#finished-btn'+id).hide();
    $('#restart-btn'+id).hide();
    $('#player1-btn'+id).hide();
    $('#player2-btn'+id).hide();
    $('#check-player-btn'+id).show();
    var TableID = id;
     // Update TableStage to Default i.e NULL
    $.ajax({
      url:"Responses/UpdateDefaultTableStage.php",
      method:"POST",
      data:{TableID:TableID},
      success:function(data){
        //alert(data);
      }

    });

}
function Player1(id)
{
    // Show Finish button
    $('#finished-btn'+id).show();
    // Show Restart Button
    $('#restart-btn'+id).show();
    // Hide Player1 
    $('#player1-btn'+id).hide();
    // Hide Player2 
    $('#player2-btn'+id).hide();

    // if Player1 Button is clicked then Winner = Player1
    // Get PlayerID i.e WinnerID
    var WinnerID = $('#player1-btn'+id).val();
    //console.log(Team1ID);
    //console.log(Team2ID);
    //console.log(Team1Name);
    //console.log(Team2Name);
    //var WinnerID = Team1ID;
    // Get PlayerName i.e WinnerName
    //var WinnerName = $('#player1-btn'+id).text();
    //console.log(window['Player1Name'+id]);
    var WinnerName = window['Team1Name'+id];
    console.log(WinnerName);
    //console.log(WinnerID);
    //var WinnerName = Team1Name;
    // Gey LoserID i.e LoserID
    var LoserID = $('#player2-btn'+id).val();
    //var LoserID = Team2ID;
    // Get PlayerName i.e LoserName
    var LoserName = window['Team2Name'+id];
    console.log(LoserName);
    var TableID = id;
    // UpdateChooseWinnerTableStage
    $.ajax({
      url:"Responses/UpdateChooseWinnerTableStage.php",
      method:"POST",
      data:{WinnerID:WinnerID,WinnerName:WinnerName,LoserID:LoserID,LoserName:LoserName,TableID:TableID},
      success:function(data){
        //alert(data);
      }

    });
}
function Player2(id)
{
    // Show Finish button
    $('#finished-btn'+id).show();
    // Show Restart Button
    $('#restart-btn'+id).show();
    // Hide Player1 
    $('#player1-btn'+id).hide();
    // Hide Player2 
    $('#player2-btn'+id).hide();
    // if Player2 Button is clicked then Winner = Player1
    //console.log(Team2ID);
    // Get PlayerID i.e WinnerID
    var WinnerID = $('#player2-btn'+id).val();
    //var WinnerID = Team2ID;
    // Get PlayerName i.e WinnerName
    var WinnerName = window['Team2Name'+id];
    //var WinnerName = Team2Name;
    // Get PlayerID i.e LoserID
    var LoserID = $('#player1-btn'+id).val();
    //var LoserID = Team1ID;
    // Get PlayerName i.e WinnerName
    var LoserName = window['Team1Name'+id];
    //var LoserName = Team1Name;
    var TableID = id;
    // UpdateChooseWinnerTableStage
    $.ajax({
      url:"Responses/UpdateChooseWinnerTableStage.php",
      method:"POST",
      data:{WinnerID:WinnerID,WinnerName:WinnerName,LoserID:LoserID,LoserName:LoserName,TableID:TableID},
      success:function(data){
        //alert(data);
      }

    });
}
function InsertStartGameDetails(GameTypeID,TableID)
{
    /*  In this function game is started so note StartTime,GameTypeID and insert in tbl = table_state
        This AJAX will insert StartTime in tbl = table_state based on GameTypeID
        GameTypeID = 1 (Single),GameTypeID = 2 (Double),GameTypeID = 3 (Timer) given in lookup tbl = game_details
    */
    
    $.ajax({
      url:"Responses/InsertStartGameDetailsResponse.php",
      method:"POST",
      async: false,
      data:{GameTypeID:GameTypeID,TableID:TableID},
      success:function(data){
       //alert(data);
            //console.log(data);
        }
    });
}
function InsertPauseGameDetails(GameTypeID,TableID)
{
    /*  In this function game is paused so note PauseTime,GameTypeID and insert in tbl = table_state
        This AJAX will insert StartTime in tbl = table_state based on GameTypeID
        GameTypeID = 1 (Single),GameTypeID = 2 (Double),GameTypeID = 3 (Timer) given in lookup tbl = game_details
    */

    $.ajax({
      url:"Responses/InsertPauseGameDetailsResponse.php",
      method:"POST",
      data:{GameTypeID:GameTypeID,TableID:TableID},
      success:function(data){
       //alert(data);
      }
    });
}
function InsertPlayGameDetails(GameTypeID,TableID)
{
    /*  In this function game is paused so note PlayTime,GameTypeID and insert in tbl = table_state
        This AJAX will insert StartTime in tbl = table_state based on GameTypeID
        GameTypeID = 1 (Single),GameTypeID = 2 (Double),GameTypeID = 3 (Timer) given in lookup tbl = game_details
    */

    $.ajax({
      url:"Responses/InsertPlayGameDetailsResponse.php",
      method:"POST",
      data:{GameTypeID:GameTypeID,TableID:TableID},
      success:function(data){
       //console.log(data);
      }
    });
}
function InsertEndGameDetails(GameTypeID,TableID)
{
    /*  In this function game is paused so note PlayTime,GameTypeID and insert in tbl = table_state
        This AJAX will insert StartTime in tbl = table_state based on GameTypeID
        GameTypeID = 1 (Single),GameTypeID = 2 (Double),GameTypeID = 3 (Timer) given in lookup tbl = game_details
    */

    $.ajax({
      url:"Responses/InsertEndGameDetailsResponse.php",
      method:"POST",
      data:{GameTypeID:GameTypeID,TableID:TableID},
      success:function(data){
       //alert(data);
      }
    });
}
function InsertEndGameDetailsTimerEnd(GameTypeID,TableID)
{
    /*  In this function game time is ended so note EndTime,GameTypeID and insert in tbl = table_state
        This AJAX will insert EndTime in tbl = table_state based on GameTypeID
        GameTypeID = 1 (Single),GameTypeID = 2 (Double),GameTypeID = 3 (Timer) given in lookup tbl = game_details
    */

    $.ajax({
      url:"Responses/InsertEndGameDetailsTimerEndResponse.php",
      method:"POST",
      data:{GameTypeID:GameTypeID,TableID:TableID},
      success:function(data){
       //alert(data);
      }
    });
}
function InsertExtraTimeGameDetails(GameTypeID,TableID)
{
    /*  In this function game is paused so note ExtraTime,GameTypeID and insert in tbl = table_state
        This AJAX will insert ExtraTime in tbl = table_state based on GameTypeID
        GameTypeID = 1 (Single),GameTypeID = 2 (Double),GameTypeID = 3 (Timer) given in lookup tbl = game_details
    */

    $.ajax({
      url:"Responses/InsertExtraTimeGameDetailsResponse.php",
      method:"POST",
      data:{GameTypeID:GameTypeID,TableID:TableID},
      success:function(data){
       //alert(data);
      }
    });
}
function UpdateTimerEndTableStage(TableID)
{
    // UpdateTimerEndTableStage
    $.ajax({
      url:"Responses/UpdateTimerEndTableStageResponse.php",
      method:"POST",
      data:{TableID:TableID},
      success:function(data){
       //alert(data);
      }
    });
}
function ChangeSingleClockColor(id)
{
    // inn class
    //$('#clock1').children().first().next().children().first().next().children().first().children().first().next().children().first().next().addClass('single-bg');
    
    /*
        Changing color property of '.div.inn', '.flip-clock-dot', '.flip-clock-divider' in 'flipclock.css' provides desired color 
        Find 'div.inn' in id='clock'+id and apply 'single-bg' class that has color = 'yellow'
        Find '.flip-clock-dot' in id='clock'+id and apply 'single-dot' class that has color = 'yellow'
        Find '.flip-clock-divider' in id='clock'+id and apply 'single-label' class that has color = 'yellow'
    */
    $('#clock'+id).find('div.inn').addClass('single-bg');
    $('#clock'+id).find('.flip-clock-dot').addClass('single-dot');
    $('#clock'+id).find('.flip-clock-divider').addClass('single-label');
}
function ChangeDoubleClockColor(id)
{
    /*
        Changing color property of '.div.inn', '.flip-clock-dot', '.flip-clock-divider' in 'flipclock.css' provides desired color 
        Find 'div.inn' in id='clock'+id and apply 'double-bg' class that has color = 'blue'
        Find '.flip-clock-dot' in id='clock'+id and apply 'double-dot' class that has color = 'blue'
        Find '.flip-clock-divider' in id='clock'+id and apply 'double-label' class that has color = 'blue'
    */
    $('#clock'+id).find('div.inn').addClass('double-bg');
    $('#clock'+id).find('.flip-clock-dot').addClass('double-dot');
    $('#clock'+id).find('.flip-clock-divider').addClass('double-label');
}
function ChangeTimerClockColor(id)
{
    /*
        Changing color property of '.div.inn', '.flip-clock-dot', '.flip-clock-divider' in 'flipclock.css' provides desired color 
        Find 'div.inn' in id='clock'+id and apply 'timer-bg' class that has color = 'grey'
        Find '.flip-clock-dot' in id='clock'+id and apply 'timer-dot' class that has color = 'grey'
        Find '.flip-clock-divider' in id='clock'+id and apply 'timer-label' class that has color = 'grey'
    */
    $('#clock'+id).find('div.inn').addClass('timer-bg');
    $('#clock'+id).find('.flip-clock-dot').addClass('timer-dot');
    $('#clock'+id).find('.flip-clock-divider').addClass('timer-label');
}
function ChangeExtraClockColor(id,GameTypeID){
    /*
        Using color property of '.div.inn', '.flip-clock-dot', '.flip-clock-divider' in 'flipclock.css' provides desired color 
        Find 'div.inn' in id='clock'+id and reomve 'single-bg' class that has color = 'yellow'
        Find '.flip-clock-dot' in id='clock'+id and remove 'single-dot' class that has color = 'yellow'
        Find '.flip-clock-divider' in id='clock'+id and remove 'single-label' class that has color = 'yellow'
    */
    // GameTypeID == 1 means SingleGameType
    if(GameTypeID == 1)
    {
        $('#clock'+id).find('div.inn').removeClass('single-bg');
        $('#clock'+id).find('.flip-clock-dot').removeClass('single-dot');
        $('#clock'+id).find('.flip-clock-divider').removeClass('single-label');
    }
    /*
        Using color property of '.div.inn', '.flip-clock-dot', '.flip-clock-divider' in 'flipclock.css' provides desired color 
        Find 'div.inn' in id='clock'+id and reomve 'double-bg' class that has color = 'blue'
        Find '.flip-clock-dot' in id='clock'+id and remove 'double-dot' class that has color = 'blue'
        Find '.flip-clock-divider' in id='clock'+id and remove 'double-label' class that has color = 'blue'
    */
    // GameTypeID == 2 means GameType
    if(GameTypeID == 2)
    {
        $('#clock'+id).find('div.inn').removeClass('double-bg');
        $('#clock'+id).find('.flip-clock-dot').removeClass('double-dot');
        $('#clock'+id).find('.flip-clock-divider').removeClass('double-label');
    }
}
function SearchPlayer1(id)
{

  $('#resultplayer1table'+id).html('');
  //$('#state-'+id).val('');
  var searchField = $('#searchplayer1table'+id).val();
  var expression = new RegExp(searchField, "i");
  
  $.ajax({
      url:"Responses/LoadPlayersResponse.php",
      method:"POST",
      data:{searchField:searchField},
      success:function(data){
        //alert(data);
        // Convert JSON into JS object
        var jsn = $.parseJSON(data); 
        var liCount = 1;
        for(var i = 0 ; i < jsn.t.length ; i++)
        {
          var PlayerID = jsn.t[i].PlayerID;
          var PlayerName = jsn.t[i].PlayerName;
          var PhoneNumber = jsn.t[i].PhoneNumber;
          $('#resultplayer1table'+id).append('<li id="player'+liCount+'" style="font-size:9px;padding: 3px 3px 3px 3px;cursor:pointer" class="list-group-item link-class" onclick="PlayerNameClick1('+liCount+','+id+')"><span style="display:none";>'+PlayerID+'-</span><span class="text-muted">'+PlayerName+'</span><span class="text-muted">-(+92'+PhoneNumber+')</span></li>');
          liCount++;
          
        }
        
      }

    });
}
function SearchPlayer2(id)
{

  $('#resultplayer2table'+id).html('');
  //$('#state-'+id).val('');
  var searchField = $('#searchplayer2table'+id).val();
  var expression = new RegExp(searchField, "i");
  
  $.ajax({
      url:"Responses/LoadPlayersResponse.php",
      method:"POST",
      data:{searchField:searchField},
      success:function(data){
        //alert(data);
        // Convert JSON into JS object
        var jsn = $.parseJSON(data); 
        var liCount = 1;
        for(var i = 0 ; i < jsn.t.length ; i++)
        {
          var PlayerID = jsn.t[i].PlayerID;
          var PlayerName = jsn.t[i].PlayerName;
          var PhoneNumber = jsn.t[i].PhoneNumber;
          $('#resultplayer2table'+id).append('<li id="player'+liCount+'" style="font-size:9px;padding: 3px 3px 3px 3px;cursor:pointer" class="list-group-item link-class" onclick="PlayerNameClick2('+liCount+','+id+')"><span style="display:none";>'+PlayerID+'-</span><span class="text-muted">'+PlayerName+'</span><span class="text-muted">-(+92'+PhoneNumber+')</span></li>');
          liCount++;
          
        }
        
      }

    });
}
function SearchPlayer3(id)
{

  $('#resultplayer3table'+id).html('');
  //$('#state-'+id).val('');
  var searchField = $('#searchplayer3table'+id).val();
  var expression = new RegExp(searchField, "i");
  
  $.ajax({
      url:"Responses/LoadPlayersResponse.php",
      method:"POST",
      data:{searchField:searchField},
      success:function(data){
        //alert(data);
        // Convert JSON into JS object
        var jsn = $.parseJSON(data); 
        var liCount = 1;
        for(var i = 0 ; i < jsn.t.length ; i++)
        {
          var PlayerID = jsn.t[i].PlayerID;
          var PlayerName = jsn.t[i].PlayerName;
          var PhoneNumber = jsn.t[i].PhoneNumber;
          $('#resultplayer3table'+id).append('<li id="player'+liCount+'" style="font-size:9px;padding: 3px 3px 3px 3px;cursor:pointer" class="list-group-item link-class" onclick="PlayerNameClick3('+liCount+','+id+')"><span style="display:none";>'+PlayerID+'-</span><span class="text-muted">'+PlayerName+'</span><span class="text-muted">-(+92'+PhoneNumber+')</span></li>');
          liCount++;
          
        }
        
      }

    });
}
function SearchPlayer4(id)
{

  $('#resultplayer4table'+id).html('');
  //$('#state-'+id).val('');
  var searchField = $('#searchplayer4table'+id).val();
  var expression = new RegExp(searchField, "i");
  
  $.ajax({
      url:"Responses/LoadPlayersResponse.php",
      method:"POST",
      data:{searchField:searchField},
      success:function(data){
        //alert(data);
        // Convert JSON into JS object
        var jsn = $.parseJSON(data); 
        var liCount = 1;
        for(var i = 0 ; i < jsn.t.length ; i++)
        {
          var PlayerID = jsn.t[i].PlayerID;
          var PlayerName = jsn.t[i].PlayerName;
          var PhoneNumber = jsn.t[i].PhoneNumber;
          $('#resultplayer4table'+id).append('<li id="player'+liCount+'" style="font-size:9px;padding: 3px 3px 3px 3px;cursor:pointer" class="list-group-item link-class" onclick="PlayerNameClick4('+liCount+','+id+')"><span style="display:none">'+PlayerID+'-</span><span class="text-muted">'+PlayerName+'</span><span class="text-muted">-(+92'+PhoneNumber+')</span></li>');
          liCount++;
          
        }
        
      }

    });
}
function PlayerNameClick1(liCount,id)
{
    // Get li text
    var click_text = $('#player'+liCount).text();
    // First Span has PlayerID, Remove any dashes
    var PlayerID = $('#player'+liCount).find('span:first').text().replace(/-/g, "");
    /* Second Span has PlayerName, Remove any dashes
        List Structure
        <li>
            <span>PlayerID</span>
            <span>PlayerName</span>
        </li>

    */
    var PlayerName = $('#player'+liCount).children().first().next().text().replace(/-/g, "");
    // Create List of PlayerNames
    var PlayerNames = click_text.substring(click_text.indexOf('-')+1);
    $('#searchplayer1table'+id).val(PlayerNames);
    $("#resultplayer1table"+id).html('');

    console.log('PN:'+PlayerName);
    // Set Dynamic Variables for PlayerID, PlayerName
    window['Player1ID'+id] = PlayerID;
    window['Player1Name'+id] = PlayerName;
    Player1NameFlag = 1;
   
}
function PlayerNameClick2(liCount,id)
{
    // Get li text
    var click_text = $('#player'+liCount).text();
     // First Span has PlayerID, Remove any dashes
    var PlayerID = $('#player'+liCount).find('span:first').text().replace(/-/g, "");
    /* Second Span has PlayerName, Remove any dashes
        List Structure
        <li>
            <span>PlayerID</span>
            <span>PlayerName</span>
        </li>

    */
    var PlayerName = $('#player'+liCount).children().first().next().text().replace(/-/g, "");
    // Create List of PlayerNames
    var PlayerNames = click_text.substring(click_text.indexOf('-')+1);
    $('#searchplayer2table'+id).val(PlayerNames);
    $("#resultplayer2table"+id).html('');

    // Set Dynamic Variables for PlayerID, PlayerName
    window['Player2ID'+id] = PlayerID;
    window['Player2Name'+id] = PlayerName;
	Player2NameFlag = 1;   
}
function PlayerNameClick3(liCount,id)
{
    // Get li text
    var click_text = $('#player'+liCount).text();
     // First Span has PlayerID, Remove any dashes
    var PlayerID = $('#player'+liCount).find('span:first').text().replace(/-/g, "");
    /* Second Span has PlayerName, Remove any dashes
        List Structure
        <li>
            <span>PlayerID</span>
            <span>PlayerName</span>
        </li>

    */
    var PlayerName = $('#player'+liCount).children().first().next().text().replace(/-/g, "");
    // Create List of PlayerNames
    var PlayerNames = click_text.substring(click_text.indexOf('-')+1);
    $('#searchplayer3table'+id).val(PlayerNames);
    $("#resultplayer3table"+id).html('');

    // Set Dynamic Variables for PlayerID, PlayerName
    window['Player3ID'+id] = PlayerID;
    window['Player3Name'+id] = PlayerName;
   	Player3NameFlag = 1;
}
function PlayerNameClick4(liCount,id)
{
     // Get li text
    var click_text = $('#player'+liCount).text();
     // First Span has PlayerID, Remove any dashes
    var PlayerID = $('#player'+liCount).find('span:first').text().replace(/-/g, "");
    /* Second Span has PlayerName, Remove any dashes
        List Structure
        <li>
            <span>PlayerID</span>
            <span>PlayerName</span>
        </li>

    */
    var PlayerName = $('#player'+liCount).children().first().next().text().replace(/-/g, "");
    // Create List of PlayerNames
    var PlayerNames = click_text.substring(click_text.indexOf('-')+1);
    $('#searchplayer4table'+id).val(PlayerNames);
    $("#resultplayer4table"+id).html('');

    // Set Dynamic Variables for PlayerID, PlayerName
    window['Player4ID'+id] = PlayerID;
    window['Player4Name'+id] = PlayerName;
    Player4NameFlag = 1;
}