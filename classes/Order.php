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
    
    public static function createNewOrder($CustomerIDInput, $SubTotalInput, $ShippingInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $CustomerID = mysqli_real_escape_string($dataConnection, $CustomerIDInput);
        $SubTotal = mysqli_real_escape_string($dataConnection, $SubTotalInput);
        $Shipping = mysqli_real_escape_string($dataConnection, $ShippingInput);
        $Total = $SubTotal+$Shipping;
        
        
        // Create new delivery address record
        $createDeliveryAddressQuery = "INSERT INTO DELIVERYADDRESS VALUES (NULL, '', '', '', '', '')";
        
        // Execute query
        $createDeliverAddressResult = $dataConnection->query($createDeliveryAddressQuery);
        
        // Throw if unable to create new delivery address
        if ($createDeliverAddressResult === false)
        {
            throw new Exception("Unable to create delivery address record");
        }
        
        // Get the ID of newcreated alivery address
        $DeliveryAddressID = mysqli_insert_id($dataConnection);
        
        // Query to create new SALES_ORDER
        $createSalesOrderQuery = "INSERT INTO SALES_ORDER VALUES (NULL, '".$CustomerID."', '".$DeliveryAddressID."', CURDATE(), '".$SubTotal."', '".$Shipping."', '".$Total."', NULL, NULL, 1);";
        
        // Execute query to create new sales order
        $createSalesOrderResult = $dataConnection->query($createSalesOrderQuery);
        
        // Throw if query fails
        if ($createSalesOrderResult === false)
        {
            throw new Exception("Unable to create sales order record");
        }
        
        // All OK
        // Return the ID of the newly created order
        return mysqli_insert_id($dataConnection);
    }
    
    function setOrderStatus($OrderStatusInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $OrderStatus = mysqli_real_escape_string($dataConnection, $OrderStatusInput);
        
        if ($OrderStatus !== "Requested" && $OrderStatus !== "Processing" && $OrderStatus !== "Shipped" && $OrderStatus !== "Completed" && $OrderStatus !== "Cancelled")
        {
            return "Invalid Order Status";
        }
        
        $orderStatusID = 0;
        
        switch ($OrderStatus)
        {
            case "Requested":
                $orderStatusID = 1;
                break;
            case "Processing":
                $orderStatusID = 2;
                break;
            case "Shipped":
                $orderStatusID = 3;
                break;
            case "Completed":
                $orderStatusID = 4;
                break;
            case "Cancelled":
                $orderStatusID = 5;
                break;
        }
        
        // Query to update Shipped Date
        $query = "UPDATE SALES_ORDER SET OrderStatusFK=".$orderStatusID." WHERE SalesOrderID='".$this->SalesOrderID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return string error on query failure
        if ($result === false)
        {
            return "Failed to update OrderStatus";
        }
        
        // Update object in memory
        $this->OrderStatus = $OrderStatus;
        // all ok return true
        return true;
    }
    
    function setShippingRecord($ShippingRecordInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $ShippingRecord = mysqli_real_escape_string($dataConnection, $ShippingRecordInput);
        
        // Return too long error string if too long
        if (iconv_strlen($ShippingRecord) > 50)
        {
            return "ShippingRecord too long";
        }
        
        // Query to update Shipped Date
        $query = "UPDATE SALES_ORDER SET ShippingRecord='".$ShippingRecord."' WHERE SalesOrderID='".$this->SalesOrderID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return string error on query failure
        if ($result === false)
        {
            return "Failed to update ShippingRecord";
        }
        
        // Update object in memory
        $this->ShippingRecord = $ShippingRecord;
        // all ok return true
        return true;
    }
    
    function setShippedDate($ShippedDateInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $ShippedDate = mysqli_real_escape_string($dataConnection, $ShippedDateInput);
        
        // Return too long error string if too long
        if (iconv_strlen($ShippedDate) > 10)
        {
            return "ShippedDate too long";
        }
        
        $query = ""; // Hold the query string
        
        if ($ShippedDate === NULL || $ShippedDate === "")
        {
            // Query to update Shipped Date
            $query = "UPDATE SALES_ORDER SET ShippedDate=NULL WHERE SalesOrderID='".$this->SalesOrderID."';";
        }
        else
        {
            // Ensure shipped date matches the format yyyy-mm-dd
            $regexPattern = "/^\d\d\d\d\-[0-1]\d\-[0-3]\d$/";
            
            if (preg_match($regexPattern, $ShippedDate) !== 1)
            {
                return "ShippedDate incorrect date format";
            }

            // Query to update Shipped Date
            $query = "UPDATE SALES_ORDER SET ShippedDate='".$ShippedDate."' WHERE SalesOrderID='".$this->SalesOrderID."';";
        }
        

        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return string error on query failure
        if ($result === false)
        {
            return "Failed to update ShippedDate";
        }
        
        // Update object in memory
        $this->ShippedDate = $ShippedDate;
        // all ok return true
        return true;
    }
    
    function setCountry($CountryInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $Country = mysqli_real_escape_string($dataConnection, $CountryInput);
        
        // Return too long error string if too long
        if (iconv_strlen($Country) > 15)
        {
            return "Country too long";
        }
        
        // Query to update Country
        //$query = "CALL UpdateDeliveryCountry('".$Country."', '".$this->SalesOrderID."');"; // stored procedure
        $query = "UPDATE DELIVERYADDRESS JOIN SALES_ORDER ON SALES_ORDER.DeliveryAddressFK = DELIVERYADDRESS.DeliveryAddressID"
                . " SET Country='".$Country."' WHERE SALES_ORDER.SalesOrderID='".$this->SalesOrderID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return string error on query failure
        if ($result === false)
        {
            return "Failed to update Country";
        }
        
        // Update object in memory
        $this->Country = $Country;
        // all ok return true
        return true;
    }
    
    function setPostCode($PostCodeInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $PostCode = mysqli_real_escape_string($dataConnection, $PostCodeInput);
        
        // Return too long error string if too long
        if (iconv_strlen($PostCode) > 4)
        {
            return "PostCode too long";
        }
        
        // Query to update PostCode
        //$query = "CALL UpdateDeliveryPostCode('".$PostCode."', '".$this->SalesOrderID."');"; // stored procedure
        $query = "UPDATE DELIVERYADDRESS JOIN SALES_ORDER ON SALES_ORDER.DeliveryAddressFK = DELIVERYADDRESS.DeliveryAddressID"
                . " SET PostCode='".$PostCode."' WHERE SALES_ORDER.SalesOrderID='".$this->SalesOrderID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return string error on query failure
        if ($result === false)
        {
            return "Failed to update PostCode";
        }
        
        // Update object in memory
        $this->PostCode = $PostCode;
        // all ok return true
        return true;
    }
    
    function setState($StateInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $State = mysqli_real_escape_string($dataConnection, $StateInput);
        
        // Return too long error string if too long
        if (iconv_strlen($State) > 50)
        {
            return "State too long";
        }
        
        // Query to update State
        //$query = "CALL UpdateDeliveryState('".$State."', '".$this->SalesOrderID."');"; // stored procedure
        $query = "UPDATE DELIVERYADDRESS JOIN SALES_ORDER ON SALES_ORDER.DeliveryAddressFK = DELIVERYADDRESS.DeliveryAddressID"
                . " SET State='".$State."' WHERE SALES_ORDER.SalesOrderID='".$this->SalesOrderID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return string error on query failure
        if ($result === false)
        {
            return "Failed to update State";
        }
        
        // Update object in memory
        $this->State = $State;
        // all ok return true
        return true;
    }
    
    function setCity($CityInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $City = mysqli_real_escape_string($dataConnection, $CityInput);
        
        // Return too long error string if too long
        if (iconv_strlen($City) > 50)
        {
            return "City too long";
        }
        
        // Query to update city
        //$query = "CALL UpdateDeliveryCity('".$City."', '".$this->SalesOrderID."');"; // stored procedure
        $query = "UPDATE DELIVERYADDRESS JOIN SALES_ORDER ON SALES_ORDER.DeliveryAddressFK = DELIVERYADDRESS.DeliveryAddressID"
                . " SET City='".$City."' WHERE SALES_ORDER.SalesOrderID='".$this->SalesOrderID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return string error on query failure
        if ($result === false)
        {
            return "Failed to update city";
        }
        
        // Update object in memory
        $this->City = $City;
        // all ok return true
        return true;
    }
    
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
