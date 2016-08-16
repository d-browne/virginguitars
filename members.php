<?php
// Global includes
require 'includes/globalheader.php';

$signInError; 

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



// Check if signOut recieved
if(isset($_GET['signOut']))
{
    // Blank (unitialized customer)
    $_SESSION['currentCustomer'] = new Customer();
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars</title>
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
