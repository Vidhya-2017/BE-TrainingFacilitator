<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;");
$json = file_get_contents('php://input');
$data = json_decode($json,true);


require_once 'include/dbconnect.php';

 if(isset($data['trainingname'])){
	$training_name = $data['trainingname'];
 }else{
	 $training_name = '';
 }
 
 if($training_name){
	 
	 $condition ="and training_name = '$training_name'";
	 
 }else{
	 $condition = "";
 }

    $query = "SELECT * FROM external_training where is_active = '1' $condition";
	$result = mysqli_query($conn,$query);
	$externaltraining_details = [];
    
    if(mysqli_num_rows($result) > 0){
        while ($taraining_details_rows = mysqli_fetch_assoc($result)){
                $externaltraining_details[] = $taraining_details_rows;
        } 
        $errcode = 200;
        $status = "Success";
    }else{
        $errcode = 400;
        $status = "Failure";
    }

    echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $externaltraining_details));

mysqli_close($conn);
?>