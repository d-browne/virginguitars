<?php

use PHPUnit\Framework\TestCase;

require 'classes/Admin.php';

class AdminTest extends TestCase
{
    
    public function authenticateDataProvider()
    {
        return array(
          array("zerox", "ZugZug22", TRUE), // Valid Login
          array("admin", "password", TRUE), // Valid Login
          array("evil", "baddeeddoer", FALSE) // invalid login
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
