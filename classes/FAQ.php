<?php

require_once 'classes/GlobalSettings.php';

class FAQ
{
    private $faqData; // Holds faq page data
    
    // Class constructor
    function __construct()
    {
        // Check if FAQ data file exists (specified in Global Settings)
        // if not initialize with blank data "<b>faq goes here</b>"
        
        // get datafile data to $faqData
    }
    
    // function to get faq file data
    public function getData()
    {
        return $faqData;
    }
    
    // Function to set faq file data
    function setData($data)
    {
        // Update page
        // if successful update object variable
    }
}
