<?php
    
    /*session_start();
    $username = $_SESSION["UserName"];
    $AccessLevel = $_SESSION["AccessLevel"];
    // Check if Session has username and it is not empty
    if(!(isset($_SESSION["UserName"]) && $_SESSION["UserName"]!=''))
    {   
        header('Location: login.html');
        exit;
    }*/

    /* Check if NoOfTable is entered before in database = sms, table = club_size
    	Then redirect to dashboard or home
    */	
    $NoOfTables = 0;	
    require('connection.php');
    $sql = "SELECT NoOfTables FROM club_size";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result);
    
    if($rows == 1)
    {
        $row=mysqli_fetch_assoc($result);
        $NoOfTables = $row['NoOfTables'];
    }

    if($NoOfTables > 0)
    {
    	header('Location: dashboard.php');
    	exit;
    }

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Snooker App | Activation</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="assets/img/clubx-favicon.ico" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="assets/css/demo-ui.css">
</head>

<body>
	<div class="image-container set-full-height" style="background-image: url('assets/img/snooker-background.jpg')">
	    <!--   Creative Tim Branding   -->
	    <a href="#">
	         <div class="logo-container">
	            <div class="logo">
	                <img src="assets/img/logo.png">
	            </div>
	            <!--<div class="brand">
	                Club X
	            </div>-->
	        </div>
	    </a>

		<!--  Made With Material Kit  -->
		<a href="#" class="made-with-mk">
			<div class="brand">SS</div>
			<div class="made-with">Made with <strong>Solver Systems</strong></div>
		</a>

	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container" >
		                <div class="card wizard-card" data-color="red" id="wizard">
		                    <!--<form action="" method="">-->
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->
		                    
		                    	<img src="assets/img/logo.png" alt="Rounded Image" class="img-circle img-responsive" style="margin:0 auto;">
		                    	
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#details" data-toggle="tab">Club Size</a></li>
			                            <!--<li><a href="#captain" data-toggle="tab">Cash</a></li>-->
			                            <!--<li><a href="#description" data-toggle="tab">Extra Details</a></li>-->
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="details">
		                            	<div class="row">
		                                	<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Club Size</label>
			                                          	<input name="name" id="clubSize" type="number" class="form-control" min="1">
			                                          	
			                                        </div>
												</div>
		                                	</div>
		                            	</div>
		                            </div>
		                            <!--
		                            <div class="tab-pane" id="captain">
		                                <div class="row">
		                                    <div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock</i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Password</label>
			                                          	<input name="name" type="text" class="form-control">
			                                        </div>
												</div>
		                                	</div>
		                                </div>
		                            </div>
		                            -->
		                            <!--
		                            <div class="tab-pane" id="description">
		                                <div class="row">
		                                    <h4 class="info-text"> Drop us a small description.</h4>
		                                    <div class="col-sm-6 col-sm-offset-1">
	                                    		<div class="form-group">
		                                            <label>Room description</label>
		                                            <textarea class="form-control" placeholder="" rows="6"></textarea>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-4">
		                                    	<div class="form-group">
		                                            <label class="control-label">Example</label>
		                                            <p class="description">"The room really nice name is recognized as being a really awesome room. We use it every sunday when we go fishing and we catch a lot. It has some kind of magic shield around it."</p>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>-->
		                        </div>
	                        	<div class="wizard-footer">
	                            	<!--
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
	                                    <input type='button' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finish' />
	                                </div>
	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
	                                </div>-->
	                                <div class="pull-right">
	                                    <input type='button' style="background-color: black" class='btn btn-fill btn-danger btn-wd' name='activateBtn' 
	                                    id='activateBtn' value='Next' />
	                                </div>
	                                <div class="clearfix"></div>
	                        	</div>
		                    <!--</form>-->
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div> <!-- row -->
		</div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	             Made with <i class="fa fa-heart heart"></i> by <a href="#">Solver</a>
	        </div>
	    </div>
	</div>

</body>
	<!--   Core JS Files   -->
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="assets/js/material-bootstrap-wizard.js"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script type="text/javascript" src="assets/js/SnookerJS/activation.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	
</html>
