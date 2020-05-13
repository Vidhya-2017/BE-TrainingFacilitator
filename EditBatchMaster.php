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
	$updated_date 			    = date('Y-m-d h:i:s');
	$updated_by				    = $data['updated_by'];

 }

	$query = "UPDATE  batch_master SET batch_name='$batch_name',count='$count',location='$location',batch_nm='$batch_nm',sme='$sme',planned_start_date='$planned_start_date',planned_end_date='$planned_end_date',actual_start_date='$actual_start_date',actual_end_date='$actual_end_date',status='$status',account='$account',request_by='$request_by',updated_date='$updated_date',updated_by='$updated_by' WHERE id='$id'";

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