<?php
    $host = "localhost";
    $db_name = "training_facilitator";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($host, $username, $password,$db_name);
    if(! $conn ){
        die('Could not connect: ' . mysqli_error());
    }  
?>