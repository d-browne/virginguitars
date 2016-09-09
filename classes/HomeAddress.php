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
