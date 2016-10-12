<?php

require_once 'classes/Database.php';

class Admin 
{
    private $isAuthenticated;
    private $connection;
    private $AdministratorID; 
    
    function getAdministratorID() {
        return $this->AdministratorID;
    }
 
    // Construct
    function __construct($username, $password)
    {
        
        $database = new Database();
        
        $this->connection = $database->getDataConnection();
        

        return $this->authenticate($username, $password);
    }
    
    // Function to authenticate admin
    public function authenticate($username, $password)
    {
        $query = "SELECT AdministratorID,UserName,EncryptedPassword,Salt FROM ADMINISTRATOR";
        $result = $this->connection->query($query);
           
        
        if ($result->num_rows > 0)
        {
            // Set authenticated status to false
            $this->isAuthenticated = false;
            
            // Loop through each row and check if matches database
            while ($row = $result->fetch_assoc()) 
            {
                // Hash the password
                $hashedPassword = hash("sha256", $password . $row["Salt"]);
                
                //echo "\n\n".$password." hased to: ".$hashedPassword."\n\n";
                
                // Compared the username password combos to those in database
                if ($row["UserName"] == $username && $row["EncryptedPassword"] == $hashedPassword)
                {
                    $this->isAuthenticated = TRUE;
                    $this->AdministratorID = $row['AdministratorID'];
                }
            }
        }
        else
        {
            $this->isAuthenticated = FALSE;
        }
        $this->connection->close();
    }
    
    // Function to get authenticated status
    public function getAuthenticated()
    {
        return $this->isAuthenticated;
    }
}