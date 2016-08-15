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
    public function testValidateCustomer($username, $password, $expected)
    {
        // Test logins
        $this->assertEquals($expected, Customer::validateCustomer($username, $password));
    }
    
    public function doesExistDataProvider()
    {
        return array(
            array("dominic@mail.com", true),        // Exists in database
            array("ben@mail.com", true),            // Exists in database
            array("dale@mail.com", true),           // Exists in database
            array("warren@mail.com", true),         // Exists in database
            array("do2minic@mai2l.com", false),     // Does not exist in database
            array("", false),                       // blank string
            array(88, false),                       // Integer
            array("dsadfsdfdsf", false),            // random junk
            array("' DROP TABLE customer", false),  // Database breaking stuff
            array("\'dsfsdf'dfsdf  'd  dfsdf '\dsf sd\\", false)
        );
    }
    
    /**
     * @dataProvider doesExistDataProvider
     */
    public function testDoesCustomerExist($email, $expected)
    {
        $this->assertEquals($expected, Customer::doesCustomerExist($email));
    }
    
    public function newCustomerDataProvider()
    {
        return array(
            array("dominic@mail.com", "password1", false),
            array("dominic@mail.com", "password2", false),
            array("ben@mail.com", "passwo434rd2", false),
            array("dale@mail.com", "pa324234ord2", false),
            array("warren@mail.com", "passwo234324rd2", false),
            array("warren@mail.com", "pas'; swo234324rd2", false),
            array("flipper", "I'm swole", "invalid email"),
            array("flipper@shingoxc", "I'm note swole!!", "invalid email"),
            array("newguy@mail.com", "Passiwassi11", true),
            array("newguy2@mail.org", "Passiwassi11", true),
            array("newguy3@mail.net", "Passiwassi11", true),
            array("newguy4@mail.com.au", "Passiwassi11", true)  
        );
    }
    
    /**
     * @dataProvider newCustomerDataProvider
     */
    public function testNewCustomer($email, $password, $expected)
    {
        $this->assertEquals($expected, Customer::newCustomer($email, $password));
    }
}