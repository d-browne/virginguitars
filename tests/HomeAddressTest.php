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

class HomeAddressTest extends TestCase
{
    
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