<?php    
  
    $servername = "localhost"; // Replace with your server name
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $database = "eventmanagement"; // Replace with your database name
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully"; 
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


/*    class dbConnection{
        private $host = 'localhost';
        private $dbName = 'test';
        private $userName = 'root';
        private $password = '';
        private $conn ;

        public function connect(){
            $this->conn = null;
            try {
                // Create a new PDO instance
                $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->userName, $this->password);
                
                // Set PDO to throw exceptions on errors
                $this->conn = $pdo;
                
                //echo "Connected successfully";
                
            } catch(PDOException $e) {
                // If connection fails, catch and display the error message
                echo "Connection failed: " . $e->getMessage();
            }

            return $this->conn;
        }        

    }

*/
?>