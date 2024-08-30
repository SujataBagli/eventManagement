<?php  
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-method: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-method,Content-Type,Access-Control-Allow-Origin,Authorization,x-requested-with');

    include 'config.php'; 
    include 'eventClass.php';

    $postObj = new post($conn);

    //Get raw posted data
    //$data = json_decode(file_get_contents("php://input"));  

    // $postObj->userId  = $data->userId;
    // $postObj->title = $data->title;
    // $postObj->description = $data->description;
    // $postObj->eventDate  = $data->eventDate;
    // $postObj->eventTime  = $data->eventTime;
    // $postObj->image  = $data->image;

    $postObj->userId  = 1;
    $postObj->title = 'Picnic Day';
    $postObj->description = 'The Picnic event ';
    $postObj->eventDate  = '2024-06-08 22:20:41';
    $postObj->eventTime  = '20:20';
    $postObj->image  = 'picnic.png';
    

    if($postObj->createRecord()){
        echo json_encode(array('message' => 'post created'));
    }else{
        echo json_encode(array('message' => 'post not created'));
    }
?>