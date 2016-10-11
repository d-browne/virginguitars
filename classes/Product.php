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
    
    public function setDescription($inputDescription)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $Description = mysqli_real_escape_string($dataConnection, $inputDescription);
        
        // Return error if input too long
        if (iconv_strlen($Description) > 65534)
        {
            return "Description Too Long";
        }
        
        // Query to update Description
        $query = "UPDATE PRODUCT SET PRODUCT.Description='".$Description."' WHERE PRODUCT.ProductID='".$this->ProductID."'";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to update Description";
        }
        
        // Update object in memory
        $this->Description = $Description;
        
        // All OK return true
        return true;
    }
    
    public function setQuantity($inputQuantity)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $Quantity = mysqli_real_escape_string($dataConnection, $inputQuantity);
        
        // Return error if input not numeric
        if (!is_numeric($Quantity))
        {
            return "Quantity Not Numeric";
        }
        
        // Return error if Quantity is less than 0
        if ($Quantity < 0)
        {
            return "Quantity cannot be less than 0";
        }
        
        // Query to update Quantity
        $query = "UPDATE PRODUCT SET Quantity='".$Quantity."' WHERE PRODUCT.ProductID='".$this->ProductID."'";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to update Quantity";
        }
        
        // Update object in memory
        $this->Quantity = round($Quantity);
        
        // All OK return true
        return true;
    }
    
    public function setPrice($inputPrice)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $Price = mysqli_real_escape_string($dataConnection, $inputPrice);
        
        // Return error if input not numeric
        if (!is_numeric($Price))
        {
            return "Price Not Numeric";
        }
        
        // Return error if price is less than 0
        if ($Price < 0)
        {
            return "Price cannot be less than $0";
        }
        
        // Query to update Price
        $query = "UPDATE PRODUCT SET UnitPrice='".$Price."' WHERE PRODUCT.ProductID='".$this->ProductID."'";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to update Price";
        }
        
        // Update object in memory
        $this->Price = $Price;
        
        // All OK return true
        return true;
    }
    
    public function setStatus($inputStatus)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $Status = mysqli_real_escape_string($dataConnection, $inputStatus);
        
        // Query to check if Status exists 
        $query = "SELECT ProductStatusID FROM PRODUCT_STATUS WHERE Description = '".$Status."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to check if Status exists";
        }
        
        // Return error if no result returned
        if ($result->num_rows < 1)
        {
            return "Specified Status does not exist";
        }
        
        // Get Status id
        $row = $result->fetch_assoc();
        $StatusID = $row['ProductStatusID'];
        
        // Query to update Status
        $query = "UPDATE PRODUCT JOIN PRODUCT_STATUS ON PRODUCT_STATUS.ProductStatusID = PRODUCT.StatusFK SET PRODUCT.StatusFK = '".$StatusID."' WHERE PRODUCT.ProductID = '".$this->ProductID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query fails
        if ($result === false)
        {
            return "Unable to update Status";
        }
        
        // update Status in memory
        $this->Status = $Status;
        
        // All OK return true
        return true;
    }
    
    public function setCaseType($inputCaseType)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $CaseType = mysqli_real_escape_string($dataConnection, $inputCaseType);
        
        // Query to check if CaseType exists 
        $query = "SELECT CaseTypeID FROM CASE_TYPE WHERE Description = '".$CaseType."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to check if CaseType exists";
        }
        
        // Return error if no result returned
        if ($result->num_rows < 1)
        {
            return "Specified CaseType does not exist";
        }
        
        // Get CaseType id
        $row = $result->fetch_assoc();
        $CaseTypeID = $row['CaseTypeID'];
        
        // Query to update CaseType
        $query = "UPDATE PRODUCT JOIN CASE_TYPE ON CASE_TYPE.CaseTypeID = PRODUCT.CaseTypeFK SET PRODUCT.CaseTypeFK = '".$CaseTypeID."' WHERE PRODUCT.ProductID = '".$this->ProductID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query fails
        if ($result === false)
        {
            return "Unable to update CaseType";
        }
        
        // update CaseType in memory
        $this->CaseType = $CaseType;
        
        // All OK return true
        return true;
    }
    
    public function setCondition($inputCondition)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $Condition = mysqli_real_escape_string($dataConnection, $inputCondition);
        
        // Query to check if Condition exists 
        $query = "SELECT AppearenceID FROM APPEARENCE WHERE Description = '".$Condition."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to check if Condition exists";
        }
        
        // Return error if no result returned
        if ($result->num_rows < 1)
        {
            return "Specified Condition does not exist";
        }
        
        // Get Condition id
        $row = $result->fetch_assoc();
        $ConditionID = $row['AppearenceID'];
        
        // Query to update Condition
        $query = "UPDATE PRODUCT JOIN APPEARENCE ON APPEARENCE.AppearenceID = PRODUCT.AppearenceFK SET PRODUCT.AppearenceFK = '".$ConditionID."' WHERE PRODUCT.ProductID = '".$this->ProductID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query fails
        if ($result === false)
        {
            return "Unable to update Condition";
        }
        
        // update Condition in memory
        $this->Condition = $Condition;
        
        // All OK return true
        return true;
    }
    
    public function setType($inputType)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $Type = mysqli_real_escape_string($dataConnection, $inputType);
        
        // Query to check if Type exists 
        $query = "SELECT ClassificationID FROM CLASSIFICATION WHERE Type = '".$Type."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to check if Type exists";
        }
        
        // Return error if no result returned
        if ($result->num_rows < 1)
        {
            return "Specified Type does not exist";
        }
        
        // Get Type id
        $row = $result->fetch_assoc();
        $TypeID = $row['ClassificationID'];
        
        // Query to update Type
        $query = "UPDATE PRODUCT JOIN CLASSIFICATION ON CLASSIFICATION.ClassificationID = PRODUCT.ClassificationFK SET PRODUCT.ClassificationFK = '".$TypeID."' WHERE PRODUCT.ProductID = '".$this->ProductID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query fails
        if ($result === false)
        {
            return "Unable to update Type";
        }
        
        // update Type in memory
        $this->Type = $Type;
        
        // All OK return true
        return true;
    }
    
    public function setBrand($inputBrand)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $Brand = mysqli_real_escape_string($dataConnection, $inputBrand);
        
        // Query to check if brand exists 
        $query = "SELECT BrandID FROM BRAND WHERE BrandName = '".$Brand."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to check if brand exists";
        }
        
        // Return error if no result returned
        if ($result->num_rows < 1)
        {
            return "Specified brand does not exist";
        }
        
        // Get brand id
        $row = $result->fetch_assoc();
        $BrandID = $row['BrandID'];
        
        // Query to update brand
        $query = "UPDATE PRODUCT JOIN BRAND ON BRAND.BrandID = PRODUCT.BrandFK SET PRODUCT.BrandFK = '".$BrandID."' WHERE PRODUCT.ProductID = '".$this->ProductID."';";
        
        // Execute query 
        $result = $dataConnection->query($query);
        
        // Return error if query fails
        if ($result === false)
        {
            return "Unable to update Brand";
        }
        
        // update brand in memory
        $this->Brand = $Brand;
        
        // All OK return true
        return true;
    }
    
    public function setModel($inputModel)
    {
        // Create data connection
        $database = new Database();
        $dataConnection = $database->getDataConnection();
        
        // sanitize input
        $Model = mysqli_real_escape_string($dataConnection, $inputModel);
        
        // Return error if input too long
        if (iconv_strlen($Model) > 100)
        {
            return "Model Too Long";
        }
        
        // Query to update model
        $query = "UPDATE MODEL JOIN PRODUCT ON MODEL.ModelID = PRODUCT.ModelFK SET MODEL.Description='".$Model."' WHERE PRODUCT.ProductID='".$this->ProductID."'";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        // Return error if query failed
        if ($result === false)
        {
            return "Unable to update Model";
        }
        
        // Update object in memory
        $this->Model = $Model;
        
        // All OK return true
        return true;
    }
    
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
        
        // Get the returned result 
        $row = $result->fetch_assoc();
        
        // Extract the values from the row and populate the data object
        $this->ProductID = $row['ProductID'];
        $this->PrimaryPicturePath = $row['PrimaryPicturePath'];
        $this->Brand = $row['Brand'];
        $this->Type = $row['Type'];
        $this->Quantity = $row['Quantity'];
        $this->Status = $row['Status'];
        $this->Description = $row['Description'];
        $this->Condition = $row['Condition'];
        $this->Price = $row['Price'];
        $this->CaseType = $row['CaseType'];
        $this->Model = $row['Model'];
        $this->CreatedBy = $row['CreatedBy'];
        $this->ModifiedBy = $row['ModifiedBy'];
        $this->CreationDate = $row['CreationDate'];
        $this->ModifiedDate = $row['ModifiedDate'];
    }
    function getProductID() {
        return $this->ProductID;
    }

    function getPrimaryPicturePath() {
        return $this->PrimaryPicturePath;
    }

    function getBrand() {
        return $this->Brand;
    }

    function getType() {
        return $this->Type;
    }

    function getQuantity() {
        return $this->Quantity;
    }

    function getStatus() {
        return $this->Status;
    }

    function getDescription() {
        return $this->Description;
    }

    function getCondition() {
        return $this->Condition;
    }

    function getPrice() {
        return $this->Price;
    }

    function getCaseType() {
        return $this->CaseType;
    }

    function getModel() {
        return $this->Model;
    }

    function getCreatedBy() {
        return $this->CreatedBy;
    }

    function getModifiedBy() {
        return $this->ModifiedBy;
    }

    function getCreationDate() {
        return $this->CreationDate;
    }

    function getModifiedDate() {
        return $this->ModifiedDate;
    }
}