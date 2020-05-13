<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);
//echo "here";
require_once 'include/dbconnect.php';
$batch_id                   = $data['batch_id'];
$candidate_id 		        = $data['candidate_id'];
$is_active                  = '1';
$created_date				= date('Y-m-d h:i:s');
$created_by 			    = "";
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = "";

if ($data['batch_id']!='' && $data['candidate_id']!='') {    
    $query = "UPDATE `candidate_batch_mapping` SET is_active='".$is_active."', updated_by='".$updated_by."', updated_date='".$updated_date."' WHERE batch_id='".$batch_id."' AND candidate_id='".$candidate_id."' ";        
    $result = mysqli_query($conn,$query);
    
    $errcode = 200;
    $status = "Success";
    
} else {
    $errcode = 404;
    $status = "Please provide batch and candidate ID";        
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>