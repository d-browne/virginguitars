<?php

/* 
 * Unit test for Product class
 */

use PHPUnit\Framework\TestCase;

require_once 'classes/Product.php';

class ProductTest extends TestCase 
{
    
    public function getterDataProvider()
    {
        return array(
            array(1, 1, "images/guitars/fenderAmericanStandardStratocaster/1.jpg", "Fender", "Electric Guitar", 4, "status1", "Specifications", "Brand New", 802.27, "Hard case",
                "American Standard Stratocaster", "admin", "admin", "2016-09-14", "2016-09-14")
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