<?php
// Connect to Database = 'sms'
$connect = mysqli_connect("localhost", "root", "", "sms");
// Get data from tbl = 'game_details'
$query = "SELECT * FROM game_details ORDER BY GameTypeID DESC";
$result = mysqli_query($connect, $query);
// Get data from tbl = 'users'
$query1 = "SELECT * FROM users ORDER BY UserID DESC";
$result1 = mysqli_query($connect,$query1); 
?>
<html>  
 <head>  
    <title>Club X | Settings</title>  
    <script src="assets/js/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="assets/img/clubx-favicon.ico">
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="assets/fonts/glyphicons-halflings-regular.woff2">
    <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
    <link rel="stylesheet" type="text/css" href="assets/css/settings.css"> 
    <script src="assets/js/bootstrap.min.js"></script>            
    <script src="assets/js/jquery.tabledit.min.js"></script>
    </head>  
    <body>  
  <div class="container">  
   <br />  
   <br />  
   <br />  
    <div class="table-responsive">  
    <!-- Game Settings -->
    <h3 align="center">Game Settings</h3><br />  
    <table id="game_settings_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Game Type ID</th>
       <th>Game Type Name</th>
       <th>Game Duration(Min)</th>
       <th>Game Rate</th>
       <th>Extra Time(Min)</th>
      </tr>
     </thead>
     <tbody>
     <?php
     while($row = mysqli_fetch_array($result))
     {
      echo '
      <tr>
       <td>'.$row["GameTypeID"].'</td>
       <td>'.$row["GameTypeName"].'</td>
       <td>'.$row["GameDuration(Min)"].'</td>
       <td>'.$row["GameRate"].'</td>
       <td>'.$row["ExtraTime(Min)"].'</td>
      </tr>
      ';
     }
     ?>
     </tbody>
    </table>
    <!-- User Settings -->
    <h3 align="center">User Settings</h3><br />  
    <!-- Add User Button -->
    <div>
      <!-- Button HTML (to Trigger Modal) -->
      <a href="#myModal" class="btn btn-lg btn-primary" data-toggle="modal">Add User</a>
    </div>  
<div class="row">
  <div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <!--<a href="#myModal" class="btn btn-lg btn-primary" data-toggle="modal">Add User</a>-->
    
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title">Add User</h4>
                </div>               
                
                <div class="modal-body">                                       
                <div class="col-md-6 col-sm-6 no-padng">
                    <div class="model-l">                    
                      <form method="post" id="logFrm" class="log-frm" name="logFrm"> 
                      <ul>                                                     
                          <li>User Name</li>
                          <li> <input type="text" placeholder="User Name" id="userName"  class="form-control" 
                            onfocus="checkNullProf();"></li>
                          <li>Password</li>
                          <li><input type="password" placeholder="Password" id="password"  class="form-control" 
                            onfocus="checkNullProf();"></li>                                                
                          <li>Contact No</li>
                          <li><input type="text" placeholder="Contact No" id="contact" class="form-control" 
                            onfocus="checkNullProf();"></li> 
                          <li>Access Level</li>
                          <li><select  id="access" class="form-control">
                              <option value="1">1</option>
                              <option value="2">2</option> 
                            </select>
                            </li> 
                        </ul>
                      </form>                      
                                
                    </div>
                    </div>    
                    <div class="col-md-6 col-sm-6 no-padng">
                        <div class="model-r">
                       
                           <form method="post" id="userRegisterFrm" class="log-frm" name="userRegisterFrm">  
                            <ul>
                             <li>First Name</li>
                             <li><input type="text" placeholder="First Name" id="fName" class="form-control"></li>
                             <li>Last Name</li>
                             <li><input type="text" placeholder="Last Name" id="lName" class="form-control"></li>
                             <li>Address</li>
                             <li><input type="text" placeholder="Address" id="address" class="form-control"></li>
                            </ul>
                          </form>
                        </div>
                      </div>
                        
                      <div class="clearfix"></div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="AddUser();">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
    <br>
    <table id="user_settings_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>User ID</th>
       <th>User Name</th>
       <th>Password</th>
       <th>First Name</th>
       <th>Last Name</th>
       <th>Contact No</th>
       <th>Address</th>
       <th>Access Level</th>
      </tr>
     </thead>
     <tbody>
     <?php
     while($row = mysqli_fetch_array($result1))
     {
      echo '
      <tr>
       <td>'.$row["UserID"].'</td>
       <td>'.$row["UserName"].'</td>
       <td>'.$row["Password"].'</td>
       <td>'.$row["FirstName"].'</td>
       <td>'.$row["LastName"].'</td>
       <td>'.$row["ContactNo"].'</td>
       <td>'.$row["Address"].'</td>
       <td>'.$row["AccessLevel"].'</td>
      </tr>
      ';
     }
     ?>
     </tbody>
    </table>
   </div>  
  </div>  
 </body>  
</html>  
<script>  
$(document).ready(function(){  
     $('#game_settings_table').Tabledit({
      url:'Responses/gameSettings.php',
      columns:{
       identifier:[0, "GameTypeID"],
       editable:[[2, 'GameDuration(Min)'], [3, 'GameRate'], [4, 'ExtraTime(Min)']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
        
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
       //location.reload();
      }
     });
  
    $('#user_settings_table').Tabledit({
      url:'Responses/userSettings.php',
      columns:{
       identifier:[0, "UserID"],
       editable:[[1, 'UserName'], [2,'Password'], [3,'FirstName'], [4,'LastName'], [5,'ContactNo'], [6,'Address'],
         [7,'AccessLevel'] ]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
        
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
       //location.reload();
      }
     });
 
});  
// Add User Func
function AddUser()
{
  // Get Values from Add User Form
  var userName = $('#userName').val();
  var password = $('#password').val();
  var access = $('#access').val();
  var contact = $('#contact').val();
  var fName = $('#fName').val();
  var lName = $('#lName').val();
  var address = $('#address').val();
  
  $.ajax({
      url:"Responses/AddUserResponse.php",
      method:"POST",
      data:{userName:userName,password:password,access:access,contact:contact,fName:fName,lName:lName,address:address},
      success:function(data){
        //console.log(data);
        location.reload();
      }
    });
}
</script>
