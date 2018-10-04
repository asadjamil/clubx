$(document).ready(function(){
  $('#clubSize').keyup(function(event){
    if(event.keyCode == 13){
      //alert('hi');
      $('#activateBtn').click();
    }
  });

	$('#activateBtn').click(function(){

		// get values from login form 
		//var username = $('#username').val();
		var clubSize = $('#clubSize').val();

    // add rows = clubsize or noOfTables in tbl = table_state
    $.ajax({
      url:"Responses/AddTableStateResponse.php",
      method:"POST",
      data:{clubSize:clubSize},
      success:function(data){
        
        //alert(data);
      }
    });
		
    $.ajax({
      url:"Responses/ActivationResponse.php",
      method:"POST",
      data:{clubSize:clubSize},
      success:function(data){
        window.location = 'dashboard.php';
        //alert(data);
      }
    });



	}); // ActivateBtn End

});//End of Ready or Main Function