<?php

use PHPUnit\Framework\TestCase;

require 'classes/Admin.php';

class AdminTest extends TestCase
{
    
    public function authenticateDataProvider()
    {
        return array(
          array("zerox", "ZugZug22", TRUE),                 // Valid Login
          array("admin", "password", TRUE),                 // Valid Login
          array("evil", "baddeeddoer", FALSE),              // invalid login with random junk
          array("", "", FALSE),                             // Invalid login with empty strings
          array(1, 2, FALSE),                               // Invalid login with integers
          array(NULL, NULL, FALSE),                         // Invalid Login with null values
          array("'DROP TABLE administrators", NULL, FALSE)  // Simulated SQLI attacko. 
        );
    }
    
    /**
     * 
     * @dataProvider authenticateDataProvider
     */
    public function testAuthenticate($username, $password, $expected)
    {
        $admin = new Admin($username, $password);
        
        // Check if authenticated
        $this->assertEquals($expected, $admin->getAuthenticated());
    }
}
