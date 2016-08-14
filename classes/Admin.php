<?php

class Admin 
{
    private $username;
    private $password;
    private $isAuthenticated;
    
    // Construct
    function __construct($username, $password)
    {
        return $this->authenticate($username, $password);
    }
    
    // Function to authenticate admin
    public function authenticate($username, $password)
    {
        $this->email = $username;
        $this->password-> $password;
        // TODO 
        // Check username and password against database
        // If username and password match database set authenticated to true
    }
    
    // Function to get authenticated status
    public function getAuthenticated()
    {
        return $isAuthenticated;
    }
}