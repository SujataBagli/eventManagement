<?php

    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-method: POST');

    include 'config.php'; 
    include 'authClass.php';   
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {      
        $vars = new stdClass();      
        $vars->username = isset($_POST['username']) ? trim($_POST['username']) : "";        
        $vars->password = isset($_POST['password']) ? trim($_POST['password']) : "";        
        $function = isset($_POST['function']) ? $_POST['function'] : '';
    
        // Determine which function to call
        switch ($function) {
            case 'registerUser':                
                $vars->email = isset($_POST['email']) ? trim($_POST['email']) : "";
                $vars->confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : "";   
                $postObj = new auth($conn);            
                $data = $postObj->registerUser($vars);
                echo  json_encode($data) ;               
            break;
            case 'verifyrUser':
                $postObj = new auth($conn);
                $data = $postObj->verifyrUser($vars);
                echo  json_encode($data) ;                
            break;
            default:
                $response = new stdClass();
                $response->err = 1;
                $response->errMsg = "Invalid request.";
                echo json_encode($response);
            break;
        }
    }
    