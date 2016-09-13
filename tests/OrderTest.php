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
    
    public function setShippedDateDataProvider()
    {
        return array(
            array(1, '1984-11-13', true),
            array(1, '', true),
            array(1, NULL, true),
            array(1, "NULL", "ShippedDate incorrect date format"),
            array(1, -1, "ShippedDate incorrect date format"),
            array(1, 10000, "ShippedDate incorrect date format"),
            array(1, "2016-34-12", "ShippedDate incorrect date format"),
            array(1, "2016-09-14", true)
        );
    }
    
    /**
     * 
     * @dataProvider setShippedDateDataProvider
     */
    public function testSetShippedDate($SalesOrderID, $newShippedDate, $expectedCallback)
    {
        // Instantiate object
        $order = new Order($SalesOrderID);
        
        // Backup street address
        $ShippedDateBackup = $order->getShippedDate();
        
        // Test
        $this->assertEquals($expectedCallback, $order->setShippedDate($newShippedDate));
        
        // If true check in memory and in database
        if ($expectedCallback === true)
        {
            // Check in memory
            $this->assertEquals($newShippedDate, $order->getShippedDate());
            
            // Check in database (using new object)
            $order2 = new Order($SalesOrderID);
            $this->assertEquals($newShippedDate, $order2->getShippedDate());
        }
        
        // Restore backup
        $order->setShippedDate($ShippedDateBackup);
    }
    
    public function setCountryDataProvider()
    {
        return array(
            array(1, 'ga ga go', true),
            array(2, 'ba ba bo', true),
            array(3, 'da aa ao', true),
            array(3, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', "Country too long"),
            array(4, 'ga ga go', true),
            array(5, 'ga ga go', true)
        );
    }
    
    /**
     * 
     * @dataProvider setCountryDataProvider
     */
    public function testSetCountry($SalesOrderID, $newCountry, $expectedCallback)
    {
        // Instantiate object
        $order = new Order($SalesOrderID);
        
        // Backup street address
        $CountryBackup = $order->getCountry();
        
        // Test
        $this->assertEquals($expectedCallback, $order->setCountry($newCountry));
        
        // If true check in memory and in database
        if ($expectedCallback === true)
        {
            // Check in memory
            $this->assertEquals($newCountry, $order->getCountry());
            
            // Check in database (using new object)
            $order2 = new Order($SalesOrderID);
            $this->assertEquals($newCountry, $order2->getCountry());
        }
        
        // Restore backup
        $order->setCountry($CountryBackup);
    }
    
    public function setPostCodeDataProvider()
    {
        return array(
            array(1, 'gaga', true),
            array(2, '1234', true),
            array(3, '6754', true),
            array(3, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', "PostCode too long"),
            array(4, 'aa', true),
            array(5, 'ga b', true)
        );
    }
    
    /**
     * 
     * @dataProvider setPostCodeDataProvider
     */
    public function testSetPostCode($SalesOrderID, $newPostCode, $expectedCallback)
    {
        // Instantiate object
        $order = new Order($SalesOrderID);
        
        // Backup street address
        $PostCodeBackup = $order->getPostCode();
        
        // Test
        $this->assertEquals($expectedCallback, $order->setPostCode($newPostCode));
        
        // If true check in memory and in database
        if ($expectedCallback === true)
        {
            // Check in memory
            $this->assertEquals($newPostCode, $order->getPostCode());
            
            // Check in database (using new object)
            $order2 = new Order($SalesOrderID);
            $this->assertEquals($newPostCode, $order2->getPostCode());
        }
        
        // Restore backup
        $order->setPostCode($PostCodeBackup);
    }
    
    public function setStateDataProvider()
    {
        return array(
            array(1, 'ga ga go', true),
            array(2, 'ba ba bo', true),
            array(3, 'da aa ao', true),
            array(3, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', "State too long"),
            array(4, 'ga ga go', true),
            array(5, 'ga ga go', true)
        );
    }
    
    /**
     * 
     * @dataProvider setStateDataProvider
     */
    public function testSetState($SalesOrderID, $newState, $expectedCallback)
    {
        // Instantiate object
        $order = new Order($SalesOrderID);
        
        // Backup street address
        $StateBackup = $order->getState();
        
        // Test
        $this->assertEquals($expectedCallback, $order->setState($newState));
        
        // If true check in memory and in database
        if ($expectedCallback === true)
        {
            // Check in memory
            $this->assertEquals($newState, $order->getState());
            
            // Check in database (using new object)
            $order2 = new Order($SalesOrderID);
            $this->assertEquals($newState, $order2->getState());
        }
        
        // Restore backup
        $order->setState($StateBackup);
    }
    
    public function setCityDataProvider()
    {
        return array(
            array(1, 'ga ga go', true),
            array(2, 'ba ba bo', true),
            array(3, 'da aa ao', true),
            array(3, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', "City too long"),
            array(4, 'ga ga go', true),
            array(5, 'ga ga go', true)
        );
    }
    
    /**
     * 
     * @dataProvider setCityDataProvider
     */
    public function testSetCity($SalesOrderID, $newCity, $expectedCallback)
    {
        // Instantiate object
        $order = new Order($SalesOrderID);
        
        // Backup street address
        $CityBackup = $order->getCity();
        
        // Test
        $this->assertEquals($expectedCallback, $order->setCity($newCity));
        
        // If true check in memory and in database
        if ($expectedCallback === true)
        {
            // Check in memory
            $this->assertEquals($newCity, $order->getCity());
            
            // Check in database (using new object)
            $order2 = new Order($SalesOrderID);
            $this->assertEquals($newCity, $order2->getCity());
        }
        
        // Restore backup
        $order->setCity($CityBackup);
    }
    
    public function setStreetAddressDataProvider()
    {
        return array(
            array(1, 'ga ga go', true),
            array(2, 'ba ba bo', true),
            array(3, 'da aa ao', true),
            array(3, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', "StreetAddress too long"),
            array(4, 'ga ga go', true),
            array(5, 'ga ga go', true)
        );
    }
    
    /**
     * 
     * @dataProvider setStreetAddressDataProvider
     */
    public function testSetStreetAddress($SalesOrderID, $newStreetAddress, $expectedCallback)
    {
        // Instantiate object
        $order = new Order($SalesOrderID);
        
        // Backup street address
        $streetAddressBackup = $order->getStreetAddress();
        
        // Test
        $this->assertEquals($expectedCallback, $order->setStreetAddress($newStreetAddress));
        
        // If true check in memory and in database
        if ($expectedCallback === true)
        {
            // Check in memory
            $this->assertEquals($newStreetAddress, $order->getStreetAddress());
            
            // Check in database (using new object)
            $order2 = new Order($SalesOrderID);
            $this->assertEquals($newStreetAddress, $order2->getStreetAddress());
        }
        
        // Restore backup
        $order->setStreetAddress($streetAddressBackup);
    }
    
    // Test data for delivery address test
    public function deliveryAddressDataProvider()
    {
        return array(
            array(1, '123 Fake Street', 'Sydney', 'NSW', '0', 'Australia'),
            array(5, '334 Big Creek Rd', 'Gold Coast', 'QLD', '4142', 'Australia'),
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