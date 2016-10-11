<?php

/* 
 * Unit test for Product class
 */

use PHPUnit\Framework\TestCase;

require_once 'classes/Product.php';

class ProductTest extends TestCase 
{
    
    public function setPriceDataProvider()
    {
        return array(
            array(1, 121, true),
            array(1, "123", true),
            array(1, "44434.344", "Unable to update Price"),
            array(1, "blah blah", "Price Not Numeric"),
            array(1, -100, "Price cannot be less than $0")
        );
    }
    
    /**
     * 
     * @dataProvider setPriceDataProvider
     */
    public function testSetPrice($ProductID, $Price, $expected)
    {
        // Create product object
        $product = new Product($ProductID);
        
        // backup current Price
        $PriceBackup = $product->getPrice();
        
        // Update Price
        $this->assertEquals($expected, $product->setPrice($Price));
        
        // If true check in memory and in database
        if ($expected === true)
        {
            // Check in memory
            $this->assertEquals($Price, $product->getPrice());
            
            // Check in database (using new object)
            $product2 = new Product($ProductID);
            $this->assertEquals($Price, $product2->getPrice());
        }
        
        // Restore backup
        $product->setPrice($PriceBackup);
    }
    
    public function setStatusDataProvider()
    {
        return array(
            array(1, "In Stock", true),
            array(1, "Out Of Stock", true),
            array(1, "Backorder", true),
            array(1, "blah blah", "Specified Status does not exist")
        );
    }
    
    /**
     * 
     * @dataProvider setStatusDataProvider
     */
    public function testSetStatus($ProductID, $Status, $expected)
    {
        // Create product object
        $product = new Product($ProductID);
        
        // backup current Status
        $StatusBackup = $product->getStatus();
        
        // Update Status
        $this->assertEquals($expected, $product->setStatus($Status));
        
        // If true check in memory and in database
        if ($expected === true)
        {
            // Check in memory
            $this->assertEquals($Status, $product->getStatus());
            
            // Check in database (using new object)
            $product2 = new Product($ProductID);
            $this->assertEquals($Status, $product2->getStatus());
        }
        
        // Restore backup
        $product->setStatus($StatusBackup);
    }
    
    public function setCaseTypeDataProvider()
    {
        return array(
            array(1, "Hard case", true),
            array(1, "Soft case", true),
            array(1, "blah blah", "Specified CaseType does not exist")
        );
    }
    
    /**
     * 
     * @dataProvider setCaseTypeDataProvider
     */
    public function testSetCaseType($ProductID, $CaseType, $expected)
    {
        // Create product object
        $product = new Product($ProductID);
        
        // backup current CaseType
        $CaseTypeBackup = $product->getCaseType();
        
        // Update CaseType
        $this->assertEquals($expected, $product->setCaseType($CaseType));
        
        // If true check in memory and in database
        if ($expected === true)
        {
            // Check in memory
            $this->assertEquals($CaseType, $product->getCaseType());
            
            // Check in database (using new object)
            $product2 = new Product($ProductID);
            $this->assertEquals($CaseType, $product2->getCaseType());
        }
        
        // Restore backup
        $product->setCaseType($CaseTypeBackup);
    }
    
    public function setConditionDataProvider()
    {
        return array(
            array(1, "Brand New", true),
            array(1, "New: Never Used", true),
            array(1, "Refurbished", true),
            array(1, "Used", true),
            array(1, "blah blah", "Specified Condition does not exist")
        );
    }
    
    /**
     * 
     * @dataProvider setConditionDataProvider
     */
    public function testSetCondition($ProductID, $Condition, $expected)
    {
        // Create product object
        $product = new Product($ProductID);
        
        // backup current Condition
        $ConditionBackup = $product->getCondition();
        
        // Update Condition
        $this->assertEquals($expected, $product->setCondition($Condition));
        
        // If true check in memory and in database
        if ($expected === true)
        {
            // Check in memory
            $this->assertEquals($Condition, $product->getCondition());
            
            // Check in database (using new object)
            $product2 = new Product($ProductID);
            $this->assertEquals($Condition, $product2->getCondition());
        }
        
        // Restore backup
        $product->setCondition($ConditionBackup);
    }
    
    public function setTypeDataProvider()
    {
        return array(
            array(1, "Acoustic Guitar", true),
            array(1, "Electric Guitar", true),
            array(1, "blah blah", "Specified Type does not exist")
        );
    }
    
    /**
     * 
     * @dataProvider setTypeDataProvider
     */
    public function testSetType($ProductID, $Type, $expected)
    {
        // Create product object
        $product = new Product($ProductID);
        
        // backup current Type
        $TypeBackup = $product->getType();
        
        // Update Type
        $this->assertEquals($expected, $product->setType($Type));
        
        // If true check in memory and in database
        if ($expected === true)
        {
            // Check in memory
            $this->assertEquals($Type, $product->getType());
            
            // Check in database (using new object)
            $product2 = new Product($ProductID);
            $this->assertEquals($Type, $product2->getType());
        }
        
        // Restore backup
        $product->setType($TypeBackup);
    }
    
    public function setBrandDataProvider()
    {
        return array(
            array(1, "Fender", true),
            array(1, "Gibson", true),
            array(1, "blah blah", "Specified brand does not exist")
        );
    }
    
    /**
     * 
     * @dataProvider setBrandDataProvider
     */
    public function testSetBrand($ProductID, $Brand, $expected)
    {
        // Create product object
        $product = new Product($ProductID);
        
        // backup current brand
        $brandBackup = $product->getBrand();
        
        // Update brand
        $this->assertEquals($expected, $product->setBrand($Brand));
        
        // If true check in memory and in database
        if ($expected === true)
        {
            // Check in memory
            $this->assertEquals($Brand, $product->getBrand());
            
            // Check in database (using new object)
            $product2 = new Product($ProductID);
            $this->assertEquals($Brand, $product2->getBrand());
        }
        
        // Restore backup
        $product->setBrand($brandBackup);
    }
    
    public function updateModelDataProvider()
    {
        return array(
            array(1, "test", true),
            array(1, "testttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt", "Model Too Long")
        );
    }
    
    /**
     * 
     * @dataProvider updateModelDataProvider
     */
    public function testUpdateModel($ProductID, $Model, $expected)
    {
        // Create product object
        $product = new Product($ProductID);
        
        // backup current model
        $modelBackup = $product->getModel();
        
        // Update model
        $this->assertEquals($expected, $product->setModel($Model));
        
        // If true check in memory and in database
        if ($expected === true)
        {
            // Check in memory
            $this->assertEquals($Model, $product->getModel());
            
            // Check in database (using new object)
            $product2 = new Product($ProductID);
            $this->assertEquals($Model, $product2->getModel());
        }
        
        // Restore backup
        $product->setModel($modelBackup);
    }
    
    public function getterDataProvider()
    {
        return array(
            array(1, 1, "images/guitars/fenderAmericanStandardStratocaster/1.jpg", "Fender", "Electric Guitar", 4, "In Stock", "Gorgeous sounding 2006 American Standard Stratocaster. It has a very comfortable feel and the pickups sound stellar. This guitar features a few upgraded parts including a Callaham bridge and Sperzel tuners; both of which help with intonation and overall sustain. On top of all of that, the guitar is in great overall shape!",
                "Brand New", 802.27, "Hard case",
                "American Standard Stratocaster", "admin", "admin", "2016-10-10", "2016-10-10")
        );
    }
    
    /**
     * Function to test gettgers
     * @dataProvider getterDataProvider
     */
    public function testGetters($ProductID, $expectedProductID, 
            $expectedPrimaryPicturePath, $expectedBrand, $expectedType, 
            $expectedQuantity, $expectedStatus, $expectedDescription, 
            $expectedCondition, $expectedPrice, $expectedCaseType, 
            $expectedModel, $expectedCreatedBy, $expectedModifiedBy, $expectedCreationDate, $expectedModifiedDate)
    {
        // Instantiate object
        $product = new Product($ProductID);
        
        // Test values
        $this->assertEquals($expectedProductID, $product->getProductID());
        $this->assertEquals($expectedPrimaryPicturePath, $product->getPrimaryPicturePath());
        $this->assertEquals($expectedBrand, $product->getBrand());
        $this->assertEquals($expectedType, $product->getType());
        $this->assertEquals($expectedQuantity, $product->getQuantity());
        $this->assertEquals($expectedStatus, $product->getStatus());
        $this->assertEquals($expectedDescription, $product->getDescription());
        $this->assertEquals($expectedCondition, $product->getCondition());
        $this->assertEquals($expectedPrice, $product->getPrice());
        $this->assertEquals($expectedCaseType, $product->getCaseType());
        $this->assertEquals($expectedModel, $product->getModel());
        $this->assertEquals($expectedCreatedBy, $product->getCreatedBy());
        $this->assertEquals($expectedModifiedBy, $product->getModifiedBy());
        $this->assertEquals($expectedCreationDate, $product->getCreationDate());
        $this->assertEquals($expectedModifiedDate, $product->getModifiedDate());
    }
    
    public function constructorDataProvider()
    {
        return array(
            array(1, true),
            array(2, true),
            array(3, true),
            array(4, true),
            array(5, true),
            array(6, true),
            array(7, true),
            array(8, true),
            array(9, true),
            array(-1, "ProductID not found"),
            array(10000000, "ProductID not found"),
            array("'; DROP TABLE PRODUCT", "ProductID not found")
        );
    }
    
    /**
     * 
     * @dataProvider constructorDataProvider
     */
    public function testCustructor($ProductID, $expected)
    {
        try 
        {
            $product = new Product($ProductID);
            $this->assertEquals($expected, true);
        } catch (Exception $ex) {
            $this->assertEquals($expected, $ex->getMessage());
        }
    }
}