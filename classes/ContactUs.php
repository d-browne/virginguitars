<?php

require_once 'classes/Database.php';

class ContactUs
{
    // Declare class variables
    private $ID;
    private $blurb_path;
    private $contact_email;
    private $contact_telephone;
    private $contact_address_line_1;
    private $contact_address_line_2;
    private $contact_address_line_3;
    private $facebook_url;
    private $twitter_url;
    private $youtube_url;
    private $privacy_policy_path;
    private $isInitialized = false;         // Whether the class is initialized or not
    
    public function set_contact_email($emailInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Get safe input string
        $email = mysqli_real_escape_string($dataConnection, $emailInput);
        
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
        
        // Query to update contact_email
        $query = "UPDATE CONTACT_US SET contact_email='".$email."' WHERE ID=1";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result == false)
        {
            return "query failed";
        }
        
        // Update contact_email in memory
        $this->contact_email = $email;
        
        // All OK
        return true;
    }
    
    public function set_blurb_path($pathInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Get safe string path
        $path = mysqli_real_escape_string($dataConnection, $pathInput);
        
        // If string is too long break execution
        if (iconv_strlen($path) > 60)
        {
            return false; 
        }
         
        // Query to update blurb path 
        $query = "UPDATE CONTACT_US SET blurb_path='".$path."' WHERE ID=1";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Query failed return false
        if($result == false)
        {
            return false;
        }
        
        // Update local variable
        $this->blurb_path = $path;
        
        return true; // All OK.
    }
    
    // Getters
    public function get_isInitialized()
    {
        return $this->isInitialized;
    }
    
    
    public function get_privacy_policy_path()
    {
        return $this->privacy_policy_path;
    }
    
    public function get_youtube_url()
    {
        return $this->youtube_url;
    }
    
    public function get_twitter_url()
    {
        return $this->twitter_url;
    }
    
    public function get_facebook_url()
    {
        return $this->facebook_url;
    }
    
    public function get_contact_address_line3()
    {
        return $this->contact_address_line_3;
    }
    
    public function get_contact_address_line2()
    {
        return $this->contact_address_line_2;
    }
    
    public function get_contact_address_line1()
    {
        return $this->contact_address_line_1;
    }
    
    public function get_contact_telephone()
    {
        return $this->contact_telephone;
    }
    
    public function get_contact_email()
    {
        return $this->contact_email;
    }
    
    
    public function get_blurb_path()
    {
        return $this->blurb_path;
    }
    
    public function getID()
    {
        return $this->ID;
    }
    
    // Class contructor
    function __construct()
    {
        // Query database to get all class variables
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to get all values
        $query = "SELECT * FROM CONTACT_US";
        // Execyte query
        $result = $dataConnection->query($query);
        
        // If result returned
        if ($result)
        {
            // If row returned
            if ($result->num_rows > 0)
            {
                // Get the first row
                $row = $result->fetch_assoc();
                
                $this->ID = $row['ID'];
                $this->blurb_path = $row['blurb_path'];
                $this->contact_email = $row['contact_email'];
                $this->contact_telephone = $row['contact_telephone'];
                $this->contact_address_line_1 = $row['contact_address_line_1'];
                $this->contact_address_line_2 = $row['contact_address_line_2'];
                $this->contact_address_line_3 = $row['contact_address_line_3'];
                $this->facebook_url = $row['facebook_url'];
                $this->twitter_url = $row['twitter_url'];
                $this->youtube_url = $row['youtube_url'];
                $this->privacy_policy_path = $row['privacy_policy_path'];
                $this->isInitialized = true;
            }
        }
    }
}