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
    private $CustomerID;
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
        
        // Query to get order details
        $query = "SELECT * FROM ORDERS_STATUS WHERE SalesOrderID='".$SalesOrderID."'";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Throw if query fails
        if ($result === false)
        {
            throw new Exception("Error querying for order details");
        }
        
        // Throw if no results returned
        if ($result->num_rows < 1)
        {
            throw new Exception("Specified Order ID does not exist");
        }
        
        // Get the row from result
        $row = $result->fetch_assoc();
        
        // Populate object properties
        $this->SalesOrderID = $row['SalesOrderID'];
        $this->CustomerID = $row['CustomerFK'];
        $this->InvoiceDate = $row['InvoiceDate'];
        $this->SubTotal = $row['SubTotal'];
        $this->Shipping = $row['Shipping'];
        $this->Total = $row['Total'];
        $this->ShippedDate = $row['ShippedDate'];
        $this->ShippingRecord = $row['ShippingRecord'];
        $this->OrderStatus = $row['Order Status'];
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
    
    function getCustomerID() {
        return $this->CustomerID;
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
