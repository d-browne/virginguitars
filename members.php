<?php
// Global includes
require 'includes/globalheader.php';

$signInError;           // Holds error for signNn
$createError;           // Holds error for create
$isUpdated = false;     // has member been updated
$updateMemberError;     // Hold the update member error

// Check if signIn received
if(isset($_POST['signIn']))
{
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // Check if username and password exist in the database
    if(Customer::validateCustomer($email, $password))
    {
        // Initialize member to specified email addres
        $_SESSION['currentCustomer']->initialize($email);
    }
    else
    {
        $signInError = "Invalid Username/Password....";
    }
}

// Check if create recieved
if (isset($_POST['create']))
{
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $confirmEmail = filter_input(INPUT_POST, 'emailConfirm', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    
    // Check if email matches the confirm
    if ($email == $confirmEmail)
    {
        if ($password === $passwordConfirm)
        {
            // Make sure email is not already in use
            if (Customer::doesCustomerExist($email))
            {
                $createError = "Email already in use....";
            }
            else
            {
                // Create new customer
                $creationStatus = Customer::newCustomer($email, $password);

                // Check if creation status is boolean
                if (is_string($creationStatus))
                {
                    // Show creation error
                    $createError = $creationStatus;
                }

                if ($creationStatus == true)
                {
                    // Login as newly created customer
                    $_SESSION['currentCustomer']->initialize($email);
                }
            }
        }
        else
        {
            $createError = "Passwords don't match...";
        }
    }
    else
    {
        // Emails don't match error
        $createError = "Emails don't match....";
    }
}

// Check if signOut recieved
if(isset($_GET['signOut']))
{
    // Blank (unitialized customer)
    $_SESSION['currentCustomer'] = new Customer();
}

//Check for update member
if (isset($_POST['updateMember']))
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
            $_SESSION['currentCustomer']->setPassword($password);
            
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
        $_SESSION['currentCustomer']->setEmail($email);
        $isUpdated = true; // sets is updated flag
    }
    else
    {
        $updateMemberError = "Email addresses don't match...";
    }
    
    // Set MailingList
    if (isset($_POST['mailingList']))
    {
        $_SESSION['currentCustomer']->setMailingList(1);
        $isUpdated = true; // sets is updated flag
    }
    else
    {
        $_SESSION['currentCustomer']->setMailingList(0);
        $isUpdated = true; // sets is updated flag
    }
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars - Members</title>
<link href="styles/main.css" rel="stylesheet" type="text/css">
<link href="styles/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="scripts/js-image-slider.js" type="text/javascript"></script>
</head>

<body>
	<div id="mainBox">
    	<?php
            // Display Page header
            include 'includes/pageheader.php.inc';
        ?>
        
        <?php
            // Display menu bar
            include 'includes/menubar.php.inc';
        ?>
        
        <div id="categoryBox">
        	<a href="fender.html"><div class="categoryImage" id="fenderCategory"></div></a>
            <a href="gibson.html"><div class="categoryImage" id="gibsonCategory"></div></a>
            <a href="bcrich.html"><div class="categoryImage" id="bcRichCategory"></div></a>
            <a href="jackson.html"><div class="categoryImage" id="jacksonLogo"></div></a>
            
        </div>
        
        <div id="contentBox">
            <?php
                // Check if  customer signed in
                if ($_SESSION["currentCustomer"]->getIsInitialized())
                {
                    // If signed in display members area
                    include 'includes/membersArea.php.inc';
                }
                else
                {
                    // Otherwise display member signin/registration
                    include 'includes/memberSignin.php.inc';
                }
                
            ?>
        </div>
            
            
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
            
        </div>
</body>
</html>
