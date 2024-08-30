<?php
    include 'config.php'; 

    function registerUser($vars){   
        global $conn;
        $response = new stdClass();
        $response->err = 0;
        $response->errMsg = null;
        $response->successMsg = null;    

        $username = $vars->username;
        $email = $vars->email;
        $password = $vars->password;
        $confirmPassword = $vars->confirmPassword;
       
        $checkUserInput = validateUserData($vars);
        if($checkUserInput->err){
            $response = $checkUserInput;
            return json_encode($response);
        }   

        try{            
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);         
            $sql = "SELECT COUNT(*) FROM tbl_users WHERE username = :username OR email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $existingCount = $stmt->fetchColumn();    

            if ($existingCount > 0) {               
                $sql = "SELECT COUNT(*) FROM tbl_users WHERE username = :username";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $usernameCount = $stmt->fetchColumn();
                
                if ($usernameCount > 0) {
                    $response->err = 1;
                    $response->errMsg = "Username already exists. Please choose a different Username.";
                } else {
                    $response->err = 1;
                    $response->errMsg = "Email already exists. Please use a different email.";
                }
                return json_encode($response); 
            } else {
                $sql = "INSERT INTO tbl_users (username, email, password) VALUES (:username, :email, :password)";
                $stmt = $conn->prepare($sql);

                // Bind parameters
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashedPassword);

                // Execute the query
                $stmt->execute();
                
                $conn = null;
                $response->successMsg = "Registered Successfully...!";
                return json_encode($response); 
            }      
        }        
        catch(PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    } 

    function verifyrUser($vars){  
        global $conn;
        $response = new stdClass();
        $response->err = 0;
        $response->errMsg = null;
        $response->successMsg = null;    

        $username = $vars->username;       
        $password = $vars->password;            

        try {
            // Fetch the user record by email
            $sql = "SELECT * FROM tbl_users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);          

            if ($user) {               
                if (password_verify($password, $user['password'])) {                    
                    $response->err = 0;
                    $response->successMsg = "Login successful!";
                    // Add your session handling code here
                } else {
                    // Password is incorrect
                    $response->err = 1;
                    $response->errMsg = "Invalid password.";
                }
            } else {
                // User not found
                $response->err = 1;
                $response->errMsg = "No user found with that username .";
            }
        
            return json_encode($response);
        
        } catch(PDOException $e) {
            $response->err = true;
            $response->errMsg = "Error: " . $e->getMessage();
            return json_encode($response);
        }

    }

    function validateUserData($vars){
        $username = $vars->username;
        $email = $vars->email;
        $password = $vars->password;       
        $confirmPassword = $vars->confirmPassword;

        $response = new stdClass();       
        $response->err = 0;
        $response->errMsg = null;
        $response->successMsg = null;      

        if(!$username ==''  && !$email =='' &&  !$password =='' && !$confirmPassword ==''){
            $ePattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
            $uPattern = "/^[a-zA-Z0-9._]+$/";          
            $pPattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';    
           
            if (!preg_match($ePattern, $email)) {                
                $response->errMsg = "Please enter a valid email.";
                $response->err = 1;
            }
            elseif(!preg_match($uPattern, $username)) {               
                $response->errMsg = "Please enter a valid username.";
                $response->err = 1;
            }  
            elseif(!preg_match($pPattern, $password)) {
                $response->errMsg = "Password must be at least 8 characters long and include at least one uppercase letter, one number, and one special character.";
                $response->err = 1;
            }  
            elseif($password !== $confirmPassword) {                
                $response->errMsg = "Password does not match.";      
                $response->err = 1;         
            }   
            else{
                $response->err = 0;               
            }            
        }
        else{
            $response->errMsg = "All fields are required.";    
         }
        return $response;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from POST request  
        $vars = new stdClass();      
        $vars->username = isset($_POST['username']) ? trim($_POST['username']) : "";        
        $vars->password = isset($_POST['password']) ? trim($_POST['password']) : "";        
        $function = isset($_POST['function']) ? $_POST['function'] : '';
    
        // Determine which function to call
        switch ($function) {
            case 'registerUser':
                $vars->email = isset($_POST['email']) ? trim($_POST['email']) : "";
                $vars->confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : "";
                echo registerUser($vars);
                break;
            case 'verifyrUser':
                echo verifyrUser($vars);
                break;
            default:
                $response = new stdClass();
                $response->err = 1;
                $response->errMsg = "Invalid request.";
                echo json_encode($response);
                break;
        }
    }
    