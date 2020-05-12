<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);

require_once 'include/dbconnect.php';

$assessment_id 		        = $data['assessment_id'];
$training_id 		        = $data['training_id'];
$is_active                  = '0';
$created_date				= date('Y-m-d h:i:s');
$created_by 			    = $data['created_by'];
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

if ($data['assessment_id']!='' && $data['training_id']!='') {
    $sql_duplicate = "SELECT assessment_id, training_id FROM assesment_training_mapping WHERE (assessment_id = '".$assessment_id."' AND training_id = '".$training_id."' )";
    $total_records = mysqli_query($conn,$sql_duplicate);
    if ($total_records->num_rows == '0') {
        $query = "INSERT INTO `assesment_training_mapping` (training_id, assessment_id, is_active, created_by, created_date, updated_by, updated_date)
        VALUES ('$training_id','$assessment_id','$is_active', '$created_by', '$created_date', '$updated_by', '$updated_date')";
        $result = mysqli_query($conn,$query);
        
        $errcode = 200;
        $status = "Success";

    } else {
        $errcode = 404;
        $status = "Already Assessment and Training Id exists!";        
    }
} else {
    $errcode = 404;
    $status = "Training or Assessment Id should not be empty";        
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>