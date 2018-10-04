<?php  
//action.php
$connect = mysqli_connect('localhost', 'root', '', 'sms');

$input = filter_input_array(INPUT_POST);

$UserName = mysqli_real_escape_string($connect, $input["UserName"]);
$Password = mysqli_real_escape_string($connect, $input["Password"]);
$FirstName = mysqli_real_escape_string($connect, $input["FirstName"]);
$LastName = mysqli_real_escape_string($connect, $input["LastName"]);
$ContactNo = mysqli_real_escape_string($connect, $input["ContactNo"]);
$Address = mysqli_real_escape_string($connect, $input["Address"]);
$AccessLevel = mysqli_real_escape_string($connect, $input["AccessLevel"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE users
  SET `UserName` = '".$UserName."', 
 `Password` = '".$Password."',
 `FirstName` = '".$FirstName."',
 `LastName` = '".$LastName."',
 `ContactNo` = '".$ContactNo."',
 `Address` = '".$Address."',
 `AccessLevel` = '".$AccessLevel."'
  WHERE `UserID` = '".$input["UserID"]."'
 ";

 mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM users 
 WHERE `UserID` = '".$input["UserID"]."'
 ";
 mysqli_query($connect, $query);
}

echo json_encode($input);

?>