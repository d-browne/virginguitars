<?php

use PHPUnit\Framework\TestCase;

require 'classes/Customer.php';

class CustomerTest extends TestCase
{
    // Test data for login/varify password test
    // Warning!!!: these tests are designed to pass with testing database
    // May not pass after database alterations
    public function customerLoginDataProvider()
    {
        return array(
          array("ben@mail.com", "password1", TRUE),                         // Valid login
          array("dale@mail.com", "password2", TRUE),                        // Valid login
          array("warren@mail.com", "password3", TRUE),                      // Valid login
          array("dominic@mail.com", "password4", TRUE),                     // Valid login
          array("davidmullburry@fitzroy.org", "delicious", FALSE),          // Invalid login, customer doesn't exist
          array("checkzFuzzlewuz@bundurry.org.au", "CranyVuzxcf", FALSE),   // Invalid login, cusomter doesn't exist
          array("", "", FALSE),                                             // Invalid login, empty strings
          array(1, 2, FALSE),                                               // Invalid login, integers
          array(NULL, NULL, FALSE),                                         // Invalid login, null values
          array("'DROP TABLE customers", NULL, FALSE)                       // Invalid login, null value and simulated attack string
        );
    }
    
    /**
     * 
     * @dataProvider customerLoginDataProvider
     */
    public function testValidateCustomer($username, $password, $expected)
    {
        // Test logins
        $this->assertEquals($expected, Customer::validateCustomer($username, $password));
    }
    
    public function doesExistDataProvider()
    {
        return array(
            array("dominic@mail.com", true),        // Exists in database
            array("ben@mail.com", true),            // Exists in database
            array("dale@mail.com", true),           // Exists in database
            array("warren@mail.com", true),         // Exists in database
            array("do2minic@mai2l.com", false),     // Does not exist in database
            array("", false),                       // blank string
            array(88, false),                       // Integer
            array("dsadfsdfdsf", false),            // random junk
            array("' DROP TABLE customer", false),  // Database breaking stuff
            array("\'dsfsdf'dfsdf  'd  dfsdf '\dsf sd\\", false)
        );
    }
    
    /**
     * @dataProvider doesExistDataProvider
     */
    public function testDoesCustomerExist($email, $expected)
    {
        $this->assertEquals($expected, Customer::doesCustomerExist($email));
    }
    
    public function newCustomerDataProvider()
    {
        return array(
            array("dominic@mail.com", "password1", false),
            array("dominic@mail.com", "password2", false),
            array("ben@mail.com", "passwo434rd2", false),
            array("dale@mail.com", "pa324234ord2", false),
            array("warren@mail.com", "passwo234324rd2", false),
            array("warren@mail.com", "pas'; swo234324rd2", false),
            array("flipper", "I'm swole", "invalid email"),
            array("flipper@shingoxc", "I'm note swole!!", "invalid email"),
            array("newguy@mail.com", "Passiwassi11", true),
            array("newguy2@mail.org", "Passiwassi11", true),
            array("newguy3@mail.net", "Passiwassi11", true),
            array("newguy4@mail.com.au", "Passiwassi11", true),
            array("testtttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt@web.org.au", "Passiwassi11", "email too long"),
        );
    }
    
    /**
     * @dataProvider newCustomerDataProvider
     */
    public function testNewCustomer($email, $password, $expected)
    {
        $this->assertEquals($expected, Customer::newCustomer($email, $password));
    }
    
    public function deleteCustomerDataProvider()
    {
        return array(
            array("newguy@mail.com", "deleted"),
            array("newguy2@mail.org", "deleted"),
            array("newguy3@mail.net", "deleted"),
            array("newguy4@mail.com.au", "deleted"),
            array("newguy@mail.com", "doesn't exist"),
            array("'; ", "doesn't exist"),
            array(0, "doesn't exist"),
            array(NULL, "doesn't exist")
        );
    }
    
    /**
     * 
     * @dataProvider deleteCustomerDataProvider
     */
    public function testDeleteCustomer($email, $expected)
    {
        $this->assertEquals($expected, Customer::deleteCusomter($email));
    }
    
    // check initialize an email address not in the database
    public function testInitializeWrongEmail()
    {
        $customer = new Customer();
        
        $this->assertEquals(NULL, $customer->initialize("notInDatabase@mail.com"));
    }
    
    // check initialize an email address not in the database
    public function testInitializeMalformedEmail()
    {
        $customer = new Customer();
        
        $this->assertEquals(NULL, $customer->initialize("notInDa@tabase@m@ail@.com"));
    }
    
    // check initialize a blank email address
    public function testInitializeBlank()
    {
        $customer = new Customer();
        
        $this->assertEquals(NULL, $customer->initialize(""));
    }
    
    // check initialize an integer
    public function testInitializeInteger()
    {
        $customer = new Customer();
        
        $this->assertEquals(NULL, $customer->initialize(-4));
    }
    
    // check initialize a null value 
    public function testInitializeNULL()
    {
        $customer = new Customer();
        
        $this->assertEquals(NULL, $customer->initialize(NULL));
    }
    
    // check initialize for customer dominic
    public function testInitializeDominic()
    {
        $customer = new Customer();
        $customer->initialize("dominic@mail.com");
        
        $this->assertEquals("Dominic", $customer->getFirstName());
        $this->assertEquals("Browne", $customer->getLastName());
        $this->assertEquals("", $customer->getSalutation());
        $this->assertEquals(0, $customer->getMailingList());
        $this->assertEquals("dominic@mail.com", $customer->getEmail());
        $this->assertEquals("3333444555", $customer->getMobilePhone());
        $this->assertEquals("44445555", $customer->getHomePhone());
        $this->assertEquals(true, $customer->getIsInitialized());
    }
    
    // check initialize for customer warren
    public function testInitializeWarren()
    {
        $customer = new Customer();
        $customer->initialize("warren@mail.com");
        
        $this->assertEquals("Warren", $customer->getFirstName());
        $this->assertEquals("Norris", $customer->getLastName());
        $this->assertEquals("", $customer->getSalutation());
        $this->assertEquals(1, $customer->getMailingList());
        $this->assertEquals("warren@mail.com", $customer->getEmail());
        $this->assertEquals("2222333444", $customer->getMobilePhone());
        $this->assertEquals("33334444", $customer->getHomePhone());
        $this->assertEquals(true, $customer->getIsInitialized());
    }
    
    // check initialize for customer ben
    public function testInitializeBen()
    {
        $customer = new Customer();
        $customer->initialize("ben@mail.com");
        
        $this->assertEquals("Ben", $customer->getFirstName());
        $this->assertEquals("Morrison", $customer->getLastName());
        $this->assertEquals("", $customer->getSalutation());
        $this->assertEquals(1, $customer->getMailingList());
        $this->assertEquals("ben@mail.com", $customer->getEmail());
        $this->assertEquals("0000111222", $customer->getMobilePhone());
        $this->assertEquals("11112222", $customer->getHomePhone());
        $this->assertEquals(true, $customer->getIsInitialized());
    }
    
    // check initialize for customer dale
    public function testInitializeDale()
    {
        $customer = new Customer();
        $customer->initialize("dale@mail.com");
        
        $this->assertEquals("Dale", $customer->getFirstName());
        $this->assertEquals("Hogan", $customer->getLastName());
        $this->assertEquals("", $customer->getSalutation());
        $this->assertEquals(0, $customer->getMailingList());
        $this->assertEquals("dale@mail.com", $customer->getEmail());
        $this->assertEquals("1111222333", $customer->getMobilePhone());
        $this->assertEquals("22223333", $customer->getHomePhone());
        $this->assertEquals(true, $customer->getIsInitialized());
    }
    
    // fuction to change set lastname
    public function testSetLastName()
    {
        $customer = new Customer();
        $customer->initialize("dominic@mail.com");
        
        $customer->setLastName("Brownee");
        
        $this->assertEquals("Brownee", $customer->getLastName());
        
        $customer->setLastName("Browne");
        
        $customer2 = new Customer();
        $customer2->initialize("dominic@mail.com");
        
        $this->assertEquals("Browne", $customer2->getLastName());
    }
    
    // fuction to change set lastname on unititialized member
    public function testSetLastNameUnitialized()
    {
        $customer = new Customer();
        
        $this->assertEquals("member not initialized", $customer->setLastName("Bowen"));
        $this->assertEquals(NULL, $customer->getLastName());
    }
    
    // Function to test getFirstName
    public function testGetFirstName()
    {
        $customer = new Customer();
        
        // Check uninitalized FirstName
        $this->assertEquals(NULL, $customer->getFirstName());
        
        // Check names
        $customer->initialize("dominic@mail.com");
        $this->assertEquals("Dominic", $customer->getFirstName());
        
        $customer->initialize("ben@mail.com");
        $this->assertEquals("Ben", $customer->getFirstName());
        
        $customer->initialize("warren@mail.com");
        $this->assertEquals("Warren", $customer->getFirstName());
        
        $customer->initialize("dale@mail.com");
        $this->assertEquals("Dale", $customer->getFirstName());
    }
    
    // Function to test setFirstName
    public function testSetFirstName()
    {
        $customer = new Customer();
        
        // Attempt set on unitialized object
        $this->assertEquals("member not initialized", $customer->setFirstName("Jeff"));
        
        // Initialize
        $customer->initialize("dominic@mail.com");
        
        // True check if return true from set
        $this->assertEquals(true, $customer->setFirstName("Jeff"));
        
        // Check if name changed on object
        $this->assertEquals("Jeff", $customer->getFirstName());
        
        // Create new customer object 
        $customer2 = new Customer();
        $customer2->initialize("dominic@mail.com");
        
        // Check if name change persisted
        $this->assertEquals("Jeff", $customer2->getFirstName());
        
        // Retore original FirstName
        $this->assertEquals(true, $customer2->setFirstName("Dominic"));
        
        // Check if name restored in object
        $this->assertEquals("Dominic", $customer2->getFirstName());
    }
    
    public function testSetSalutationDataProvider()
    {
        return array(
            array("dominic@mail.com", "Mr.", true),                     
            array("ben@mail.com", "Master.", false),                    // Query will fail because too long
            array("ben@mail.com", NULL, true),
            array("ben@mail.com", 12345684, false),                     // Query will fail because too long
            array("ben@mail.com", 12, true),
            array("warren@mail.com", "Dr.", true),
            array("dale@mail.com", "Mrs.", true),
            array("fred@mail.com", "Mrs.", "member not initialized"),   
            array("george@mail.com", 0, "member not initialized"),
            array("jason@mail.com", NULL, "member not initialized"),
            array(NULL, NULL, "member not initialized"),
            array("dominic@mail.com", "", true),                        // Queries below rest database to standard
            array("ben@mail.com", "", true),
            array("warren@mail.com", "", true),
            array("dale@mail.com", "", true),
        );
    }
    
    /**
     * 
     * @dataProvider testSetSalutationDataProvider
     */
    public function testSetSalutation($email, $data, $expected)
    {
        $customer = new Customer();
        $customer->initialize($email);
        
        $this->assertEquals($expected, $customer->setSalutation($data));
    }
    
    public function setMailingListDataProvider()
    {
        return array(
            array(1, true),
            array(0, true),
            array(2, false),
            array(-1, false),
            array("a", false),
            array("b", false),
            array("banana", false),
        );
    }
    
    /**
     * @dataProvider setMailingListDataProvider
     */
    public function testSetMailingListCallback($MailingList, $expected)
    {
        $customer = new Customer();
        $customer->initialize("dominic@mail.com");
        
        // Test if set callback working
        $this->assertEquals($expected, $customer->setMailingList($MailingList));
    }
    
    public function setMailingChangesListDataProvider()
    {
        return array(
            array(1, "dominic@mail.com"),
            array(0, "dominic@mail.com"),
            array(1, "warren@mail.com"),
            array(0, "warren@mail.com"),
            array(1, "ben@mail.com"),
            array(0, "ben@mail.com"),
            array(1, "dale@mail.com"),
            array(0, "dale@mail.com")
        );
    }
    
    /** 
     * 
     * @dataProvider setMailingChangesListDataProvider
     */
    public function testSetMailingListChanges($data, $email)
    {
        $customer = new Customer();
        $customer->initialize($email);
        
        // Store original value
        $originalValue = $customer->getMailingList();
        
        // Change the mailing list value
        $customer->setMailingList($data);
        
        // Check that the object has the updated value
        $this->assertEquals($data, $customer->getMailingList());
        
        // Create new object to ensure that the change persits in new objects
        $customer2 = new Customer();
        $customer2->initialize($email);
        
        // Check if value persisted into new object (and database)
        $this->assertEquals($data, $customer2->getMailingList());
        
        // Reset database back to original value
        $customer2->setMailingList($originalValue);
    }
    
    
}