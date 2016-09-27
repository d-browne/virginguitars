<?php
$isUpdated = false;

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

$errorString = '';      // holds the error string
$customer;              // hold customer object

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
        <form id="userDetailsForm" action="members.php" method="POST">
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
        <form id="personalDetailsForm" action="members.php" method="POST">
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