<?php
// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

$errorString = '';      // holds the error string
$customer;              // hold customer object

$updateMemberError = ''; // placeholder for updateMemberError

// check if id supplied
if (isset($_GET['edit']))
{
    // Check if customer id is valid
    $customerID = mysqli_real_escape_string($dataConnection, $_GET['edit']);
    
    // Query for customer
    $queryForCustomerID = "SELECT CustomerID FROM CUSTOMER WHERE CustomerID ='".$customerID."';";
    
    // Execute query
    $customerCheckQueryResult = $dataConnection->query($queryForCustomerID);
    
    // Check if query successfull 
    if ($customerCheckQueryResult !== false)
    {
        // Check if customer exists (row retruned)
        if ($customerCheckQueryResult->num_rows > 0)
        {
            // Create customer object
            $customer = new Customer();
            $customer->initializeID($customerID);
        }
        else
        {
            // Customer id not found error
            $errorString = "Customer ID '".$customerID."' not found...";
        }
    }
    else
    {
        // Query failed error
        $errorString = "Query for customer id failed...";
    }
}
else
{
    // No customer ID error message
    $errorString = "Need to specify a customer ID....";
}

//Check for update member post
if (isset($_POST['updateMember']))
{
    // Ensure customer is initialized
    if ($customer->getIsInitialized())
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $confirmEmail = filter_input(INPUT_POST, 'emailConfirm', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirmPassword = $_POST['passwordConfirm'];

        // if passwords are blank don't change
        // Otherwise check that they match
        // If they match update the password
        // Create a message to indicate updated

        // If passwords are not blank, update them
        if (!($password == "" && $confirmPassword == ""))
        {
            // Check if passwords match
            if ($password == $confirmPassword)
            {
                // Set new password
                $customer->setPassword($password);

                // Set updated flag
                $isUpdated = true;
            }
            else
            {
                // Set the error for passwords not matching
                $updateMemberError = "Passwords don't match...";
            }
        }

        // Check if emails match
        // If they match update
        if ($email === $confirmEmail)
        {
            // Set new email address
            $customer->setEmail($email);
            $isUpdated = true; // sets is updated flag
        }
        else
        {
            $updateMemberError = "Email addresses don't match...";
        }

        // Set MailingList
        if (isset($_POST['mailingList']))
        {
            $customer->setMailingList(1);
            $isUpdated = true; // sets is updated flag
        }
        else
        {
            $customer->setMailingList(0);
            $isUpdated = true; // sets is updated flag
        }
    }
    else
    {
        // set error string
        $errorString = "Unable to recieve updateMember POST, customer not initialized";
    }
}

// Check for update personal details POST
if (isset($_POST['updatePersonalDetails']))
{
    // Ensure customer is initialized
    if ($customer->getIsInitialized())
    {
        // array to hold results of setting
        $results = array();

        // Get all inputs
        $salutation = $_POST['salutation'];
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $streetAddress = $_POST['street'];
        $city = $_POST['city'];
        $postCode = $_POST['postcode'];
        $country = $_POST['country'];
        $homePhone = $_POST['homephone'];
        $mobilePhone = $_POST['mobilephone'];

        array_push($results, $customer->setSalutation($salutation));
        array_push($results, $customer->setFirstName($firstName));
        array_push($results, $customer->setLastName($lastName));
        array_push($results, $customer->getHomeAddress()->setStreetAddress($streetAddress));
        array_push($results, $customer->getHomeAddress()->setCity($city));
        array_push($results, $customer->getHomeAddress()->setPostCode($postCode));
        array_push($results, $customer->getHomeAddress()->setCountry($country));
        array_push($results, $customer->setHomePhone($homePhone));
        array_push($results, $customer->setMobilePhone($mobilePhone));

        // Display each error
        foreach ($results as $result)
        {
            if ($result !== true) // Is an error
            {
                $updateMemberError = $updateMemberError.$result.", ";
            }
        }
        $isUpdated = true;
    }
    else
    {
        // set error string (unable to update personal details)
        $errorString = "Unable to recieve updatePersonalDetails POST, customer not initialized";
    }
    
}
?>


<div id="contentBox">
<?php if ($errorString === ''): // Display if no errors ?>
<div id="leftColumn" style="border-bottom: 1px solid #D4B96A;">
    <!-- Image slider code goes in here -->
    <div id="sliderFrame">
        <div id="slider">
            <a href="#">
                <img src="images/wrenchImage.jpg" alt=""/>
            </a>
        </div>
        <div id="htmlcaption" style="display: none;">
            <em>HTML</em> caption. Link to <a href="http://www.google.com/">Google</a>.
        </div>
    </div> 
</div>

<div id="rightColumn">
    <h1>Edit Customer - ID: <?php echo $customer->getCustomerID(); ?></h1>
            <p>From here you may edit the details of customer <?php echo $customer->getCustomerID(); ?>...
                <span id="updatedMemberLabel">
                    <?php
                        // Write updated if updated flag set
                        if ($isUpdated)
                        {
                            echo " Updated!";
                        }
                    ?>
                </span>
                <span id="updatedMemberErrorLabel">
                    <?php
                        // Write the error message if there is an error updating member
                        if (isset($updateMemberError))
                        {
                            echo " ".$updateMemberError;
                        }
                    ?>
                </span>
            </p>
    <fieldset class="inputFieldSet" id="userDetailsFieldset">
        <legend>Edit Customer User details</legend>
        <form id="userDetailsForm" action="admin.php?manageCustomers&edit=<?php echo $customerID; ?>" method="POST">
            <div class="inputField"><label>ID:</label> <input class="textBox" type="text" name="id" value="<?php echo $customer->getCustomerID(); ?>" disabled="true"/></div>
            <div class="inputField"><label>Email:</label> <input class="textBox" type="email" name="email" value="<?php echo $customer->getEmail(); ?>" required/></div>
            <div class="inputField"><label>Re-Type Email:</label> <input class="textBox" type="email" name="emailConfirm" value="<?php echo $customer->getEmail(); ?>" required/></div>
            <div class="inputField"><label>Password:</label> <input class="textBox" type="password" name="password" placeholder="••••••••••••••••" /></div>
            <div class="inputField"><label>Re-Type Password:</label> <input class="textBox" type="password" name="passwordConfirm" placeholder="••••••••••••••••" /></div>
            <div class="inputField"><label>Subscribe to newsletter:</label> <input type="checkbox" name="mailingList" <?php if($customer->getMailingList() == 1) {echo "checked";} ?>></div>
            <div class="inputField"><input class="submitButton" type="submit" name="updateMember" value="Submit" /></div>
        </form>
    </fieldset>

    <fieldset class="inputFieldSet" id="personalDetailsFieldset">
        <legend>Edit Customer Personal Details</legend>
        <form id="personalDetailsForm" action="admin.php?manageCustomers&edit=<?php echo $customerID; ?>" method="POST">
            <div class="inputField"><label>Salutation:</label> <input class="textBox" name="salutation" type="text" placeholder="e.g. Mrs." value="<?php echo $customer->getSalutation(); ?>"/></div>
            <div class="inputField"><label>First Name:</label> <input class="textBox" name="firstname" type="text" placeholder="e.g. April" value="<?php echo $customer->getFirstName(); ?>"/></div>
            <div class="inputField"><label>Last Name:</label> <input class="textBox" name="lastname" type="text" placeholder="e.g. Frederick Stevenson" value="<?php echo $customer->getLastName(); ?>"/></div>
            <div class="inputField"><label>Street Address:</label> <input class="textBox" name="street" type="text" placeholder="e.g. 26 Music Lane" value="<?php echo $customer->getHomeAddress()->getStreetAddress(); ?>"/></div>
            <div class="inputField"><label>City:</label> <input class="textBox" type="text" name="city" nameplaceholder="e.g. Lismore"value="<?php echo $customer->getHomeAddress()->getCity(); ?>" /></div>
            <div class="inputField"><label>Post code:</label> <input class="textBox" type="text" name="postcode" placeholder="e.g. 2480" value="<?php echo $customer->getHomeAddress()->getPostCode(); ?>" /></div>
            <div class="inputField"><label>Country:</label> <input class="textBox" type="text" name="country" placeholder="e.g. Australia" value="<?php echo $customer->getHomeAddress()->getCountry(); ?>" /></div>
            <div class="inputField"><label>Home Telephone:</label> <input class="textBox" type="text" name="homephone" placeholder="e.g. (02) 6690 1566" value="<?php echo $customer->getHomePhone(); ?>" /></div>
            <div class="inputField"><label>Mobile Telephone:</label> <input class="textBox" type="text" name="mobilephone" placeholder="e.g. 0489 321 153" value="<?php echo $customer->getMobilePhone(); ?>" /></div>
            <div class="inputField"><input class="submitButton" type="submit" name="updatePersonalDetails" value="Submit" /></div>
        </form>
    </fieldset>

    <div id="bottomButtonsBox">
        <form action="admin.php" method="GET"><input type="hidden" name="CustomerID" value="<?php echo $customer->getCustomerID(); ?>" /><button name="customerOrders" class="formCSSButtonButton">Orders</button></form>
        <button type="button" onclick="window.history.back()" class="formCSSButtonButton">Back</button>
    </div>
</div>
<?php else: // Display error message ?>
<?php echo $errorString; ?>
<?php endif; ?>
</div>