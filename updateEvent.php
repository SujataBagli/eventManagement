<?php  
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-method: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-method,Content-Type,Access-Control-Allow-Origin,Authorization,x-requested-with');

    include 'config.php'; 
    include 'eventClass.php';    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {      
        $postObj = new post($conn);  

        $vars = new stdClass();      
        $vars->id = $_POST['id']; 
        $vars->title = isset($_POST['title']) ? trim($_POST['title']) : "";        
        $vars->description = isset($_POST['description']) ? $_POST['description'] : '';
        $vars->eventDate = isset($_POST['eventDate']) ? $_POST['eventDate'] : '';
        $vars->eventTime = isset($_POST['eventTime']) ? $_POST['eventTime'] : '';       
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "uploads/"; // Directory where you want to save the file
            $targetFile = $targetDir . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            $postObj->image = $targetFile;
            $vars->image = $targetFile;
        } else {
            $vars->image = null; 
        }        
        $data = $postObj->updateRecord($vars);
        echo  json_encode($data) ;  
           
        
    }
    
?>