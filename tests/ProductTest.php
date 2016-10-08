<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PHPUnit\Framework\TestCase;

require_once 'classes/Product.php';

class ProductTest extends TestCase 
{
    
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