<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);


require_once 'include/dbconnect.php';

$training_type 		        = $data['training_type'];
$is_active                  = '0';
$created_date				= date('Y-m-d h:i:s');
$created_by 			    = $data['created_by'];
$updated_date 			    = date('Y-m-d h:i:s');
$updated_by				    = $data['updated_by'];

if ($data['training_type']!='') {
    $training_ttypcheck	 = "SELECT id, type FROM training_type WHERE type = '".$training_type."'";
    $total_records = mysqli_query($conn,$training_ttypcheck);
	$countrows = mysqli_num_rows($total_records);
    if ($countrows == '0') {
	
		    $query = "INSERT INTO training_type (type, is_active, created_by, created_date, updated_by, updated_date)
			VALUES ('$training_type','$is_active', '$created_by', '$created_date', '$updated_by', '$updated_date')";
			$result = mysqli_query($conn,$query);
			
			$errcode = 200;
			$status = "Success";

		} else {
			$errcode = 404;
			$status = "Training type exists!";        
		}
	} else {
		$errcode = 404;
		$status = "Please add the training type";        
	}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>