<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");


$json = file_get_contents('php://input');
$data = json_decode($json,true);
require_once 'include/dbconnect.php';

if(isset($data)){
    $skill_name = $data['skill_name'];
    $created_date= date('Y-m-d h:i:s');
    $created_by = $data['created_by'];
    $query = "INSERT INTO `skills_list` (skill_name,created_date,created_by) VALUES ('$skill_name','$created_date','$created_by')";

$result = mysqli_query($conn,$query);
if(mysqli_insert_id($conn)>0){
    $errcode = 200;
    $status = "Success";
    $smeList = mysqli_insert_id($conn);
}else{
    $errcode = 404;
    $status = "Failure";
}

 }
else{
    $errcode = 404;
    $status = "Failure";
}

echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $smeList));

mysqli_close($conn);
?>