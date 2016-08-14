<?php

require 'classes/GlobalSettings.php';

class Database extends GlobalSettings
{
    // Return handle to data connection
    public function getDataConnection()
    {
        // Create connection
        $conn = new mysqli($this->dbservername, $this->dbuser, $this->dbpassword, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        return $conn;
    }
}