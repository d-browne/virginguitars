<?php

/* 
 * The class represents the cart object
 */

require_once 'classes/Database.php';
require_once 'classes/Customer.php';
require_once 'classes/Product.php';


class Cart 
{
    private $CustomerID;
    
    // Function to empty cart
    public function emptyCart()
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query to empty cart
        $query = "DELETE FROM CART WHERE CustomerFK='".$this->CustomerID."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to clear cart";
        }
        
        // All ok return true
        return true;
    }
    
    // Function to remove item from cart
    public function delItem($ProductIDInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $ProductID = mysqli_real_escape_string($dataConnection, $ProductIDInput);
        
        // Error if specified item is not in cart
        if (!$this->isInCart($ProductID))
        {
            return "Specified Item is not in cart";
        }
        
        // Query to delete item
        $query = "DELETE FROM CART WHERE ProductFK='".$ProductID."' AND CustomerFK='".$this->CustomerID."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to delete item from cart";
        }
        
        // Return true (all OK)
        return true;
    }
    
    // If the number of items available is lowered below what a user has specified in their cart, 
    // this function will lowre the number of items in the cart to the number of items available
    public function refreshQuantity()
    {
        // Get data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Query quantity of all items in cart
        $query = "SELECT * FROM CART_VIEW WHERE CustomerFK='".$this->CustomerID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if unable to query
        if ($result === false)
        {
            return "Unable to query for quantities";
        }
        
        // If result is returned
        if ($result->num_rows > 0)
        {
            // Loop through each row
            while ($row = $result->fetch_assoc())
            {
                // Create a product object
                $product = new Product($row['ProductID']);
                
                // If the cart has more than is available
                if ($row['Quantity'] > $product->getQuantity() && $row['Status'] != "Backorder")
                {
                    // Set to max available
                    $this->setQuantity($row['ProductID'], $product->getQuantity());
                }
            }
        }
    }
    
    // Function to set quantity of item in cart
    public function setQuantity($ProductIDInput, $QuantityInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $ProductID = mysqli_real_escape_string($dataConnection, $ProductIDInput);
        $Quantity = mysqli_real_escape_string($dataConnection, $QuantityInput);
        
        // Return if quantity is not numeric
        if (!is_numeric($Quantity))
        {
            return "Quantity must be a number";
        }
        
        // Return if quantity is less than 0
        if ($Quantity < 1)
        {
            return "Quantity must not be less than one";
        }
        
        // Return error if quantity is greater than in stock products
        // Unless status is "Backorder"
        $product = new Product($ProductID);
        if ($Quantity > $product->getQuantity() && $product->getStatus() != "Backorder")
        {
            return "Cannot set quantity to ".$Quantity." only ".$product->getQuantity()." left";
        }
        
        // If item is not is cart, add it
        if (!$this->isInCart($ProductID))
        {
            $addResult = $this->addToCart($ProductID);
            
            // If add to cart error return error
            if (!$addResult)
            {
                return $addResult;
            }
        }
        
        // Query to update quantity
        $query = "UPDATE CART SET Quantity='".$Quantity."' WHERE CustomerFK='".$this->CustomerID."' AND ProductFK='".$ProductID."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to update quantity";
        }
        
        // All ok return true
        return true;
    }
    
    // Function to check if specified product is in cart
    public function isInCart($ProductIDInput)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $ProductID = mysqli_real_escape_string($dataConnection, $ProductIDInput);
        
        // Query to check if product is in cart
        $query = "SELECT * FROM CART WHERE ProductFK='".$ProductID."' AND CustomerFK='".$this->CustomerID."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to query for product in cart";
        }
        
        // Check if the number of results is > 0
        // If so that means the item is already in cart
        if ($result->num_rows > 0)
        {
            return true;
        }
        
        // Return false, item is not yet in cart
        return false;
    }
    
    public function addToCart($ProductID)
    {
        // Return error if item already in cart
        if ($this->isInCart($ProductID))
        {
            return "Item already in cart";
        }
        else
        {   
            // Create data connection
            $database = new Database();
            $dataConnection = $database->getDataConnection();
            
            // Check if product exists by attempting to instantiate it
            try {
                $product = new Product($ProductID);
                
                // return error if product is out of stock
                if ($product->getStatus() === "Out Of Stock")
                {
                    return "Unable to add product, out of stock and not on backorder";
                }
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
            
            // Query to add item to cart
            $query = "INSERT INTO CART VALUES (NULL, '".$this->CustomerID."', '".$product->getProductID()."', 1);";
            
            // Execute query
            $result = $dataConnection->query($query);
            
            // Return error if query fails
            if ($result === false)
            {
                return "Unable to add item to cart";
            }
            
            // All ok
            return true;
        }
    }
    
    public function __construct($CustomerID) 
    {
        // Throw if customer doesn't exist
        if (!Customer::doesCustomerExistID($CustomerID))
        {
            throw new Exception("Specified customer doesn't exist");
        }
        
        // Set customer id
        $this->CustomerID = $CustomerID;
    }
    
    function getCustomerID() {
        return $this->CustomerID;
    }
}
