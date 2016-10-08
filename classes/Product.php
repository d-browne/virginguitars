<?php

/* 
 * Virgin Guitars E-commerce Website
 * Dominic Browne, Dale Hogan, Ben Morrison, Warren Norris
 * 
 * This Class defines the Product object.
 * 
 */

// Require database
require_once 'classes/Database.php';

class Product
{
    private $ProductID;
    private $PrimaryPicturePath;
    private $Brand;
    private $Type;
    private $Quantity;
    private $Status;
    private $Description;
    private $Condition;
    private $Price;
    private $CaseType;
    private $Model;
    private $CreatedBy;
    private $ModifiedBy;
    private $CreationDate;
    private $ModifiedDate;
    
    // Class constructor
    public function __construct($ProductIDInput) 
    {   
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // Sanitize input
        $ProductID = mysqli_real_escape_string($dataConnection, $ProductIDInput);
        
        // Query to select specified product
        $query = "SELECT * FROM PRODUCT_DETAILS_VIEW WHERE ProductID = '".$ProductID."';";
        
        //Execute query
        $result = $dataConnection->query($query);
        
        // Throw if query failed
        if ($result === false)
        {
            throw new Exception("Unable to query for product");
        }
        
        // Throw if result not produced 
        if ($result->num_rows < 1)
        {
            throw new Exception("ProductID not found");
        }
    }
}