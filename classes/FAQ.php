<?php

require_once 'classes/GlobalSettings.php';

class FAQ
{
    // Class constructor
    function __construct()
    {
        // Check if FAQ data file exists (specified in Global Settings)
        if (file_exists(PATH_TO_FAQ))
        {
            // Do nothing. 
        }
        else
        {
            // Create page
            // if not initialize with blank data "<b>faq goes here</b>"
            $this->setData("<b>faq goes here</b>");
        }
    }
    
    // function to get faq file data
    public function getData()
    {
        // Return the file contents
    }
    
    // Function to set faq file data
    function setData($data)
    {
        // Update page
    }
}
