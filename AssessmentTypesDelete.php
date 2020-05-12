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
$assesment_type_name 		= $data['assesment_type_name'];
$is_active                  = '1';
$created_date				= date('Y-m-d h:i:s');
$created_by 			    = $data['created_by'];
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

if ($data['assesment_type_name']!='') {    
    $query = "UPDATE `assesment_type` SET is_active='".$is_active."', updated_by='".$updated_by."', updated_date='".$updated_date."' WHERE id='".$id."'";        
    $result = mysqli_query($conn,$query);
    
    $errcode = 200;
    $status = "Success";
    
} else {
    $errcode = 404;
    $status = "Please provide assessment type name";        
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>