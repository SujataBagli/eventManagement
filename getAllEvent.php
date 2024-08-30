<?php  
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    //header('Access-Control-Allow-Method: POST');

    include 'config.php'; 
    include 'eventClass.php';
    $postObj = new post($conn);
    $result = $postObj->read();    

    // To fetch all the data at a time fetchAll
    // $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    // $count = count($rows);
    // print_r(json_encode($rows));

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Process each row of data
        echo $row['id']. "\n";
        echo $row['userId']. "\n";
        echo $row['title']. "\n";
        echo $row['description']. "\n";
        echo $row['eventDate']. "\n";
        echo $row['eventTime']. "\n";
        echo $row['image']. "\n\n";
    }   

?>