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
<title>
    <?php if (!isset($errorString)): // Display product as title if no errors ?>
        <?php echo $product->getModel(); ?>
    <?php else: // Display "Error" as title ?>
    Error
    <?php endif; ?>
</title>
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
                <h1><?php echo $product->getModel(); ?></h1>
                <a href="<?php echo $product->getPrimaryPicturePath() ?>">
                    <div class="guitarMainPicture" style="background-image:url('<?php echo $product->getPrimaryPicturePath() ?>');background-size:250px 250px;
                	background-position:0px;"></div>
                </a>
                <div class="stockDetailsTag"><?php echo $product->getStatus(); ?></div>
                <div class="stockDetailsTag">AU $<?php echo $product->getPrice(); ?></div>
                <div class="stockDetailsTag"><?php echo $product->getQuantity(); ?> Available</div>
                
                <h4> Specifications </h4>
                <ul class="featuresList">
                    <li><em>Brand:</em> <?php echo $product->getBrand(); ?></li>
                    <li><em>Type:</em> <?php echo $product->getType(); ?> </li>
                    <li><em>Condition:</em> <?php echo $product->getCondition(); ?></li>
                    <li><em>Case:</em> <?php echo $product->getCaseType(); ?></li>
                    
                </ul>

                <h4> Description </h4>
                <?php echo $product->getDescription(); ?>
                
                <div id="stretcher"></div>
                <div id="bottomButtonsBox">
                    <form action="cart.html"><button class="formCSSButtonButton">Add Cart</button></form>
                </div>

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