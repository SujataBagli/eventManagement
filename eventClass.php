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
        
        function createEvent($vars){               
            $response = new stdClass();
            $response->err = 0;
            $response->errMsg = null;
            $response->successMsg = null;    

            $userId = htmlspecialchars(strip_tags($vars->userId));
            $title = htmlspecialchars(strip_tags($vars->title));
            $description = htmlspecialchars(strip_tags($vars->description));
            $eventDate = htmlspecialchars(strip_tags($vars->eventDate));
            $eventTime = htmlspecialchars(strip_tags($vars->eventTime));
            $image = htmlspecialchars(strip_tags($vars->image));       
            
            try{            
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
                
                $stmt->bindparam(':userId',$userId);
                $stmt->bindparam(':title',$title);
                $stmt->bindparam(':description',$description);
                $stmt->bindparam(':eventDate',$eventDate);
                $stmt->bindparam(':eventTime',$eventTime);
                $stmt->bindparam(':image',$image);

                $isExecuted = $stmt->execute();
                if($isExecuted){ //execute 
                    $this->conn = null;
                    $response->successMsg = "Registered Successfully...!";                   
                } else{
                    $this->conn = null;
                    $response->err = 1;
                    $response->errMsg = "Not Registered Please Try Again...!.";             
                }
                return json_encode($response); 
            }        
            catch(PDOException $e) {
                $response->err = 1;
                $response->errMsg = "Not Registered Please Try Again...!.";         
            }
        } 
        function updateRecord($vars){               
            $response = new stdClass();
            $response->err = 0;
            $response->errMsg = null;
            $response->successMsg = null;    
        
            $id = htmlspecialchars(strip_tags($vars->id));
            $title = htmlspecialchars(strip_tags($vars->title));
            $description = htmlspecialchars(strip_tags($vars->description));
            $eventDate = htmlspecialchars(strip_tags($vars->eventDate));
            $eventTime = htmlspecialchars(strip_tags($vars->eventTime));
            $image = htmlspecialchars(strip_tags($vars->image));      
            
            try{            
                $query = "UPDATE ".$this->table.
                    " SET 
                        title = :title, 
                        description = :description, 
                        eventDate = :eventDate,
                        eventTime = :eventTime, 
                        image = :image
                    WHERE id = :id";
                // prepare stmt
                $stmt = $this->conn->prepare($query);                
               
                 $stmt->bindparam(':id', $id);
                 $stmt->bindparam(':title', $title);
                 $stmt->bindparam(':description', $description);
                 $stmt->bindparam(':eventDate', $eventDate);
                 $stmt->bindparam(':eventTime', $eventTime);
                 $stmt->bindparam(':image', $image);

                $isExecuted = $stmt->execute();
                if($isExecuted){ //execute 
                    $this->conn = null;
                    $response->successMsg = "Updated Successfully...!";                    
                } else{
                    $this->conn = null;
                    $response->err = 1;
                    $response->errMsg = "Not Updated. Please Try Again...!";           
                }
                return json_encode($response); 
            }        
            catch(PDOException $e) {
                $response->err = 1;
                $response->errMsg = "Not Registered Please Try Again...!.";   
                return json_encode($response);       
            }
        } 
        function deleteRecord($vars) {
            $response = new stdClass();
            $response->err = 0;
            $response->errMsg = null;
            $response->successMsg = null;    
        
            $id = htmlspecialchars(strip_tags($vars->id));
            $deletedValue = 1; 
        
            try {  
                $query = "UPDATE " . $this->table . " SET deleted = :deleted WHERE id = :id";           
                $stmt = $this->conn->prepare($query);
                
                // Bind parameters
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':deleted', $deletedValue, PDO::PARAM_INT);  // Use the variable here
        
                // Execute the statement
                $isExecuted = $stmt->execute();
                
                if ($isExecuted) {                 
                    $response->successMsg = "Deleted Successfully...!";                    
                } else {                   
                    $response->err = 1;
                    $response->errMsg = "Cannot Delete!";     
                }
            } catch (PDOException $e) {
                $response->err = 1;
                $response->errMsg = "Cannot Delete! Error: " . $e->getMessage();    
            } finally {
                $this->conn = null;  
            }
        
            return json_encode($response); 
        }
        public function getevents($vars) {
            $response = new stdClass();
            $response->err = 0;
            $response->errMsg = null;
            $response->successMsg = null; 
            
            $response->hide = ($vars->type == 'ADM') ? 0 : 1;
        
          
            $title = htmlspecialchars(strip_tags($vars->title));           
            $date = htmlspecialchars(strip_tags($vars->eventDate));           
            $limit = htmlspecialchars(strip_tags($vars->limit));

            try {  
                $countSql = "SELECT COUNT(*) as totalCount FROM " . $this->table . " WHERE eventDate >= CURDATE() AND active=1 AND deleted=0";
                if (!empty($title)) { $countSql .= " AND title LIKE :title"; }
                if (!empty($date)) { $countSql .= " AND eventDate = :eventDate"; }
                $countStmt = $this->conn->prepare($countSql);
            
                // Bind values for counting
                if (!empty($title)) { $countStmt->bindValue(':title', '%' . $title . '%'); }
                if (!empty($date)) { $countStmt->bindValue(':eventDate', $date); }
                $countStmt->execute();
                $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['totalCount'];
            
                // Fetch records with pagination
                $sql = "SELECT * FROM " . $this->table . " WHERE eventDate >= CURDATE() AND active=1 AND deleted=0";
                if (!empty($title)) { $sql .= " AND title LIKE :title"; }
                if (!empty($date)) { $sql .= " AND eventDate = :eventDate"; }
                $sql .= " ORDER BY id DESC";
                $sql .= " LIMIT " . (int)$limit;  // Set limit directly
            
                $stmt = $this->conn->prepare($sql);
            
                // Bind values based on conditions
                if (!empty($title)) { $stmt->bindValue(':title', '%' . $title . '%'); }
                if (!empty($date)) { $stmt->bindValue(':eventDate', $date); }

                $isExecuted = $stmt->execute();
                
                if ($isExecuted) {            
                    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);                  
                    $formattedEvents = array();
                    foreach ($events as $row) {
                        $formattedEvents[] = array(
                            'id' => $row['id'],
                            'userId' => $row['userId'],
                            'title' => $row['title'],
                            'description' => $row['description'],
                            'eventDate' => date('d-m-Y', strtotime($row['eventDate'])),
                            'eventTime' => $row['eventTime'],
                            'image' => $row['image']
                        );
                    }   
                    $response->getEvents =  $formattedEvents;                   
                } else {                   
                    $response->err = 1;
                    $response->errMsg = "Cannot Delete!";     
                }              
            } catch (PDOException $e) {
                $response->err = 1;
                $response->errMsg = "Cannot Delete! Error: " . $e->getMessage();    
            } finally {
                $this->conn = null;  
            }
            return json_encode($response); 
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
 

    }
?>