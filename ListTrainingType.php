<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;");
$json = file_get_contents('php://input');
$data = json_decode($json,true);


require_once 'include/dbconnect.php';

 if(isset($data['type'])){
	$training_type = $data['type'];
 }else{
	 $training_type = '';     
 }
 
 if($training_type){
	 
	 $condition ="and type = '$training_type'";
	 
 }else{
	 $condition = "";
 }

	$query = "SELECT * FROM training_type where is_active = '0' $condition";
	$result = mysqli_query($conn,$query);
	$training_types = [];
    
    if(mysqli_num_rows($result) > 0){
        while ($trainingtyperows = mysqli_fetch_assoc($result)){
                $training_types[] = $trainingtyperows;
        } 
        $errcode = 200;
        $status = "Success";
    }else{
        $errcode = 404;
        $status = "Failure";
    }

    echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $training_types));

mysqli_close($conn);
?>