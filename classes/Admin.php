<?php

class Admin 
{
    private $email;
    private $password;
    private $isAuthenticated;
    
    // Construct
    function __construct($email, $password)
    {
        return authenticate($email, $password);
    }
    
    // Function to authenticate admin
    public function authenticate($email, $password)
    {
        $this->email = $email;
        $this->password-> $password;
        // TODO 
        // Check email and password against database
        // If email and password match database set authenticated to true
    }
    
    // Function to get authenticated status
    public function getAuthenticated()
    {
        return $isAuthenticated;
    }
}