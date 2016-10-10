<?php

/* 
 * This page displays the desired product page for the provided product ID
 */

// Global includes
require 'includes/globalheader.php';

// get a data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

// Check if id is specified 
if (isset($_GET['id']))
{
    // Sanitize product id input
    $ProductID = mysqli_real_escape_string($dataConnection, $_GET['id']);
    try {
    // Try to create product object using given id
    $product = new Product($ProductID);
    } catch (Exception $ex) {
        if ($ex->getMessage() == "ProductID not found")
        {
            $errorString = "'".$ProductID."' not a valid product id...";
        }
        else
        {
            $errorString = $ex->getMessage();
        }
    }
}
else
{
    // error message id not specified
    $errorString = "A product ID must be specified...";
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Product Name</title>
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
                <?php if (!isset($errorString)): // Display page if no erros ?>
                <div id="leftColumn">
            	<!-- Image slider code goes in here -->
            	<div id="sliderFrame">
        			<div id="slider">
                		<a href="images/guitars/fenderAmericanStandardStratocaster/2.jpg">
                        	<img src="images/guitars/fenderAmericanStandardStratocaster/resized2.jpg" alt=""/>
                        </a>
                        <a href="images/guitars/fenderAmericanStandardStratocaster/3.jpg">
                        	<img src="images/guitars/fenderAmericanStandardStratocaster/resized3.jpg" alt=""/>
                        </a>
                        <a href="images/guitars/fenderAmericanStandardStratocaster/4.jpg">
                        	<img src="images/guitars/fenderAmericanStandardStratocaster/resized4.jpg" alt=""/>
                        </a>
                        <a href="images/guitars/fenderAmericanStandardStratocaster/5.jpg">
                        	<img src="images/guitars/fenderAmericanStandardStratocaster/resized5.jpg" alt=""/>
                        </a>
                        <a href="images/guitars/fenderAmericanStandardStratocaster/6.jpg">
                        	<img src="images/guitars/fenderAmericanStandardStratocaster/resized6.jpg" alt=""/>
                        </a>
            			
                        
        			</div>
    			</div> 
                <div id="sliderInstruction">Click image for fullsize!</div>
            </div>
                
            <div id="rightColumn">
                <h1>American Standard Stratocaster</h1>
                <a href="images/guitars/fenderAmericanStandardStratocaster/1.jpg">
                	<div class="guitarMainPicture" style="background-image:url('images/guitars/fenderAmericanStandardStratocaster/1.jpg');background-size:250px 250px;
                	background-position:0px;"></div>
                </a>
                <div class="stockDetailsTag">In Stock</div>
                <div class="stockDetailsTag">AU $802.27</div>
                <div class="stockDetailsTag">2 Available</div>
                
                <h4> Specifications </h4>
                <ul class="featuresList">
                	<li><em>Brand:</em> Fender</li>
                    <li><em>Type:</em> Electric Guitar </li>
                    <li><em>Condition:</em> Brand New</li>
                    <li><em>Case:</em> Hard case</li>
                    
                </ul>

                <h4> Description </h4>
                <p>Gorgeous sounding 2006 American Standard Stratocaster. It has a very comfortable feel and the pickups sound stellar. This guitar features a few upgraded parts including a Callaham bridge and Sperzel tuners; both of which help with intonation and overall sustain. On top of all of that, the guitar is in great overall shape! </p>
                
                <h4> Features </h4>
                <ul class="featuresList">
                	<li><em>Body:</em> Solid contoured alder body in sunburst finish. Callaham bridge with six individual saddles, skirted control knobs and a 3-ply parchment pickguard. Trem arm is included in the case. </li>
                    <li><em>Neck:</em> Modern “C” shaped maple neck with a skunk stripe down the back and neck tilt adjustment at the heel. Maple fingerboard with black dot inlays and a 1 11/16” nut. Staggered locking sperzel tuners, 25.5” scale length. </li>
                    <li><em>Pickups/Electronics:</em> Original Fender American Standard Single-coil pickups in the neck, middle and bridge. Master volume control, neck tone control, no-load tone control for the middle and bridge pickups and a 5-way selector switch. The new capacitor works and sounds fine though the guitar’s volume does drop slightly with the tone rolled back. </li>
                    <li><em>Neck:</em> 5.92K Ohms.</li>
                    <li><em>Middle:</em> 5.76K Ohms.</li>
                    <li><em>Bridge:</em> 7.19K Ohms. </li>
                    <li><em>Weight:</em> 7lbs, 15.0oz. </li>
                    <li><em>Case:</em> Includes the original hardshell case. Some small accessories are included in the case. </li>
                    <li><em>Condition:</em> This guitar is in excellent condition!  There are just a few very light surface scratches and a few tiny dings throughout the entire guitar. The protective plastic wrap is still intact on the pickguard! Fingerboard and frets are in great shape with hardly any play wear and tons of life left in them. The neck is nice and straight with great action and the truss rod and neck tilt adjustment function perfectly. The tone capacitor has been upgraded, the bridge has been upgraded to a Callaham bridge and the tuners have been upgraded to staggered Sperzel locking tuners. All electronics and parts are in perfect working condition. </li>
                    
                </ul>
                <div id="stretcher"></div>
                <a href="cart.html"><div id="cartButton">Add to cart</div></a>
            </div>
            
            
            
            
            <?php else: ?>
                <span><?php echo htmlspecialchars($errorString); // Displays error message and strips special html characters ?></span>
            <?php endif; ?>
            </div>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>

        </div>
</body>
</html>