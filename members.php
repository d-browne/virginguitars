<?php
// Start session
session_start();

require "classes/Admin.php";

// Check if isAdmin session varible is set. If not, initialize
if (!isset($_SESSION["isAdmin"]))
{
    $_SESSION["isAdmin"] = false;
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
                // Check if member signed in
                // If signed in display members area
                // Otherwise display member signin/registration
            ?>
        </div>
            
            
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
            
        </div>
</body>
</html>
