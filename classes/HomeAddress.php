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
    function __construct($CustomerID)
    {
        // Check if check if customer ID present in HOMEADDRESS table
        // If present create object using values
        // Otherwise create new record with blank values. 
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to find customer
        $query = "SELECT * FROM HOMEADDRESS WHERE CustomerFK='".mysqli_real_escape_string($dataConnection, $CustomerID)."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Break execution if query fails
        if ($result === false)
        {
            return;
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
