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
$role_name 		= $data['role_name'];
$is_active                  = '0';
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

if ($data['role_name']!='') {
    $sql_duplicate = "SELECT role_name FROM role_master WHERE role_name = '".$role_name."' AND id='".$id."'";
    $total_records = mysqli_query($conn,$sql_duplicate);
    if ($total_records->num_rows == '0') {
        $query = "UPDATE `role_master` SET role_name='".$role_name."', is_active='".$is_active."', updated_by='".$updated_by."'
        updated_date='".$updated_date."' WHERE id='".$id."'";        
        $result = mysqli_query($conn,$query);        
        $errcode = 200;
        $status = "Success";

    } else {
        $errcode = 404;
        $status = "Role name exists!";        
    }
} else {
    $errcode = 404;
    $status = "Please provide role name";        
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>