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
    
    function setStreetAddress($streetAddressInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $StreetAddress = mysqli_real_escape_string($dataConnection, $streetAddressInput);
        
        // Return too long error string if too long
        if (iconv_strlen($StreetAddress) > 50)
        {
            return "StreetAddress too long";
        }
        
        // Query to update street address
        //$query = "CALL UpdateDeliveryStreetAddress('".$StreetAddress."', '".$this->SalesOrderID."');"; // stored procedure
        $query = "UPDATE DELIVERYADDRESS JOIN SALES_ORDER ON SALES_ORDER.DeliveryAddressFK = DELIVERYADDRESS.DeliveryAddressID"
                . " SET StreetAddress='".$StreetAddress."' WHERE SALES_ORDER.SalesOrderID='".$this->SalesOrderID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return string error on query failure
        if ($result === false)
        {
            return "Failed to call UpdateDeliveryStreetAddress stored procedure";
        }
        
        // Update object in memory
        $this->StreetAddress = $StreetAddress;
        // all ok return true
        return true;
    }
        
    // Class contructor
    public function __construct($SalesOrderID) 
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to get order details
        $query = "SELECT * FROM ORDERS_STATUS WHERE SalesOrderID='".mysqli_real_escape_string($dataConnection, $SalesOrderID)."'";
        
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
        
        // Populate the delivery address variables
        // Query to find delivery address
        $query = "SELECT * FROM DELIVERY_ADDRESS_BY_ORDER_ID WHERE SalesOrderID='".mysqli_real_escape_string($dataConnection, $SalesOrderID)."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Throw if query malformed
        if ($result === false)
        {
            throw new Exception("Error querying for delivery details");
        }
        
        // Throw delivery address doesn't exist for order (must have)
        if ($result->num_rows < 1)
        {
            throw new Exception("Delivery address record for specified order not found");
        }
        
        // Get record as row
        $row = $result->fetch_assoc();
        
        // Populate the deliver address properties
        $this->StreetAddress = $row['StreetAddress'];
        $this->City = $row['City'];
        $this->State = $row['State'];
        $this->PostCode = $row['PostCode'];
        $this->Country = $row['Country'];
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