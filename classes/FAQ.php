<?php

require_once 'classes/GlobalSettings.php';

class FAQ
{
    // Class constructor
    function __construct()
    {
        // Check if FAQ data file exists (specified in Global Settings)
        if (file_exists(GlobalSettings::PATH_TO_FAQ))
        {
            // Do nothing. 
        }
        else
        {
            // Create page
            try 
            {
                $faqDataFile = fopen(GlobalSettings::PATH_TO_FAQ, "w");
                // if not initialize with blank data "<b>faq goes here</b>"
                fwrite($faqDataFile, "<b>faq goes here</b>");
                fclose($faqDataFile);
                return true; // Everything OK
                
            } catch (Exception $ex) {
                return $ex;
            }         
        }
    }
    
    // function to get faq file data
    public function getData()
    {
        try {
            $faqDataFile = fopen(GlobalSettings::PATH_TO_FAQ, "r");
            return fread($faqDataFile, filesize(GlobalSettings::PATH_TO_FAQ));
        } catch (Exception $ex) {
            return $ex;
        }
        // Return file contents
    }
    
    // Function to set faq file data
    function setData($data)
    {
        // Update page
        try {
            $faqDataFile = fopen(GlobalSettings::PATH_TO_FAQ, "w");
            return fwrite($faqDataFile, $data);
        } catch (Exception $ex) {
            return $ex;
        }
    }
    
    // Function to delete faq file from disk
    function deleteFile()
    {
        try
        {
            return unlink(GlobalSettings::PATH_TO_FAQ);
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
