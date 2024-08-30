<?php  
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-method: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-method,Content-Type,Access-Control-Allow-Origin,Authorization,x-requested-with');

    include 'config.php'; 
    include 'eventClass.php';
    $postObj = new post($conn);

    //db connection
    // $dbConnectionObj = new dbConnection();
    // $db = $dbConnectionObj->connect();

    $postObj = new post($conn);

    //Get raw posted data
    //$data = json_decode(file_get_contents("php://input"));

    // $postObj->id = $data->id; 
    $postObj->id = '5';        

    if($postObj->deleteRecord()){
        echo json_encode(array('message' => 'Data Deleted Successfully!'));
    }else{
        echo json_encode(array('message' => 'Data not Deleted!'));
    }
?>