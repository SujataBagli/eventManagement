<?php
    class post {
        //db connection
        private $conn;
        private $table = 'tbl_events';
        
        public $id;
        public $userId;
        public $title;
        public $description;
        public $eventDate;
        public $eventTime;
        public $image;
                
        public function __construct($db){  //whenever obj/instance created this will automatically runs         
            $this->conn = $db;
        }
        function read(){
            $sql = "SELECT * FROM ".$this->table;            
            $stmt = $this->conn->prepare($sql);//prepare statement           
            $stmt->execute(); //execute 
            return $stmt;
        }


        function readSingle(){
            $sql = "SELECT * FROM ".$this->table." where id = ? and active=1 limit 0,1 ";            
            $stmt = $this->conn->prepare($sql);//prepare statement  
            
            $stmt->bindparam(1,$this->id); // bind id       
            $stmt->execute(); //execute 
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->userId = $row['userId'];
            $this->title = $row['title'];
            $this->description = $row['description'];
            $this->eventDate = $row['eventDate'];  
            $this->eventTime = $row['eventTime'];      
            $this->image = $row['image'];            
        }


        function createRecord(){
            //create query named parameter in PDO - :fname
            $query = "INSERT INTO ".$this->table.
                        " SET userId = :userId, 
                              title = :title, 
                              description = :description, 
                              eventDate = :eventDate,
                              eventTime = :eventTime, 
                              image = :image"
                              ;
            // prepare stmt
            $stmt = $this->conn->prepare($query);
            

            //clean data 
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->eventDate = htmlspecialchars(strip_tags($this->eventDate));
            $this->eventTime = htmlspecialchars(strip_tags($this->eventTime));
            $this->image = htmlspecialchars(strip_tags($this->image));
            

            $stmt->bindparam(':userId',$this->userId);
            $stmt->bindparam(':title',$this->title);
            $stmt->bindparam(':description',$this->description);
            $stmt->bindparam(':eventDate',$this->eventDate);
            $stmt->bindparam(':eventTime',$this->eventTime);
            $stmt->bindparam(':image',$this->image);

            $isExecuted = $stmt->execute();
            if($isExecuted){ //execute 
                return true;
            } 
            printf("Error: %s.\n ".$stmt->error);
            return false;
        }

        function updateRecord(){
            //create query named parameter in PDO - :fname
            $query = "UPDATE ".$this->table.
                        " SET userId = :userId, 
                              title = :title, 
                              description = :description, 
                              eventDate = :eventDate,
                              eventTime = :eventTime, 
                              image = :image
                        where id = :id ";
            // prepare stmt
            $stmt = $this->conn->prepare($query);

            //clean data 
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->eventDate = htmlspecialchars(strip_tags($this->eventDate));
            $this->eventTime = htmlspecialchars(strip_tags($this->eventTime));
            $this->image = htmlspecialchars(strip_tags($this->image));

            $stmt->bindparam(':id',$this->id);
            $stmt->bindparam(':userId',$this->userId);
            $stmt->bindparam(':title',$this->title);
            $stmt->bindparam(':description',$this->description);
            $stmt->bindparam(':eventDate',$this->eventDate);
            $stmt->bindparam(':eventTime',$this->eventTime);
            $stmt->bindparam(':image',$this->image);

            $isExecuted = $stmt->execute();
            if($isExecuted){ //execute 
                return true;
            } 
            printf("Error: %s.\n ".$stmt->error);
            return false;
        }

        function deleteRecord(){
            //create query named parameter in PDO - :fname
            $query = "DELETE FROM ".$this->table." where id = :id";
                        
            // prepare stmt
            $stmt = $this->conn->prepare($query);

            //clean data             
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            $stmt->bindparam(':id',$this->id);

            $isExecuted = $stmt->execute();
            if($isExecuted){ //execute 
                return true;
            } 
            printf("Error: %s.\n ".$stmt->error);
            return false;
        }

    }
?>