<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);

require_once 'include/dbconnect.php';

$assesment_type_name 		= $data['assesment_type_name'];
$is_active                  = '0';
$created_date				= date('Y-m-d h:i:s');
$created_by 			    = $data['created_by'];
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

if ($data['assesment_type_name']!='') {
    $sql_duplicate = "SELECT assesment_type_name FROM assesment_type WHERE assesment_type_name = '".$assesment_type_name."' ";
    $total_records = mysqli_query($conn,$sql_duplicate);
    if ($total_records->num_rows == '0') {
        $query = "INSERT INTO `assesment_type` (assesment_type_name, is_active, created_by, created_date, updated_by, updated_date)
        VALUES ('$assesment_type_name','$is_active', '$created_by', '$created_date', '$updated_by', '$updated_date')";
        $result = mysqli_query($conn,$query);
        
        $errcode = 200;
        $status = "Success";

    } else {
        $errcode = 404;
        $status = "Already Assessment type name exists!";        
    }
} else {
    $errcode = 404;
    $status = "Please provide assessment type name";        
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>