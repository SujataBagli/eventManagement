<?php  
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-method: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-method,Content-Type,Access-Control-Allow-Origin,Authorization,x-requested-with');

    include 'config.php'; 
    include 'eventClass.php';   
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {      
        $postObj = new post($conn);  
        $vars = new stdClass();      
        $vars->id = isset($_POST['id']) ? $_POST['id'] : die();
           
        $data = $postObj->deleteRecord($vars);
        echo  json_encode($data) ; 
    }
    
?>