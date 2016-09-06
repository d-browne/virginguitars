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
    
    public function set_contact_email_data_provider()
    {
        return array(
            array("zingas@mail.com", true),
            array("zingas.mail.com", "invalid email"),
            array("dominic@mail.com", true),
            array(1, "invalid email"),
            array(0, "invalid email"),
            array(-11, "invalid email"),
            array(NULL, "invalid email"),
            array("dominiccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc@mail.com", "email too long")
        );
    }
    
    /**
     * 
     * @dataProvider set_contact_email_data_provider
     */
    public function test_set_contact_email($email, $expected)
    {
        $contactUs = new ContactUs();
        
        // Backup original email
        $originalEmail = $contactUs->get_contact_email();
        
        // Test callback matches expected
        $this->assertEquals($expected, $contactUs->set_contact_email($email));
        
        // If expecteed result test that object updated in memory and database
        if ($expected === true)
        {
            // check object updated (in memory)
            $this->assertEquals($email, $contactUs->get_contact_email());
            // Check if object updated in databse (using new object)
            $contactUs2 = new ContactUs();
            $this->assertEquals($email, $contactUs2->get_contact_email());
        }
        
        // Restore backup of original email address
        $contactUs->set_contact_email($originalEmail);
    }
    
    public function set_contact_address_data_provider()
    {
        return array(
            array("1234 Fake Street", true),
            array("5324 Cool St.", true),
            array("99 Rocker Rd.", true),
            array(NULL, true),
            array(123, true),
            array(-123, true),
            array("123 something or other streeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeet.", "address too long")
        );
    }
    
    /**
     * 
     * @dataProvider set_contact_address_data_provider
     */
    public function test_set_contact_address_line_1($address, $expected)
    {
        $contactUs = new ContactUs();
        
        // Backup original address
        $originalAddress = $contactUs->get_contact_address_line1();
        
        // Test callback matches expected
        $this->assertEquals($expected, $contactUs->set_contact_address_line_1($address));
        
        // If expecteed result test that object updated in memory and database
        if ($expected === true)
        {
            // check object updated (in memory)
            $this->assertEquals($address, $contactUs->get_contact_address_line1());
            // Check if object updated in databse (using new object)
            $contactUs2 = new ContactUs();
            $this->assertEquals($address, $contactUs2->get_contact_address_line1());
        }
        
        // Restore backup of original address
        $contactUs->set_contact_address_line_1($originalAddress);
    }
    
    /**
     * 
     * @dataProvider set_contact_address_data_provider
     */
    public function test_set_contact_address_line_2($address, $expected)
    {
        $contactUs = new ContactUs();
        
        // Backup original address
        $originalAddress = $contactUs->get_contact_address_line2();
        
        // Test callback matches expected
        $this->assertEquals($expected, $contactUs->set_contact_address_line_2($address));
        
        // If expecteed result test that object updated in memory and database
        if ($expected === true)
        {
            // check object updated (in memory)
            $this->assertEquals($address, $contactUs->get_contact_address_line2());
            // Check if object updated in databse (using new object)
            $contactUs2 = new ContactUs();
            $this->assertEquals($address, $contactUs2->get_contact_address_line2());
        }
        
        // Restore backup of original address
        $contactUs->set_contact_address_line_2($originalAddress);
    }
    
    /**
     * 
     * @dataProvider set_contact_address_data_provider
     */
    public function test_set_contact_address_line_3($address, $expected)
    {
        $contactUs = new ContactUs();
        
        // Backup original address
        $originalAddress = $contactUs->get_contact_address_line3();
        
        // Test callback matches expected
        $this->assertEquals($expected, $contactUs->set_contact_address_line_3($address));
        
        // If expecteed result test that object updated in memory and database
        if ($expected === true)
        {
            // check object updated (in memory)
            $this->assertEquals($address, $contactUs->get_contact_address_line3());
            // Check if object updated in databse (using new object)
            $contactUs2 = new ContactUs();
            $this->assertEquals($address, $contactUs2->get_contact_address_line3());
        }
        
        // Restore backup of original address
        $contactUs->set_contact_address_line_3($originalAddress);
    }
    
    public function set_facebok_url_data_provider()
    {
        return array(
            array("http://facebook.com/sdfosudafads.adsfupsdf", true),
            array("http://facebook.com/virgin.guitars", true),
            array("", true),
            array(NULL, true),
            array("http://facebook.com/aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", "facebook too long"),
            array(-1, true),
        );
    }
    
    /**
     * 
     * @dataProvider set_facebok_url_data_provider
     */
    public function test_set_facebook_url($facebook, $expected)
    {
        $contactUs = new ContactUs();
        
        // Backup original facebook url
        $original_facebook_url = $contactUs->get_facebook_url();
        
        // Test callback matches expected
        $this->assertEquals($expected, $contactUs->set_facebook_url($facebook));
        
        // If expecteed result test that object updated in memory and database
        if ($expected === true)
        {
            // check object updated (in memory)
            $this->assertEquals($facebook, $contactUs->get_facebook_url());
            // Check if object updated in databse (using new object)
            $contactUs2 = new ContactUs();
            $this->assertEquals($facebook, $contactUs2->get_facebook_url());
        }
        
        // Restore backup of facebook url
        $contactUs->set_facebook_url($original_facebook_url);
    }
    
    public function set_twitter_url_data_provider()
    {
        return array(
            array("http://twitter.com/sdfosudafads.adsfupsdf", true),
            array("http://twitter.com/virgin.guitars", true),
            array("", true),
            array(NULL, true),
            array("http://twitter.com/aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", "twitter too long"),
            array(-1, true),
        );
    }
    
    /** 
     * 
     * @dataProvider set_twitter_url_data_provider
     */
    public function test_set_twitter_url($twitter, $expected)
    {
        $contactUs = new ContactUs();
        
        // Backup original twitter url
        $original_twitter_url = $contactUs->get_twitter_url();
        
        // Test callback matches expected
        $this->assertEquals($expected, $contactUs->set_twitter_url($twitter));
        
        // If expecteed result test that object updated in memory and database
        if ($expected === true)
        {
            // check object updated (in memory)
            $this->assertEquals($twitter, $contactUs->get_twitter_url());
            // Check if object updated in databse (using new object)
            $contactUs2 = new ContactUs();
            $this->assertEquals($twitter, $contactUs2->get_twitter_url());
        }
        
        // Restore backup of twitter url
        $contactUs->set_twitter_url($original_twitter_url);
    }
    
    public function set_youtube_url_data_provider()
    {
        return array(
            array("http://youtube.com/sdfosudafads.adsfupsdf", true),
            array("http://youtube.com/virgin.guitars", true),
            array("", true),
            array(NULL, true),
            array("http://youtube.com/aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", "youtube too long"),
            array(-1, true),
        );
    }
    
    /**
     * 
     * @dataProvider set_youtube_url_data_provider
     */
    public function test_set_youtube_url($youtube, $expected)
    {
        $contactUs = new ContactUs();
        
        // Backup original youtube url
        $original_youtube_url = $contactUs->get_youtube_url();
        
        // Test callback matches expected
        $this->assertEquals($expected, $contactUs->set_youtube_url($youtube));
        
        // If expecteed result test that object updated in memory and database
        if ($expected === true)
        {
            // check object updated (in memory)
            $this->assertEquals($youtube, $contactUs->get_youtube_url());
            // Check if object updated in databse (using new object)
            $contactUs2 = new ContactUs();
            $this->assertEquals($youtube, $contactUs2->get_youtube_url());
        }
        
        // Restore backup of youtube url
        $contactUs->set_youtube_url($original_youtube_url);
    }
}