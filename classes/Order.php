<?php

/* 
 * Virgin Guitars E-Commerce Website
 * 
 * This class represents the order object
 */

require_once 'classes/Database.php';

class Order
{
    private $SalesOrderID;
    private $InvoiceDate;
    private $SubTotal;
    private $Shipping;
    private $Total;
    private $ShippedDate;
    private $ShippingRecord;
    private $OrderStatus;
    
    // Delivery Address
    private $StreetAddress;
    private $City;
    private $State;
    private $PostCode;
    private $Country;
    
    // Class contructor
    public function __construct($SalesOrderID) 
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        
    }
    
    // Method to check of order exists
    public static function CheckIfExists($SalesOrderID)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to check if exists
        $query = "SELECT * FROM sales_order WHERE sales_order.SalesOrderID='".mysqli_real_escape_string($dataConnection, $SalesOrderID)."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // If query failed return failed string
        if ($result === false)
        {
            return "Query Failed";
        }
        
        if ($result->num_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    //Getters:
    function getSalesOrderID() {
        return $this->SalesOrderID;
    }

    function getInvoiceDate() {
        return $this->InvoiceDate;
    }

    function getSubTotal() {
        return $this->SubTotal;
    }

    function getShipping() {
        return $this->Shipping;
    }

    function getTotal() {
        return $this->Total;
    }

    function getShippedDate() {
        return $this->ShippedDate;
    }

    function getShippingRecord() {
        return $this->ShippingRecord;
    }

    function getOrderStatus() {
        return $this->OrderStatus;
    }

    function getStreetAddress() {
        return $this->StreetAddress;
    }

    function getCity() {
        return $this->City;
    }

    function getState() {
        return $this->State;
    }

    function getPostCode() {
        return $this->PostCode;
    }

    function getCountry() {
        return $this->Country;
    }


}
