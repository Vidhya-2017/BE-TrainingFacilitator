<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;");
$json = file_get_contents('php://input');
$data = json_decode($json,true);


require_once 'include/dbconnect.php';

 if(isset($data['branchname'])){
	$branch_name = $data['branchname'];
 }else{
	 $branch_name = '';
 }
 
 if($branch_name){
	 
	 $condition ="and type = '$branch_name'";
	 
 }else{
	 $condition = "";
 }

    $query = "SELECT * FROM batch_master  where is_active = '0' $condition";
	$result = mysqli_query($conn,$query);
	$branch_details = [];
    
    if(mysqli_num_rows($result) > 0){
        while ($branchmasterrows = mysqli_fetch_assoc($result)){
                $branch_details[] = $branchmasterrows;
        } 
        $errcode = 200;
        $status = "Success";
    }else{
        $errcode = 404;
        $status = "Failure";
    }

    echo $result = json_encode(array("errCode"=>$errcode,"status"=>$status,"arrRes" => $branch_details));

mysqli_close($conn);
?>