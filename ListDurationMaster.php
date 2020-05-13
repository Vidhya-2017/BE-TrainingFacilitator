<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;");
$json = file_get_contents('php://input');
$data = json_decode($json,true);


require_once 'include/dbconnect.php';

 if(isset($data['duriation'])){
	$duriation = $data['duriation'];
 }else{
	 $duriation = '';
 }
 
 if($duriation){
	 
	 $condition ="and duration = '$duriation'";
	 
 }else{
	 $condition = "";
 }

    $query = "SELECT * FROM duration_master where is_active = '0' $condition";
	$result = mysqli_query($conn,$query);
	$durationmaster_details = [];
    
    if(mysqli_num_rows($result) > 0){
        while ($duration_deatils_rows = mysqli_fetch_assoc($result)){
                $durationmaster_details[] = $duration_deatils_rows;
        } 
        $errcode = 200;
        $status = "Success";
    }else{
        $errcode = 404;
        $status = "Failure";
    }

    echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $durationmaster_details));

mysqli_close($conn);
?>