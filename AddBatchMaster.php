<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token");

$json = file_get_contents('php://input');
$data = json_decode($json,true);




require_once 'include/dbconnect.php';

	$batch_name 		        = $data['batch_name'];
	$count 		      			= $data['count'];
	$location 		    	    = $data['location'];
	$batch_nm 		   		    = $data['batch_nm'];
	$sme 		      			= $data['sme'];
	$planned_start_date 		= date('Y-m-d' , strtotime($data['planned_start_date']));
	$planned_end_date 		 = date('Y-m-d' , strtotime($data['planned_end_date']));
	$actual_start_date 		     = date('Y-m-d' , strtotime($data['actual_start_date']));
	$actual_end_date 		     = date('Y-m-d' , strtotime($data['actual_end_date']));
	$status 		   			= $data['status'];
	$account 		   			= $data['account'];
	$request_by 		  	    = $data['request_by'];
	$is_active                  = '0';
	$created_date				= date('Y-m-d h:i:s');
	$created_by 			    = $data['created_by'];
	$updated_date 			    = date('Y-m-d h:i:s');
	$updated_by				    = $data['updated_by'];

	if ($data['batch_name']!='') {
		// $training_ttypcheck	 = "SELECT id, type FROM batch_master WHERE batch_name = '".$batch_name."'";
		// $total_records = mysqli_query($conn,$training_ttypcheck);
		// $countrows = mysqli_num_rows($total_records);
		// if ($countrows == '0') {
		
				 $query = "INSERT INTO batch_master (batch_name, count, location, batch_nm, sme, planned_start_date, planned_end_date, actual_start_date, actual_end_date, status, account, request_by, is_active, created_by, created_date, updated_by, updated_date) VALUES ('$batch_name', '$count', '$location', '$batch_nm', '$sme', '$planned_start_date', '$planned_end_date', '$actual_start_date', '$actual_end_date', '$status', '$account ', '$request_by','$is_active', '$created_by', '$created_date', '$updated_by', '$updated_date')";
				$result = mysqli_query($conn,$query);
				
				$errcode = 200;
				$status = "Success";

			// } else {
				// $errcode = 404;
				// $status = "Training type exists!";        
			// }
		} else {
			$errcode = 404;
			$status = "Please add the Branch Details";        
		}
echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status));

mysqli_close($conn);
?>