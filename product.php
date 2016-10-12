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
    
    // Error if product is deleted
    if ($product->getIsDeleted())
    {
        $errorString = "'".$ProductID."' has been deleted...";
    }
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
        
        <?php
            // Display menu bar
            include 'includes/categorybox.php.inc';
        ?>
            <div id="contentBox">
                <?php if (!isset($errorString)): // Display page if no erros ?>
                <div id="leftColumn">
            	<!-- Image slider code goes in here -->
            	<div id="sliderFrame">
        			<div id="slider">
                		<?php
                                // Loop through images in databse and dispaly

                                $query = "SELECT ImagePath FROM PICTURE WHERE ProductFK ='".$product->getProductID()."';";
                                // Execute query
                                $result = $dataConnection->query($query);

                                // If query successfull
                                if ($result !== false)
                                {
                                    // If paths returned draw images
                                    if ($result->num_rows > 0)
                                    {
                                        // Loop through each row and draw image
                                        while ($row = $result->fetch_assoc())
                                        {
                                            echo '<img src="'.$row['ImagePath'].'" alt=""/>';
                                        }
                                    }
                                    else
                                    {
                                        // TODO: add the the "no-image" image.
                                    }
                                }
                                ?>
            			
                        
        			</div>
    			</div> 
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
                    <button type="button" onclick="window.history.back()" class="formCSSButtonButton">Back</button>
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