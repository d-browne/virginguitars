<?php


class Admin 
{
    private $isAuthenticated;
    private $connection;
    
    // Construct
    function __construct($username, $password)
    {
        $dbservername = "localhost";
        $dbuser = "root";
        $dbpassword = "";
        $dbname = "vgecw_db";
        
        // Create connection
        $conn = new mysqli($dbservername, $dbuser, $dbpassword, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $this->connection = $conn;

        return $this->authenticate($username, $password);
    }
    
    // Function to authenticate admin
    public function authenticate($username, $password)
    {
        $query = "SELECT UserName,EncryptedPassword,Salt FROM administrator";
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
                }
            }
        }
        else
        {
            $$this->isAuthenticated = FALSE;
        }
        $this->connection->close();

        // TODO 
        // Check username and password against database
        // If username and password match database set authenticated to true
    }
    
    // Function to get authenticated status
    public function getAuthenticated()
    {
        return $this->isAuthenticated;
    }
}