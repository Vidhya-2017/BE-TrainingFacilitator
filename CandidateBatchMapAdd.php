<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);

require_once 'include/dbconnect.php';

$batch_id 		            = $data['batch_id'];
$candidate_id 		        = $data['candidate_id'];
$is_active                  = '0';
$created_date				= date('Y-m-d h:i:s');
$created_by 			    = $data['created_by'];
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

if ($data['batch_id']!='' && $data['candidate_id']!='') {
    $sql_duplicate = "SELECT batch_id, candidate_id FROM candidate_batch_mapping WHERE (batch_id = '".$batch_id."' AND candidate_id = '".$candidate_id."' )";
    $total_records = mysqli_query($conn,$sql_duplicate);
    if ($total_records->num_rows == '0') {
        $query = "INSERT INTO `candidate_batch_mapping` (batch_id, candidate_id, is_active, created_by, created_date, updated_by, updated_date)
        VALUES ('$batch_id','$candidate_id','$is_active', '$created_by', '$created_date', '$updated_by', '$updated_date')";
        $result = mysqli_query($conn,$query);
        
        $errcode = 200;
        $status = "Success";

    } else {
        $errcode = 404;
        $status = "Already Batch and Candidate exists!";        
    }
} else {
    $errcode = 404;
    $status = "Batch and Candidate Id should not be empty";        
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>