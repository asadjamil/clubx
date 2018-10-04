<?php 
	// Start Session
	@session_start();

	// Destroy Session
	@session_destroy();

	// Redirect to Login Page
	header('Location:index.html');
	
?>