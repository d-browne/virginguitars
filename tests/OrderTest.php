<?php

/* 
 * Virgin Guitars E-Commerce Website 2016 - HomeAddressTest.php
 * VGECW TEAM: Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * This file contains the unit tests to check the Order class
 * To run these units tests type phpunit tests/Order.php from the website root
 * For more details on running phpunit tests see the virgin guitars test plan
 */

use PHPUnit\Framework\TestCase;

require_once 'classes/Order.php';

class OrderTest extends TestCase 
{
    
    // Test data for delivery address test
    public function deliveryAddressDataProvider()
    {
        return array(
            array(1, '123 Fake Street', 'Sydney', 'NSW', '0', 'Australia'),
            array(5, '123 Fake Street', 'Sydney', 'NSW', '0', 'Australia'),
            array(2, '456 Fake Street', 'Gosford', 'NSW', '1111', 'Australia')
        );
    }
    
    /** 
     * 
     * @dataProvider deliveryAddressDataProvider
     */
    public function testDeliveryAddressConstrutor($SalesOrderID, $expectedStreetAddress,
            $expectedCity, $expectedState, $expectedPostCode, $expectedCountry)
    {
        // Instantiate the object
        $order = new Order($SalesOrderID);
        
        // Test
        $this->assertEquals($expectedStreetAddress, $order->getStreetAddress());
        $this->assertEquals($expectedCity, $order->getCity());
        $this->assertEquals($expectedState, $order->getState());
        $this->assertEquals($expectedPostCode, $order->getPostCode());
        $this->assertEquals($expectedCountry, $order->getCountry());
    }
            
    
    // Data for testing the constructor. Only need to test three. More can easily be added.
    public function testConstructorsDataProvidor()
    {
        return array(
            array(1, 1, 1, date('Y-m-d'), 1750, 20, 1770, NULL, NULL, 'Requested'),
            array(2, 2, 1, date('Y-m-d'), 1750, 20, 1770, NULL, NULL, 'Processing'),
            array(7, 7, 4, date('Y-m-d'), 1750, 20, 1770, NULL, NULL, 'Requested')
        );
    }
    
    /**
     * This unit test tests if the order values are as expected
     * 
     * @dataProvider testConstructorsDataProvidor
     */
    public function testConstructors($SalesOrderID, $expectedSalesOrderID,
            $expectedCustomerID, $expectedInvoiceDate, $expectedSubtotal,
            $expectedShipping, $expectedTotal, $expectedShippedDate,
            $expectedShippingRecord, $expectedOrderStatus)
    {
        $order = new Order($SalesOrderID);
        $this->assertEquals($expectedSalesOrderID, $order->getSalesOrderID());
        $this->assertEquals($expectedCustomerID, $order->getCustomerID());
        $this->assertEquals($expectedInvoiceDate, $order->getInvoiceDate());
        $this->assertEquals($expectedSubtotal, $order->getSubTotal());
        $this->assertEquals($expectedShipping, $order->getShipping());
        $this->assertEquals($expectedTotal, $order->getTotal());
        $this->assertEquals($expectedShippedDate, $order->getShippedDate());
        $this->assertEquals($expectedShippingRecord, $order->getShippingRecord());
        $this->assertEquals($expectedOrderStatus, $order->getOrderStatus());
    }
    
    public function checkIfExistsDataProvider()
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
            array(9, false),
            array(-1, false),
            array(NULL, false),
            array("'dsfa''sdf", false)
        );
    }
    
    /**
     * 
     * @dataProvider checkIfExistsDataProvider
     */
    public function testCheckIfExists($SalesOrderID, $expected)
    {
        $this->assertEquals($expected, Order::CheckIfExists($SalesOrderID));
    }
}