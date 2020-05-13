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
	$updated_date 			    = date('Y-m-d h:i:s');
	$updated_by				    = $data['updated_by'];

 }

	$query = "UPDATE  external_training SET training_name='$training_name',external_trainer_name='$external_trainer_name',contact_no='$contact_no',email_id='$email_id',start_date='$start_date',end_date='$end_date',duration_id='$duration_id',account='$account',request_by='$request_by',updated_date='$updated_date',updated_by='$updated_by' WHERE id='$id'";

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