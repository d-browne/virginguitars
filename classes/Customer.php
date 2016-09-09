<?php

require_once 'classes/Database.php';
require_once 'classes/HomeAddress.php';

class Customer
{
    private $CustomerID;
    private $LastName;
    private $FirstName;
    private $Salutation;
    private $MailingList;
    private $Email;
    private $MobilePhone;
    private $HomePhone;
    private $hashedPassword;
    private $salt;
    private $isInitialized = false; // Tells whether or not this object is initialized with data form the database
    private $homeAddress;           // Holds home address object
    
    public function getHomeAddress()
    {
        return $this->homeAddress;
    }
    
    public function getCustomerID()
    {
        return $this->CustomerID;
    }
    
    public function setPassword($newPassword)
    {
        // Return error (false) if not initialized member
        if (!$this->isInitialized)
        {
            return "Member Not Initialized";
        }
        
        // Generate hashed password and salt
        $salt = mt_rand(-4000,2147483647); // Generate random salt for database
        $hashedPassword = hash ("sha256", $newPassword . $salt);
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to update password and salt
        $query = "UPDATE customer SET EncryptedPassword = '".$hashedPassword."', Salt=".$salt." WHERE Email = '".$this->Email."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query fails
        if(!$result)
        {
            return "Query Failed";
        }
        
        // If everything went okay update object and return true
        $this->hashedPassword = $hashedPassword;
        $this->salt = $salt;
        return true;
    }
    
    public function setMobilePhone($newMobilePhone)
    {
        // Return error (false) if not initialized member
        if (!$this->isInitialized)
        {
            return "Member Not Initialized";
        }
        
        // Return error of phone number too long
        if (iconv_strlen($newMobilePhone) > 15)
        {
            return "Too Long";
        }
        
        // Return error if phone number contains anthing other than digits and ()
        $regexPattern = '/[^\d\(\) ]/';
        
        if (preg_match($regexPattern, $newMobilePhone))
        {
            return "Invalid Characters";
        }
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to update MobilePhone
        $query = "UPDATE customer SET MobilePhone = '".mysqli_real_escape_string($dataConnection, $newMobilePhone)."' "
                . "WHERE Email = '". $this->Email ."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query fails
        if(!$result)
        {
            return "Query Failed";
        }
        
        // If everything went right update object and return true
        $this->MobilePhone = $newMobilePhone;
        return true;
    }
    
    public function setHomePhone($newHomePhone)
    {
        // Return error (false) if not initialized member
        if (!$this->isInitialized)
        {
            return "Member Not Initialized";
        }
        
        // Return error of phone number too long
        if (iconv_strlen($newHomePhone) > 15)
        {
            return "Too Long";
        }
        
        // Return error if phone number contains anthing other than digits and ()
        $regexPattern = '/[^\d\(\) ]/';
        
        if (preg_match($regexPattern, $newHomePhone))
        {
            return "Invalid Characters";
        }
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to update HomePhone
        $query = "UPDATE customer SET HomePhone = '".mysqli_real_escape_string($dataConnection, $newHomePhone)."' "
                . "WHERE Email = '". $this->Email ."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query fails
        if(!$result)
        {
            return "Query Failed";
        }
        
        // If everything went right update object and return true
        $this->HomePhone = $newHomePhone;
        return true;
    }
    
    // Function to set/change email
    public function setEmail($email)
    {
        // Return error (false) if not initialized member
        if (!$this->isInitialized)
        {
            return "Member Not Initialized";
        }
        
        // Return error if email is too long
        if (iconv_strlen($email) > 60)
        {
            return "Too Long";
        }
        
        // Return error if email is not a valid email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
        {
            return "Invalid Email";
        }
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to change Email
        $query = "UPDATE customer SET Email = '".mysqli_real_escape_string($dataConnection, $email)."' "
                . "WHERE Email = '". $this->Email ."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Error if query fails
        if (!$result)
        {
            // Restore object Email to original value
            return "Query Failed";
        }
        
        // Everything went right set object email and return true
        $this->Email = $email;
        return true;
    }
    
    // function to set mailing list
    public function setMailingList($joinedMailingList)
    {
        // Return error if not initialized member
        if (!$this->isInitialized)
        {
            return false;
        }
        
        // Check of incorrect input
        if ($joinedMailingList != 1 && $joinedMailingList != 0)
        {
            return false; // Incorrect input
        }
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to change LastName
        $query = "UPDATE customer SET MailingList = '".mysqli_real_escape_string($dataConnection, $joinedMailingList)."' "
                . "WHERE Email = '". $this->Email ."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return if query failed
        if(!$result)
        {
            return false;
        }
        
        // Update object MailingList
        $this->MailingList = $joinedMailingList;
        
        // return true everything worked
        return true;
    }
    
    // Function to set Salutation
    public function setSalutation($Salutation)
    {
        // Return error if not initialized member
        if (!$this->isInitialized)
        {
            return "member not initialized";
        }
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to change Salutation
        $query = "UPDATE customer SET Salutation = '".mysqli_real_escape_string($dataConnection, $Salutation)."' "
                . "WHERE Email = '". $this->Email ."';";

        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return false
        if (!$result)
        {
            return false;
        }
        
        $customer = new Customer();
        $customer->initialize($this->Email);
        
        $this->Salutation = $Salutation;
        
        return true;
    }
    
    // function to set FirstName
    public function setFirstName($FirstName)
    {
        // Return error if not initialized member
        if (!$this->isInitialized)
        {
            return "member not initialized";
        }
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to change LastName
        $query = "UPDATE customer SET FirstName = '".mysqli_real_escape_string($dataConnection, $FirstName)."' "
                . "WHERE Email = '". $this->Email ."';";

        // Execute query 
        $dataConnection->query($query);
        
        $customer = new Customer();
        $customer->initialize($this->Email);
        
        $this->FirstName = $FirstName;
        
        return true;
    }
    
    // function to set LastName
    public function setLastName($LastName)
    {
        // Return error if not initialized member
        if (!$this->isInitialized)
        {
            return "member not initialized";
        }
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to change LastName
        $query = "UPDATE customer SET LastName = '".mysqli_real_escape_string($dataConnection, $LastName)."' "
                . "WHERE Email = '". $this->Email ."';";

        // Execute query 
        $dataConnection->query($query);
        
        $customer = new Customer();
        $customer->initialize($this->Email);
        
        $this->LastName = $LastName;
        
        return true;
    }
    
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
        $query = "SELECT * FROM CUSTOMER WHERE Email = '".mysqli_real_escape_string($dataConnection, $email)."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Get row
        $row = $result->fetch_assoc();
        
        // Get values from row
        $this->CustomerID = $row["CustomerID"];
        $this->LastName = $row["LastName"];
        $this->FirstName = $row["FirstName"];
        $this->Salutation = $row["Salutation"];
        $this->MailingList = $row["MailingList"];
        $this->Email = $row["Email"];
        $this->MobilePhone = $row["MobilePhone"];
        $this->HomePhone = $row["HomePhone"];
        $this->hashedPassword = $row["EncryptedPassword"];
        $this->salt = $row["Salt"];
        
        // set home address object
        $this->homeAddress = new HomeAddress($this->CustomerID);
        
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
            $query = "DELETE FROM CUSTOMER WHERE Email = '".mysqli_real_escape_string($dataConnection, $email)."';";
            
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
        
        // Check if email is too long
        if (iconv_strlen($email) > 60)
        {
            return "email too long";
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
        $query = "INSERT INTO CUSTOMER VALUES (DEFAULT, '".
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
    
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }
    
    public function getSalt()
    {
        return $this->salt;
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
        $query = "SELECT Email FROM CUSTOMER WHERE Email = '".mysqli_real_escape_string($dataConnection, $email)."'";
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
        $query = "SELECT Email,EncryptedPassword,Salt FROM CUSTOMER";
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
