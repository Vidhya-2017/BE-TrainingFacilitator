<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);
//echo "here";
require_once 'include/dbconnect.php';

$query = "SELECT * FROM assesment_type";
$result = mysqli_query($conn,$query);

$assessment_types = [];
    
if(mysqli_num_rows($result) > 0){
    while ($assessment_row = mysqli_fetch_assoc($result)){
            $assessment_types[] = $assessment_row;
    } 
    $errcode = 200;
    $status = "Success";
}else{
    $errcode = 404;
    $status = "Failure";
}

    echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $assessment_types));

mysqli_close($conn);
?>