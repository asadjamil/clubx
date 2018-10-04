$(document).ready(function(){
  $('#passwordCash').keypress(function(event){
    if(event.keyCode == 13){
      $('#loginBtn').click();
    }
  });
  $('#passwordAdmin').keypress(function(event){
    if(event.keyCode == 13){
      $('#loginBtn').click();
    }
  });
  $('#loginBtn').click(function(){

		// get values from login form 
		//var username = $('#username').val();
		//var password = $('.password').val();
    //var p = $('#passwordCash').val();
		var password;
    var accessLevel;
    if($('#passwordAdmin').val() != '')
    {
      password = $('#passwordAdmin').val();
      accessLevel = 1;
    }
    if($('#passwordCash').val() != '')
    {
      password = $('#passwordCash').val();
      accessLevel = 2;
    }
    //alert(accessLevel);
		// Ajax Hit to LoginResponse(A page that matches login credentials from db)
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
        	xmlhttp=new XMLHttpRequest();
        } 
        else
        {  
        	// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
       
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                
                var output=xmlhttp.responseText;
                //alert(output);
               	// Check if the LoginResponse return true or false 
               	// if true then username and password is correct otherwise no
               	if(output == 'true')
               	{	

               		// redirect to activation screen
                  
               		window.location = "activation.php";
               	}
               	else
               	{
               		// redirect to login page
               		window.location = "index.html";
               	}
            }
          
        }
        xmlhttp.open("POST","Responses/LoginResponse.php",true);
        xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
			
			// making string to be send to LoginResponse via Ajax Hit
        var str = "password="+password+"&accessLevel="+accessLevel;
        xmlhttp.send(str);
	}); // LoginBtn End

});//End of Ready or Main Function