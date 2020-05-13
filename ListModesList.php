<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");


$json = file_get_contents('php://input');
$data = json_decode($json,true);
require_once 'include/dbconnect.php';

// if(isset($data)){
//     $id = $data['id'];
   
//  }
$result_data = array();
$query = "SELECT * FROM `modes_list` WHERE is_active='0' ";
$result = mysqli_query($conn,$query);
while($smelist = mysqli_fetch_assoc($result)){
	$result_data[] = $smelist;

}
if(mysqli_num_rows($result)>0){
    $errcode = 200;
    $status = "Success";
    $smeList = $result_data;
}else{
    $errcode = 404;
    $status = "Failure";
    $locId = "";
}

echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $smeList));

mysqli_close($conn);
?>