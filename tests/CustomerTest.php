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
            array("ben@mail.com", "Master.", "salutation too long"),                    // Query will fail because too long
            array("ben@mail.com", NULL, true),
            array("ben@mail.com", 12345684, "salutation too long"),                     // Query will fail because too long
            array("ben@mail.com", 12, true),
            array("warren@mail.com", "Dr.", true),
            array("dale@mail.com", "Mrs.", true),
            array("fred@mail.com", "Mrs.", "member not initialized"),   
            array("george@mail.com", 0, "member not initialized"),
            array("jason@mail.com", NULL, "member not initialized"),
            array(NULL, NULL, "member not initialized"),
            array("dominic@mail.com", "", true),                                        // Queries below rest database to standard
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
    
    public function setEmailCallbackDataProvider()
    {
        return array(
            array("dominic@mail.com", "dominic2@mail.com", true),
            array("dale@mail.com", "dale2@mail.com", true),
            array("warren@mail.com", "warren2@mail.com", true),
            array("ben@mail.com", "ben2@mail.com", true),
            array("dominic2@mail.com", "dominic.mail.com", "Invalid Email"),
            array("warren2@mail.com", "suggaMomma", "Invalid Email"),
            array("dale@mail.com", "sugga@Momma.net", "Member Not Initialized"),
            array("dominic2@mail.com", "dominiccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc@mail.com", "Too Long"),
            array("dominic2@mail.com", "dominic@mail.com", true),
            array("dale2@mail.com", "dale@mail.com", true),
            array("warren2@mail.com", "warren@mail.com", true),
            array("ben2@mail.com", "ben@mail.com", true)
        );
    }
    
    /** 
     * 
     * @dataProvider setEmailCallbackDataProvider
     */
    public function testSetEmailCallback($email, $newEmail, $result)
    {
        $customer = new Customer();
        $customer->initialize($email);
        
        $this->assertEquals($result, $customer->setEmail($newEmail));
    }
    
    public function setMailChangesDataProvider()
    {
        return array(
            array("dominic@mail.com", "dominic2@mail.com"),
            array("warren@mail.com", "warren2@mail.com"),
            array("ben@mail.com", "ben2@mail.com"),
            array("dale@mail.com", "dale2@mail.com")
        );
    }
    
    /** 
     * 
     * @dataProvider setMailChangesDataProvider
     */
    public function testSetEmailChanges($email, $newEmail)
    {
        $customer = new Customer();
        $customer->initialize($email);
        
        // Store original email
        $originalEmail = $customer->getEmail();
        
        // Change email
        $customer->setEmail($newEmail);
        
        // test changes
        $this->assertEquals($newEmail, $customer->getEmail());
        
        // Check change in seconardy object
        $customer2 = new Customer();
        $customer2->initialize($newEmail);
        
        $this->assertEquals($newEmail, $customer2->getEmail());
        
        // Revert datbase back to original state
        $customer->setEmail($originalEmail);
    }
    
    public function setHomePhoneCallbackDataProvider()
    {
        return array(
            array("dominic@mail.com", "12345678", true),
            array("dominic@mail.com", "(02)22315658", true),
            array("dominic@mail.com", "(02) 22 315 658", true),
            array("dominic@mail.com", "2231 5658", true),
            array("dominic2@mail.com", "2231 5658", "Member Not Initialized"),
            array("warren@mail.com", "2231565888888888", "Home Phone Too Long"),
            array("warren@mail.com", "[02] 22315658", "Invalid Home Phone Characters"),
            array("warren@mail.com", "asdfbfgdf", "Invalid Home Phone Characters"),
            array("warren@mail.com", NULL, true),
            array("warren@mail.com", -10, "Invalid Home Phone Characters"),
            array("warren@mail.com", 123, true),
            array("dominic@mail.com", "44445555", true),
            array("warren@mail.com", "33334444", true)
        );
    }
    
    /** 
     * 
     * @dataProvider setHomePhoneCallbackDataProvider
     */
    public function testSetHomePhoneCallback($email, $newHomePhone, $result)
    {
        $customer = new Customer();
        $customer->initialize($email);
        
        $this->assertEquals($result, $customer->setHomePhone($newHomePhone));
    }
    
    public function setHomePhoneChangesDataProvider()
    {
        return array(
            array("dominic@mail.com", "12345678"),
            array("warren@mail.com", "(07) 1234 3234"),
            array("ben@mail.com", "8888 5555"),
            array("dale@mail.com", "36521248")
        );
    }
    
    /** 
     * 
     * @dataProvider setHomePhoneChangesDataProvider
     */
    public function testSetHomePhoneChanges($email, $newHomePhone)
    {
        $customer = new Customer();
        $customer->initialize($email);
        
        // Store original home phone number
        $originalHomePhone = $customer->getHomePhone();
        
        // Update HomePhone
        $customer->setHomePhone($newHomePhone);
        
        // Test if object updated
        $this->assertEquals($newHomePhone, $customer->getHomePhone());
        
        // Create a secondary object to test if persists
        $customer2 = new Customer();
        $customer2->initialize($email);
        
        // Test persistance
        $this->assertEquals($newHomePhone, $customer2->getHomePhone());
        
        // Resture original home phone number
        $customer->setHomePhone($originalHomePhone);
    }
    
    public function setMobilePhoneCallbackDataProvider()
    {
        return array(
            array("dominic@mail.com", "12345678", true),
            array("dominic@mail.com", "(02)22315658", true),
            array("dominic@mail.com", "(02) 22 315 658", true),
            array("dominic@mail.com", "2231 5658", true),
            array("dominic2@mail.com", "2231 5658", "Member Not Initialized"),
            array("warren@mail.com", "2231565888888888", "Too Long"),
            array("warren@mail.com", "[02] 22315658", "Invalid Characters"),
            array("warren@mail.com", "asdfbfgdf", "Invalid Characters"),
            array("warren@mail.com", NULL, true),
            array("warren@mail.com", -10, "Invalid Characters"),
            array("warren@mail.com", 123, true),
            array("dominic@mail.com", "3333444555", true),
            array("warren@mail.com", "2222333444", true)
        );
    }
    
    /**
     * 
     * @dataProvider setMobilePhoneCallbackDataProvider
     */
    public function testSetMobilePhoneCallback($email, $newMobilePhone, $result)
    {
        $customer = new Customer();
        $customer->initialize($email);
        
        $this->assertEquals($result, $customer->setMobilePhone($newMobilePhone));
    }
    
    /**
     * 
     * @dataProvider setHomePhoneChangesDataProvider
     */
    public function testSetMobilePhoneChanges($email, $newMobilePhone)
    {
        $customer = new Customer();
        $customer->initialize($email);
        
        // Store original mobile phone number
        $originalMobilePhone = $customer->getMobilePhone();
        
        // Update MobilePhone
        $customer->setMobilePhone($newMobilePhone);
        
        // Test if object updated
        $this->assertEquals($newMobilePhone, $customer->getMobilePhone());
        
        // Create a secondary object to test if persists
        $customer2 = new Customer();
        $customer2->initialize($email);
        
        // Test persistance
        $this->assertEquals($newMobilePhone, $customer2->getMobilePhone());
        
        // Resture original mobile phone number
        $customer->setMobilePhone($originalMobilePhone);
    }
    
    public function setPasswordCallbackDataProvider()
    {
        return array(
            array("8sdf-shdfsd", true),
            array(NULL, true),
            array(-1, true),
            array("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaAAAAAAAAAAAAAAAAAAAAAAAaAAAAAAAAAAAAAAAAAAAAAAAaAAAAAAAAAAAAAAAAAAAAAAAaAAAAAAAAAAAAAAAAAAAAAAAaAAAAAAAAAAAAAAAAAAAAAAAAa", true),
            array("9999999999999x", true),
            array("' DROP \\ \\", true)
        );
    }
    /**
     * 
     * @dataProvider setPasswordCallbackDataProvider
     */
    public function testSetPasswordCallback($newPassword, $expected)
    {
        // Check if test customer doesn't exist
        if (!Customer::doesCustomerExist("testCustomer@mail.com"))
        {
            // Create the test customer
            Customer::newCustomer("testCustomer@mail.com", "password");
        }
        
        $customer = new Customer();
        $customer->initialize("testCustomer@mail.com");
        
        // test the callback
        $this->assertEquals($expected, $customer->setPassword($newPassword));
        
        // Remove testcustomer from database
        Customer::deleteCusomter("testCustomer@mail.com");
    }
    
    // Test change password on uninitialized (non-existant) member
    public function testSetPasswordNoMember()
    {
        // Check if test customer exists
        if (Customer::doesCustomerExist("testCustomer@mail.com"))
        {
            // Delete test custome if it exists
            Customer::deleteCusomter("testCustomer@mail.com");
        }
        
        $customer = new Customer();

        // Attempt password change uninitialized
        $this->assertEquals("Member Not Initialized", $customer->setPassword("password"));
        
        // Attempt to initialize member that doesn't exist
        $customer->initialize("testCustomer@mail.com");
        
        // Attempt password change on non existant member
        $this->assertEquals("Member Not Initialized", $customer->setPassword("password"));
    }
    
    public function setChangePasswordVarifyDataProvider()
    {
        return array(
            array("testuser1@mail.com", "password1"),
            array("testuser2@mail.com", "password2"),
            array("testuser3@mail.com", 7),
            array("testuser4@mail.com", NULL)
        );
    }
    
    /**
     * Test that the changed passwords can be varified
     * @dataProvider setChangePasswordVarifyDataProvider
     */
    public function testSetChangePasswordVarify($email, $newPassword)
    {
        if (!Customer::doesCustomerExist($email))
        {
            Customer::newCustomer($email, "defaultPassword");
        }
        
        $customer = new Customer();
        $customer->initialize($email);
        
        // Change password
        $customer->setPassword($newPassword);
        
        // Check validate password
        $this->assertEquals(true, Customer::validateCustomer($email, $newPassword));
        
        // Cleanup (delete) test customer
        Customer::deleteCusomter($email);
    }
}