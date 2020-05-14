<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);
//echo "here";
require_once 'include/dbconnect.php';
$id = $data['id'];
$first_name = $data['first_name'];
$last_name = $data['last_name'];
$dob = $data['dob'];
$gender = $data['gender'];
$email = $data['email'];
$phone_number = $data['phone_number'];
$is_active                  = '0';
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

$query = "UPDATE `user_registraion` SET first_name='".$first_name."',last_name='".$last_name."',dob='".$dob."',gender='".$gender."',email='".$email."',phone_number='".$phone_number."', is_active='".$is_active."', updated_by='".$updated_by."'
updated_date='".$updated_date."' WHERE id='".$id."'";        
$result = mysqli_query($conn,$query);
if($result){
    $errcode = 200;
    $status = "Success";
}else{
    $errcode = 404;
    $status = "Failure";
    $locId = "";
}

echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>