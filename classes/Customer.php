<?php

class Customer
{
    private $LastName;
    private $FirstName;
    private $Salutation;
    private $MailingList;
    private $Email;
    private $MobilePhone;
    private $HomePhone;
    private $hashedPassword;
    private $salt;
    private $isInitialized; // Tells whether or not this object is initialized with data form the database
    
    // Function to initialize the object
    public function initialize($email)
    {
        // If email doesn't exist in database return null
        if (!Customer::doesCustomerExist($email))
        {
            return NULL;
        }
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to get watned values
        $query = "SELECT * FROM customer WHERE Email = '".mysqli_real_escape_string($dataConnection, $email)."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Get row
        $row = $result->fetch_assoc();
        
        // Get values from row
        $this->LastName = $row["LastName"];
        $this->FirstName = $row["FirstName"];
        $this->Salutation = $row["Salutation"];
        $this->MailingList = $row["MailingList"];
        $this->Email = $row["Email"];
        $this->MobilePhone = $row["MobilePhone"];
        $this->HomePhone = $row["HomePhone"];
        $this->hashedPassword = $row["EncryptedPassword"];
        $this->salt = $row["Salt"];
        
        // Set is initialized
        $this->isInitialized = true;
        
        return $this; // Return a handle to this object
    }
    
    // Return the get initialized status
    public function getIsInitialized()
    {
        return $this->isInitialized;
    }
    
    // Function to delete customer from databse
    public static function deleteCusomter($email) 
    {
        // Check if customer exists in database
        if(Customer::doesCustomerExist($email))
        {
            // get data connection
            $database = new Database();
            $dataConnection = $database->getDataConnection();
            
            // Query to delete customer
            $query = "DELETE FROM customer WHERE Email = '".mysqli_real_escape_string($dataConnection, $email)."';";
            
            // Execute query 
            $dataConnection->query($query);
            
            // Check if customer has been deleted
            if (Customer::doesCustomerExist($email))
            {
                return "failed";
            }
            else
            {
                return "deleted";
            }
        }
        else
        {
            return "doesn't exist";
        }
    }
    
    // Returns true if customer created and false if not
    public static function newCustomer($email, $password)
    {
        // Check if customer already exists
        if (Customer::doesCustomerExist($email))
        {
            return false;
        }
        
        // Check if email invalid
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
        {
            return "invalid email";
        }
        
        // Populate default vauls
        $Email = $email; // Set email
        $LastName = "";
        $FirstName = "";
        $Salutation = "";
        $MailingList = 0;
        
        // Generate hashed password and salt
        $salt = mt_rand(-4000,2147483647); // Generate random salt for database
        $hashedPassword = hash ("sha256", $password . $salt);
        
        // create a data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to add user to database
        $query = "INSERT INTO customer VALUES (DEFAULT, '".
                mysqli_real_escape_string($dataConnection, $LastName) ."', '".
                mysqli_real_escape_string($dataConnection, $FirstName) ."', '".
                mysqli_real_escape_string($dataConnection, $Salutation) ."', ".
                mysqli_real_escape_string($dataConnection, $MailingList) .", '".
                mysqli_real_escape_string($dataConnection, $Email) ."', '".
                mysqli_real_escape_string($dataConnection, $hashedPassword) ."', ".
                mysqli_real_escape_string($dataConnection, $salt) .", NULL, NULL)";

        // Execute query
        $dataConnection->query($query);
        
        // Check if customer was created successfully
        if (Customer::validateCustomer($email, $password))
        {
            return true;
        }
        else
        {
            die(); // This should never happen.
        }
    }
    
    public function getMailingList()
    {
        return $this->MailingList;
    }
    
    public function getHomePhone()
    {
        return $this->HomePhone;
    }
    
    public function getMobilePhone()
    {
        return $this->MobilePhone;
    }
    
    public function getEmail()
    {
        return $this->Email;
    }
    
    public function isMailingList()
    {
        return $this->MailingList;
    }
    
    public function getSalutation()
    {
        return $this->Salutation;
    }
    
    public function getFirstName()
    {
       return $this->FirstName;
    }
    
    
    public function getLastName()
    {
        return $this->LastName;
    }
    
    // Class Constructor
    function __construct()
    {
        
    }
    
    // Function to check if customer exists
    public static function doesCustomerExist($email)
    {
        // create a data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        
        
        // Query to select email address
        $query = "SELECT Email FROM customer WHERE Email = '".mysqli_real_escape_string($dataConnection, $email)."'";
        $result = $dataConnection->query($query);
        
        // Check if result is set
        if ($result->num_rows > 0)
        {
            return true;
        }
        return false; 
    }

    // Function to check if user exists in database
    public static function validateCustomer($email, $password)
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
