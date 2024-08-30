<?php  
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    //header('Access-Control-Allow-Method: POST');

    include 'config.php'; 
    include 'eventClass.php';
    $postObj = new post($conn); 

    //$postObj->id = isset($_GET['id']) ? $_GET['id'] : die();
    $postObj->id = 1;

    $postObj->readSingle();
    //print_r($postObj);
    $dataArr = array(
        'id' => $postObj->id,
        'userId' => $postObj->userId,
        'title' => $postObj->title,
        'description' => $postObj->description,
        'eventDate' => $postObj->eventDate,
        'eventTime' => $postObj->eventTime,
        'image' => $postObj->image        
    );
    
    print_r($dataArr);
    //print_r(json_encode($dataArr));//make json


?>