<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);

require_once 'include/dbconnect.php';

	$training_name 		        = $data['training_name'];
	$external_trainer_name		= $data['external_trainer_name'];
	$contact_no 		    	= $data['contact_no'];
	$email_id 		   		    = $data['email_id'];
	$start_date 				= date('Y-m-d' , strtotime($data['start_date']));
	$end_date 					= date('Y-m-d' , strtotime($data['end_date']));
	$duration_id 		   		= $data['duration_id'];
	$account 		   			= $data['account'];
	$request_by 		  	    = $data['request_by'];
	$is_active                  = '0';
	$created_date				= date('Y-m-d h:i:s');
	$created_by 			    = $data['created_by'];
	$updated_date 			    = date('Y-m-d h:i:s');
	$updated_by				    = $data['updated_by'];

	if ($data['training_name']!='') {
		
				$query ="INSERT INTO external_training (training_name, external_trainer_name, contact_no, email_id, start_date, end_date, duration_id, account, request_by, is_active, created_by, created_date, updated_by, updated_date) VALUES ('$training_name', '$external_trainer_name', '$contact_no', '$email_id', '$start_date', '$end_date', '$duration_id', '$account', '$request_by ', '$is_active', '$created_by', '$created_date', '$updated_by', '$updated_date')";
				$result = mysqli_query($conn,$query);
				
				$errcode = 200;
				$status = "Success";

		} else {
			$errcode = 404;
			$status = "Please add the External Training Details";        
		}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>