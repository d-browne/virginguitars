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