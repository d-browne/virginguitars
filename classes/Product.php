<?php

/* 
 * Virgin Guitars E-commerce Website
 * Dominic Browne, Dale Hogan, Ben Morrison, Warren Norris
 * 
 * This Class defines the Product object.
 * 
 */

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
    public function __construct($ProductID) 
    {
        
    }
}