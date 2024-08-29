<?php
    
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $db = "eventmanagement";

    $conn = new mysqli($serverName,$userName,$password,$db);

    if($conn->connect_error){
        die("connection failed:" .$conn->connect_error);
    }else{
        //echo "connected sucessfully";
    }
    
?>