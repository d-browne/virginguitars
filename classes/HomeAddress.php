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
    
    // Setters
    public function setCity($CityInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $City = mysqli_real_escape_string($dataConnection, $CityInput);
        
        // Check if City is too long
        if (iconv_strlen($City) > 50)
        {
            return "city too long";
        }
        
        // Query to update city
        $query = "UPDATE HOMEADDRESS SET City='".$City."' WHERE HomeAddressID='".$this->HomeAddressID."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Throw if query error
        if ($result === null)
        {
            throw new Exception("Error updating City");
        }
        
        // Update object memory
        $this->City = $City;
        // All okay
        return true;
    }
    
    public function setStreetAddress($StreetAddressInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $StreetAddress = mysqli_real_escape_string($dataConnection, $StreetAddressInput);
        
        // Check if address is too long
        if (iconv_strlen($StreetAddress) > 50)
        {
            return "street address too long";
        }
        
        // Query to update street address 
        $query = "UPDATE HOMEADDRESS SET StreetAddress='".$StreetAddress."' WHERE HomeAddressID='".$this->HomeAddressID."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Throw if query error
        if ($result === null)
        {
            throw new Exception("Error updating Street Address");
        }
        
        // Update object memory
        $this->StreetAddress = $StreetAddress;
        // All okay
        return true;
    }
    // End setters
    
    // Class Constructor
    // Creates object based on provided CustomerID
    function __construct($CustomerIDInput)
    {
       
        // Check if check if customer ID present in HOMEADDRESS table
        // If present create object using values
        // Otherwise create new record with blank values. 
        
        /*
         * Exception codes:
         * 0 - CustomerID not a number
         * 1- CustomerID does not match an existing customer
         */
        
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
         // Sanitize input
        $CustomerID = mysqli_real_escape_string($dataConnection, $CustomerIDInput);
        
        // throw if not integer
        if (!is_numeric($CustomerID))
        {
            throw new Exception("CustomerID is not numeric", 0);
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
            throw new Exception("No CustomerID found in DB", 1);
        }
        
        // Query to find customer
        $query = "SELECT * FROM HOMEADDRESS WHERE CustomerFK=".$CustomerID.";";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Break execution if query fails
        if ($result === false)
        {
            throw new Exception("Getting customer query failed");
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
        else
        {
            // Create new record for customer
            $query = "INSERT INTO HOMEADDRESS (HomeAddressID, CustomerFK, StreetAddress, City, State, PostCode, Country) VALUES (DEFAULT, ".$CustomerID.", '', '', '', '', '');";
            
            // Execute query 
            $result = $dataConnection->query($query);
            
            // throw if query fails
            if ($result === false)
            {
                throw new Exception("Creating new HOMEADDRESS record failed");
            }
            
            // Query for the newly inserted home address
            $query = "SELECT * FROM HOMEADDRESS WHERE CustomerFK=".$CustomerID.";";

            // Execute query
            $result = $dataConnection->query($query);

            // Break execution if query fails
            if ($result === false)
            {
                throw new Exception("Getting customer query failed");
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
            else
            {
                throw new Exception("Unable to find HOMEADDRESS record"); // This should never be thrown
            }
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
        return $this->StreetAddress;
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
