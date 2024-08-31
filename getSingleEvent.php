<?php  
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    //header('Access-Control-Allow-Method: POST');

    include 'config.php'; 
    include 'eventClass.php';
    $postObj = new post($conn); 

    //$postObj->id = isset($_GET['id']) ? $_GET['id'] : die();
    // Get the ID from query parameters
    $postObj->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(array('message' => 'Event ID is required')));

    // Fetch the event data
    $postObj->readSingle();

    $eventDate = date('Y-m-d', strtotime($postObj->eventDate));
    // Prepare the data array
    $dataArr = array(
        'id' => $postObj->id,
        'userId' => $postObj->userId,
        'title' => $postObj->title,
        'description' => $postObj->description,
        'eventDate' => $eventDate,
        'eventTime' => $postObj->eventTime,
        'image' => $postObj->image        
    );

    // Output the data as JSON
    echo json_encode($dataArr);


?>