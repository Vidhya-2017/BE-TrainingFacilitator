<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

require_once 'include/dbconnect.php';
$json = file_get_contents('php://input');
$data = json_decode($json,true);


if(isset($data)){
    $id = $data['id'];
    $type = $data['training_type'];
	 $updated_by = $data['updated_by'];
    $updated_date= date('Y-m-d h:i:s');

 }

	$query = "UPDATE training_type SET type='$type',updated_date='$updated_date',updated_by='$updated_by' WHERE id='$id'";

	$result = mysqli_query($conn,$query);
	if($result){
		$errcode = 200;
		$status = "Success";
		$smeList = "";
	}else{
		$errcode = 404;
		$status = "Failure";
		$locId = "";
	}

	echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $smeList));

	mysqli_close($conn);
?>