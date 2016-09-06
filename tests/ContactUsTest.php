<?php

use PHPUnit\Framework\TestCase;

require 'classes/ContactUs.php';

// Unit test for ContactUs class
// ~Warning~ these tests will only pass with default ContactUs values
// Run test on default (testing database)

class ContactUsTest extends TestCase
{
    // Test to check default initialization
    // Also checks all the getters
    public function testInitialize()
    {
        $contactUs = new ContactUs();
        $this->assertEquals(true, $contactUs->get_isInitialized());
        $this->assertEquals(1, $contactUs->getID());
        $this->assertEquals("includes/contact_us_blurb.html", $contactUs->get_blurb_path());
        $this->assertEquals("sales@virginguitars.com", $contactUs->get_contact_email());
        $this->assertEquals("02 66 901 56", $contactUs->get_contact_telephone());
        $this->assertEquals("Virgin Guitars,", $contactUs->get_contact_address_line1());
        $this->assertEquals("26 Music Lane,", $contactUs->get_contact_address_line2());
        $this->assertEquals("Lismore, NSW. 2480.", $contactUs->get_contact_address_line3());
        $this->assertEquals("http://facebook.com/", $contactUs->get_facebook_url());
        $this->assertEquals("http://twitter.com/", $contactUs->get_twitter_url());
        $this->assertEquals("http://youtube.com/", $contactUs->get_youtube_url());
        $this->assertEquals("includes/privacy_policy_blurb.html", $contactUs->get_privacy_policy_path());
    }
    
    public function set_blurb_path_data_provider()
    {
        return array(
          array("includes/baadaa.html", true),                                                                        // Valid
          array("includes/baadaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.html", false), // too long
          array("includes/dsgasdf.html", true),
        );
    }
    
    /**
     * 
     * @dataProvider set_blurb_path_data_provider
     */
    public function test_set_blurb_path($path, $expected)
    {
        $contactUs = new ContactUs();
        
        // Backup the original path
        $originalPath = $contactUs->get_blurb_path();
        
        // Test callback result
        $this->assertEquals($expected, $contactUs->set_blurb_path($path));
        
        if ($expected)
        {
            // Make sure path is set (in object memory)
            $this->assertEquals($path, $contactUs->get_blurb_path());
            
            // Create new object to varify (in database)
            $contactUs2 = new ContactUs();
            $this->assertEquals($path, $contactUs2->get_blurb_path());
        }
        
        // Restore backup
        $contactUs->set_blurb_path($originalPath);
    }
}