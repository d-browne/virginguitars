<?php

use PHPUnit\Framework\TestCase;

require 'classes/Customer.php';

class CustomerTest extends TestCase
{
    // Test data for login/varify password test
    // Warning!!!: these tests are designed to pass with testing database
    // May not pass after database alterations
    public function customerLoginDataProvider()
    {
        return array(
          array("ben@mail.com", "password1", TRUE),                         // Valid login
          array("dale@mail.com", "password2", TRUE),                        // Valid login
          array("warren@mail.com", "password3", TRUE),                      // Valid login
          array("dominic@mail.com", "password4", TRUE),                     // Valid login
          array("davidmullburry@fitzroy.org", "delicious", FALSE),          // Invalid login, customer doesn't exist
          array("checkzFuzzlewuz@bundurry.org.au", "CranyVuzxcf", FALSE),   // Invalid login, cusomter doesn't exist
          array("", "", FALSE),                                             // Invalid login, empty strings
          array(1, 2, FALSE),                                               // Invalid login, integers
          array(NULL, NULL, FALSE),                                         // Invalid login, null values
          array("'DROP TABLE customers", NULL, FALSE)                       // Invalid login, null value and simulated attack string
        );
    }
    
    /**
     * 
     * @dataProvider customerLoginDataProvider
     */
    public function testCheckDatabaseForUser($username, $password, $expected)
    {
        // Customer object to test logins
        $customer = new Customer();
        
        // Test logins
        $this->assertEquals($expected, $customer->checkDatabaseForUser($username, $password));
    }
}