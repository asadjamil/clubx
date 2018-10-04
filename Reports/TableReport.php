

<?php
    
    session_start();
    $username = $_SESSION["UserName"];
    $AccessLevel = $_SESSION["AccessLevel"];
    // Check if Session has username and it is not empty
    
    if(!(isset($_SESSION["UserName"]) && $_SESSION["UserName"]!='' ))
    {   
        header('Location: index.html');
        exit;
    }
    if($AccessLevel != 1)
    {
        header('Location: ../error.php');
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/clubx-favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Report | Table</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" />

        <!-- Fonts and icons     -->
        <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>-->
        <link href="../assets/css/template-font.css">

        <!--DATETIME PICKER CSS START-->
        <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/bootstrap-datetimepicker.min.css">
        <!--DATETIME PICKER CSS END-->

    </head>
   
   <body>
         
        <div class="container">
               <div class="row">
                    <div class="col-md-12">
                    <img src = "../assets/img/logo.png" class="img-responsive img-rounded center-block" width="100" alt="">
                    <h3 align="center">Table Report</h3>
                    <h4 align="center">
                            <small>                     
                            <!--<?php //echo $_GET['dtfrom']."  to  ".$_GET['dtto'];?> -->
                            </small>                    
                    </h4>
                </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label" for="dtfrom">From</label>
                        <div class="input-append date">
                            <div id="dfrom" class="input-group">
                                <input class="form-control" name="dtfrom" id="dtfrom" type="text">
                                <div class="input-group-btn add-on"> 
                                    <button class="btn btn-gold"><i class="fa fa-calendar-o" aria-hidden="true"></i>
                                    </button>  
                                </div>
                                
                            </div>    
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" >TABLE NO.</label>
                        <select class="form-control" id="tableNoSelect">
                            
                        </select>
                    </div>
                    <div class="col-md-3">

                       <label class="control-label" for="dtto">To</label>
                        <div class="input-append date">
                            <div id="dto" class="input-group">
                                <input class="form-control" name="dtto" id="dtto" type="text">
                                <div class="input-group-btn add-on"> 
                                    <button class="btn btn-primary"><i class="fa fa-calendar-o" aria-hidden="true"></i>
                                    </button>  

                                </div>
                                <div class="input-group-btn">
                                <button class="btn btn-info" id="Submit" onclick="">Submit</button>
                                </div>    
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        
                    </div>
                    
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-info"></h5>
                            <table id="sMatchTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="30">Sr No.</th>
                                        <th width="50">Game Date</th>
                                        <th width="50">Game Type</th>
                                        <th width="50">Table No.</th>
                                        <th width="50">Start Time</th>
                                        <th width="50">Pause Time</th>
                                        <th width="50">Resume Time</th>
                                        <th width="50">End Time</th>
                                        <th width="75">Total Pause Time</th>
                                        <th width="75">Total Extra Time</th>
                                        <th width="30">Total Time(Min)</th>
                                        <th width="30">Light Time(Min)</th>
                                        <th width="50">Winner</th>
                                        <th width="50">Loser</th>
                                    </tr>
                                </thead>
                                  
                                <tbody>
                                <!--
                                    <?php  
                                        //WRITE PHP CODE HERE TO FETCH VALUES FROM DB ON DATE BASIS
                                    ?>
                                  -->
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
            <!--</form> -->
        </div>   
        
    	 
        <!--   Core JS Files   -->
        <script src="../assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Date Picker Initialization -->
        <script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.pt-BR.js"></script>
        
        <script type="text/javascript">
        var NoOfTables;
         $('#dfrom').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
          });
          $('#dto').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
          });
          $.ajax({
                
                url:"../Responses/LoadClubSizeResponse.php",
                method:"POST",
                success:function(data){
                    //alert(data);
                    var jsn = $.parseJSON(data);
                    NoOfTables = jsn.t[0].NoOfTables;
                    //alert(NoOfTables);
                    for(i = 1; i <= NoOfTables ; i++)
                    {
                        //console.log('hi');
                        $('#tableNoSelect').append($('<option>', {
                            value: i,
                            text: i
                        }));   
                    }
                }
           });
           
           $('#Submit').click(function(){
            var TableNo = $('#tableNoSelect').find(':selected').text();
            var dtfrom = $('#dtfrom').val();
            var dtto = $('#dtto').val();
            $.ajax({
                
                url:"TableReportResponse.php",
                method:"POST",
                data:{TableNo:TableNo,dtfrom:dtfrom,dtto:dtto},
                success:function(data){
                    //alert(data);
                    $('#sMatchTable tbody').html(data);
                }
              });
            });
        </script>
        
    
   </body>
        
</html>