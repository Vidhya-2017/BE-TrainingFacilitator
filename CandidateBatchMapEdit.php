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
$batch_id                   = $data['batch_id'];
$candidate_id 		        = $data['candidate_id'];
$is_active                  = '0';
$created_date				= date('Y-m-d h:i:s');
$created_by 			    = $data['created_by'];
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

if ($data['batch_id']!='' && $data['candidate_id']!='') {
    $sql_duplicate = "SELECT id FROM candidate_batch_mapping WHERE batch_id = '".$batch_id."' AND candidate_id='".$candidate_id."'";
    $total_records = mysqli_query($conn,$sql_duplicate);
    if ($total_records->num_rows == '0') {
        $query = "UPDATE `candidate_batch_mapping` SET batch_id='".$batch_id."',candidate_id='".$candidate_id."', is_active='".$is_active."', updated_by='".$updated_by."'
        updated_date='".$updated_date."' WHERE id='".$id."'";        
        $result = mysqli_query($conn,$query);
        
        $errcode = 200;
        $status = "Success";

    } else {
        $errcode = 404;
        $status = "Already Batch and Candidate Id exists!";        
    }
} else {
    $errcode = 404;
    $status = "Please provide batch and candidate Id";        
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>