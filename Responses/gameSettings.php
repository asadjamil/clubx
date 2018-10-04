<?php  
//action.php
$connect = mysqli_connect('localhost', 'root', '', 'sms');

$input = filter_input_array(INPUT_POST);

$GameDurationMin = mysqli_real_escape_string($connect, $input["GameDuration(Min)"]);
$GameRate = mysqli_real_escape_string($connect, $input["GameRate"]);
$ExtraTimeMin = mysqli_real_escape_string($connect, $input["ExtraTime(Min)"]);


if($input["action"] === 'edit')
{
 $query = "
 UPDATE game_details
  SET `GameDuration(Min)` = '".$GameDurationMin."', 
 `GameRate` = '".$GameRate."',
 `ExtraTime(Min)` = '".$ExtraTimeMin."'
  WHERE `GameTypeID` = '".$input["GameTypeID"]."'
 ";

 mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM tbl_user 
 WHERE `GameTypeID` = '".$input["GameTypeID"]."'
 ";
 mysqli_query($connect, $query);
}

echo json_encode($input);

?>