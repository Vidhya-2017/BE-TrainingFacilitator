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
$is_active                  = '1';
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];
  
$query = "UPDATE `role_master` SET is_active='".$is_active."', updated_by='".$updated_by."', updated_date='".$updated_date."' WHERE id='".$id."'";        
$result = mysqli_query($conn,$query);
if($result){
    $errcode = 200;
    $status = "Success";       
}else{
    $errcode = 404;
    $status = "Failure";
    $locId = "";
}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>