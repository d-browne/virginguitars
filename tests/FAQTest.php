<?php

use PHPUnit\Framework\TestCase;

require_once 'classes/FAQ.php';

class FAQTest extends TestCase
{
    public function testCreateFaqObject()
    {
        $backupData = ''; // Holds the file data for deltion test
        // Check if file exists
        if (file_exists(GlobalSettings::PATH_TO_FAQ))
        {
            // Delete the file
            $faq = new FAQ();
            $backupData = $faq->getData();
            $faq->deleteFile();
            // Create a new file
            $faq = new FAQ();
            $this->assertEquals("<b>faq goes here</b>", $faq->getData());
            // Restore original data
            $faq->setData($backupData);
        }
        else // No faq data file exists
        {
            $faq = new FAQ();
            $this->assertEquals("<b>faq goes here</b>", $faq->getData());
            // Delete the FAQ file
            $faq->deleteFile();
        }
    }
}