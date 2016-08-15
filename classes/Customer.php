<?php

class customer
{
    
    
    // Class Constructor
    function __construct()
    {
        
    }
    
    // Function to check if user exists in database
    public function checkDatabaseForUser($email, $password)
    {
        // Get a data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // query for email password and salt
        $query = "SELECT Email,EncryptedPassword,Salt FROM customer";
        // Execute query
        $results = $dataConnection->query($query);
        
        // If there are no results for the query (table empty) return false (customer is not in database)
        if ($results == NULL)
        {
            return false;
        }
        
        // If there is more than 0 results
        if ($results->num_rows > 0)
        {
            // Loop through each row
            while ($row = $results->fetch_assoc())
            {
                // Hash the password against table salt
                $hashedPassword = hash("sha256", $password . $row["Salt"]);
                
                // Check uemail and hashed password against database (row) values
                if ($email == $row["Email"] && $hashedPassword == $row["EncryptedPassword"])
                {
                    return true; // User is found in databse
                }
            }
            return false;
        }
        else // Zero results
        {
            return false; // Customer not in table
        }
    }
}
