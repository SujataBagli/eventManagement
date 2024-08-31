<?php  
session_start();  
if (isset($_SESSION['user_id'])) {    
    $type = $_SESSION['type'] ;       
} else {        
    header('Location: logOut.php');
    exit();
}  
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include 'config.php'; 
include 'eventClass.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $postObj = new post($conn); 
    
    $vars = new stdClass();      
    $vars->title = isset($_GET['title']) ? $_GET['title'] : '';
    $vars->eventDate = isset($_GET['date']) ? $_GET['date'] : '';  
    $vars->limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;   
    $vars->type = $type;   

    $response = $postObj->getevents($vars);    
    echo json_encode($response);
        
}

?>
