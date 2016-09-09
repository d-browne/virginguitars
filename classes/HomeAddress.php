<?php

/* 
 * This class represents the HomeAddress object
 */

require_once 'classes/Database.php';

class HomeAddress
{
    private $HomeAddressID;
    private $CustomerID;
    private $StreetAddress;
    private $City;
    private $State;
    private $PostCode;
    private $Country;
    
    // Class Constructor
    // Creates object based on provided CustomerID
    function __construct($CustomerIDInput)
    {
       
        // Check if check if customer ID present in HOMEADDRESS table
        // If present create object using values
        // Otherwise create new record with blank values. 
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
         // Sanitize input
        $CustomerID = mysqli_real_escape_string($dataConnection, $CustomerIDInput);
        
        // throw if not integer
        if (!is_numeric($CustomerID))
        {
            throw new Exception("CusomterID is not numeric");
        }
        
        // Query check if customer exists
        $query = "SELECT CustomerID FROM CUSTOMER WHERE CustomerID=".$CustomerID.";";
        
        // Execute query to check if customer exists
        $result = $dataConnection->query($query);
        
        // Throw if query failed
        if ($result === false)
        {
            throw new Exception("Query failed: check if customer exists");
        }
        
        if ($result->num_rows < 1)
        {
            throw new Exception("No CustomerID found in DB");
        }
        
        // Query to find customer
        $query = "SELECT * FROM HOMEADDRESS WHERE CustomerFK=".$CustomerID.";";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Break execution if query fails
        if ($result === false)
        {
            throw new Exception("Query failed");
        }
        
        if ($result->num_rows > 0) 
        {
            // Get the first row of result
            $row = $result->fetch_assoc();
            
            // Set local variables
            $this->HomeAddressID = $row['HomeAddressID'];
            $this->CustomerID = $row['CustomerFK'];
            $this->StreetAddress = $row['StreetAddress'];
            $this->City = $row['City'];
            $this->State = $row['State'];
            $this->PostCode = $row['PostCode'];
            $this->Country = $row['Country'];
        }
    }
    
    // Start getters
    public function getHomeAddressID()
    {
        return $this->HomeAddressID;
    }
    public function getCustomerID()
    {
        return $this->CustomerID;
    }
    public function getStreetAddress()
    {
        $this->StreetAddress;
    }
    public function getCity()
    {
        return $this->City;
    }
    public function getState()
    {
        return $this->State;
    }
    public function getPostCode()
    {
        return $this->PostCode;
    }
    public function getCountry()
    {
        return $this->Country;
    }
    // End getters
}
