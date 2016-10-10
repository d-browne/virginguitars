<?php

/* 
 * Unit test for Product class
 */

use PHPUnit\Framework\TestCase;

require_once 'classes/Product.php';

class ProductTest extends TestCase 
{
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