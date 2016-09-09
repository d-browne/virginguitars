<?php

/*
 * Virgin Guitars E-Commerce Website 2016 - HomeAddressTest.php
 * VGECW TEAM: Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * 
 * 
 * This file contains the unit tests to check the HomeAddress class
 * To run these units tests type phpunit tests/HomeAddressTest.php from the website root
 * For more details on running phpunit tests see the virgin guitars test plan
 */

use PHPUnit\Framework\TestCase;

require_once 'classes/HomeAddress.php';
require_once 'classes/Customer.php';

class HomeAddressTest extends TestCase
{
    
    public function setCountryDataProvider()
    {
        return array(
            array(1, "Australia", true),
            array(1, "Turkey", true),
            array(1, "Finland", true),
            array(1, NULL, true),
            array(1, -1, true),
            array(1, -167, true),
            array(1, "Albanianianainaianianaiania", "Country too long")
        );
    }
    
    /**
     * 
     * @dataProvider setCountryDataProvider
     */
    public function testSetCountry($CustomerID, $newCountry, $expected)
    {
        $homeAddress = new HomeAddress($CustomerID);
        // Backup old Country to be restored after test
        $oldCountry = $homeAddress->getCountry();
        
        $this->assertEquals($expected, $homeAddress->setCountry($newCountry));
        
        // If true (all ok) check that Country was updated in both memory and database
        if ($expected === true)
        {
            $this->assertEquals($newCountry, $homeAddress->getCountry()); // Check memory
            $homeAddress2 = new HomeAddress($CustomerID);
            $this->assertEquals($newCountry, $homeAddress2->getCountry()); // Get database persistence
        }
        
        // Restore old Country
        $homeAddress->setCountry($oldCountry);
    }
    
    public function setPostCodeDataProvider()
    {
        return array(
            array(1, 2480, true),
            array(1, 2000, true),
            array(1, 9989, true),
            array(1, "9989", true),
            array(1, -1, true),
            array(1, -167, true),
            array(1, "24812", "PostCode too long")
        );
    }
    
    /** 
     * 
     * @dataProvider setPostCodeDataProvider
     */
    public function testSetPostCode($CustomerID, $newPostCode, $expected)
    {
        $homeAddress = new HomeAddress($CustomerID);
        // Backup old PostCode to be restored after test
        $oldPostCode = $homeAddress->getPostCode();
        
        $this->assertEquals($expected, $homeAddress->setPostCode($newPostCode));
        
        // If true (all ok) check that PostCode was updated in both memory and database
        if ($expected === true)
        {
            $this->assertEquals($newPostCode, $homeAddress->getPostCode()); // Check memory
            $homeAddress2 = new HomeAddress($CustomerID);
            $this->assertEquals($newPostCode, $homeAddress2->getPostCode()); // Get database persistence
        }
        
        // Restore old PostCode
        $homeAddress->setPostCode($oldPostCode);
    }
    
    public function setStateDataProvider()
    {
        return array(
            array(1, "QLD", true),
            array(1, "VIC", true),
            array(1, -1, true),
            array(1, -1000000000, true),
            array(1, "Looooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooong Island", "State too long")
        );
    }
    
    /**
     * 
     * @dataProvider setStateDataProvider
     */
    public function testSetState($CustomerID, $newState, $expected)
    {
        $homeAddress = new HomeAddress($CustomerID);
        // Backup old State to be restored after test
        $oldState = $homeAddress->getState();
        
        $this->assertEquals($expected, $homeAddress->setState($newState));
        
        // If true (all ok) check that State was updated in both memory and database
        if ($expected === true)
        {
            $this->assertEquals($newState, $homeAddress->getState()); // Check memory
            $homeAddress2 = new HomeAddress($CustomerID);
            $this->assertEquals($newState, $homeAddress2->getState()); // Get database persistence
        }
        
        // Restore old State
        $homeAddress->setState($oldState);
    }
    
    public function setCityDataProvider()
    {
        return array(
            array(1, "Big City", true),
            array(1, "Fun Town", true),
            array(1, -1, true),
            array(1, -1000000000, true),
            array(1, "Fake Ciiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiity", "city too long")
        );
    }
    
    /**
     * 
     * @dataProvider setCityDataProvider
     */
    public function testSetCity($CustomerID, $newCity, $expected)
    {
        $homeAddress = new HomeAddress($CustomerID);
        // Backup old City to be restored after test
        $oldCity = $homeAddress->getCity();
        
        $this->assertEquals($expected, $homeAddress->setCity($newCity));
        
        // If true (all ok) check that city was updated in both memory and database
        if ($expected === true)
        {
            $this->assertEquals($newCity, $homeAddress->getCity()); // Check memory
            $homeAddress2 = new HomeAddress($CustomerID);
            $this->assertEquals($newCity, $homeAddress2->getCity()); // Get database persistence
        }
        
        // Restore old city
        $homeAddress->setCity($oldCity);
    }
    
    public function setStreetAddressDataProvider()
    {
        return array(
            array(1, "10/22 Long Street!", true),
            array(1, "645 Plain St.", true),
            array(1, -1, true),
            array(1, -1000000000, true),
            array(1, "123 fake streeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeet", "street address too long")
        );
    }
    
    /**
     * 
     * @dataProvider setStreetAddressDataProvider
     */
    public function testSetStreetAddress($CustomerID, $newStreetAddress, $expected)
    {
        $homeAddress = new HomeAddress($CustomerID);
        // Backup old street address to be restored after test
        $oldStreetAddress = $homeAddress->getStreetAddress();
        
        $this->assertEquals($expected, $homeAddress->setStreetAddress($newStreetAddress));
        
        // If true (all ok) check that street address was updated in both memory and database
        if ($expected === true)
        {
            $this->assertEquals($newStreetAddress, $homeAddress->getStreetAddress()); // Check memory
            $homeAddress2 = new HomeAddress($CustomerID);
            $this->assertEquals($newStreetAddress, $homeAddress2->getStreetAddress()); // Get database persistence
        }
        
        // Restore old street address
        $homeAddress->setStreetAddress($oldStreetAddress);
    }
    
    // This function tests creating a new member giving him a home address record
    public function testNewMemberHomeAddress()
    {
        Customer::newCustomer("homeaddresstestcustomer@mail.com", "1234");
        
        $customer = new Customer();
        $customer->initialize("homeaddresstestcustomer@mail.com");
        
        $CustomerId = $customer->getCustomerID();
        
        $homeAddress = new HomeAddress($CustomerId);
        
        $this->assertEquals($CustomerId, $homeAddress->getCustomerID());
        
        // Delete the newly created customer
        Customer::deleteCusomter("homeaddresstestcustomer@mail.com");
    }
    
    public function constructDataProvider()
    {
        return array(
            array(1, "123 Fake Street", "Sydney", "NSW", "0", "Australia"),
            array(2, "456 Fake Street", "Gosford", "NSW", "1111", "Australia"),
            array(3, "789 Fake Street", "Newcastle", "NSW", "2222", "Australia"),
            array(4, "789 Fake Street", "Sydney", "NSW", "3333", "Australia")
        );
    }
    
    /** 
     * 
     * @dataProvider constructDataProvider
     */
    public function testConstruct($customerID, $expectedStreet, $expectedCity, $expectedState, $expectedPostCode, $expectedCountry)
    {
        $homeAddress = new HomeAddress($customerID);
        
        $this->assertEquals($expectedStreet, $homeAddress->getStreetAddress());
        $this->assertEquals($expectedCity, $homeAddress->getCity());
        $this->assertEquals($expectedState, $homeAddress->getState());
        $this->assertEquals($expectedPostCode, $homeAddress->getPostCode());
        $this->assertEquals($expectedCountry, $homeAddress->getCountry());
    }
    
    /*
    * Exception codes:
    * 0 - CustomerID not a number
    * 1- CustomerID does not match an existing customer
    */
    public function constructExceptionDataProvider()
    {
        return array(
            array(NULL, 0),
            array("one", 0),
            array("random gibberish", 0),
            array("'; DROP TALBE HOMEADDRESS", 0),
            array(5, 1),
            array(7, 1),
            array(8, 1),
            array(-8, 1)
        );
    }
    
    /**
     * 
     * @dataProvider constructExceptionDataProvider
     */
    public function testConstructExceptions($CustomerID, $expectedException)
    {
        try
        {
            $homeAddress = new HomeAddress($CustomerID);
        } catch (Exception $ex) {
            $this->assertEquals($expectedException, $ex->getCode());
        }
    }
}