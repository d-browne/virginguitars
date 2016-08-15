<?php

// Start session
session_start();

require "classes/Admin.php";


// Check if isAdmin session varible is set. If not, initialize
if (!isset($_SESSION["isAdmin"]))
{
    $_SESSION["isAdmin"] = false;
}

//Check if post recieved
if (isset($_POST['submit'])) {
    // Get email and password from POST
    $adminUsername = $_POST['adminUsername'];
    $adminPassword = $_POST['adminPassword'];
    
    // Check if username and password for admin are valid
    $admin = new Admin($adminUsername, $adminPassword);
    
    // If admin credentails check out set logged in flag to true
    if ($admin->getAuthenticated() == true)
    {
        $_SESSION["isAdmin"] = true;
    }
}

// Check if logout recieved and log out admin
if (isset($_GET["logout"]))
{
    $_SESSION["isAdmin"] = false;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars - Sign In</title>
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
        
        <div id="menuBox">
       	  <nav id="menuList">
          	<ul>
            	<li id="homeItem"><a href="index.html">Home</a></li>
                <li><a href="catalog.html">Catalog</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="members.html">Members</a></li>
                <li><a href="faq.html">FAQ</a></li>
            </ul>
          </nav>
        </div>
        
        <div id="categoryBox">
        	<a href="fender.html"><div class="categoryImage" id="fenderCategory"></div></a>
            <a href="gibson.html"><div class="categoryImage" id="gibsonCategory"></div></a>
            <a href="bcrich.html"><div class="categoryImage" id="bcRichCategory"></div></a>
            <a href="jackson.html"><div class="categoryImage" id="jacksonLogo"></div></a>
            
        </div>
        
        <?php
            // Check if admin is logged in
            if ($_SESSION["isAdmin"])
            {
                // If admin is logged in display (include) admin control panel
                include("includes/adminControlPanel.php.inc");
            }
            else
            {
                // Otherwise display (include) admin login page
                include("/includes/adminlogin.php.inc");
            }
            
        ?>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>

        </div>
</body>
</html>
