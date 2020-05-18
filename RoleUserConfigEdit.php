<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);
//echo "here";
require_once 'include/dbconnect.php';
$user_id = $data['user_id'];
$role_id 		= $data['role_id'];
$is_active                  = '0';
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

    
$query = "UPDATE `role_user_configuration` SET role_id='".$role_id."', is_active='".$is_active."', updated_by='".$updated_by."'
updated_date='".$updated_date."' WHERE user_id='".$user_id."'";        
$result = mysqli_query($conn,$query);   
if($result){     
    $errcode = 200;
    $status = "Success";

} else {
    $errcode = 404;
    $status = "Failure";        
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>