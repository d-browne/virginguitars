<?php

require 'classes/GlobalSettings.php';

class Database
{
    // Return handle to data connection
    public function getDataConnection()
    {
        // Create connection
        $conn = new mysqli(GlobalSettings::$dbservername, GlobalSettings::$dbuser, GlobalSettings::$dbpassword, GlobalSettings::$dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        return $conn;
    }
}