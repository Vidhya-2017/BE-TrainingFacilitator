<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");


$json = file_get_contents('php://input');
$data = json_decode($json,true);
require_once 'include/dbconnect.php';

if(isset($data)){    
    $sap_id = $data['sap_id'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $dob = $data['dob'];
    $gender = $data['gender'];
    $email = $data['email'];
    $phone_number = $data['phone_number'];
    $is_active = $data['is_active'];
    $created_date= date('Y-m-d h:i:s');
    $created_by = "1";
 }user_registration

$query = "INSERT INTO `user_registration` (sap_id,first_name,last_name,dob,gender,email,phone_number,is_active,created_date,created_by) VALUES ('$sap_id','$first_name','$last_name','$dob','$gender','$email','$phone_number','$is_active','$created_date','$created_by')";

$result = mysqli_query($conn,$query);
if(mysqli_insert_id($conn)>0){
    $errcode = 200;
    $status = "Success";
    $smeList = mysqli_insert_id($conn);
}else{
    $errcode = 404;
    $status = "Failure";
    $locId = "";
}

echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $smeList));

mysqli_close($conn);
?>