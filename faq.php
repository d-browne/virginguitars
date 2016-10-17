<?php
// Global includes
require 'includes/globalheader.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars - FAQ</title>
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
            
            <div id="leftColumn">
            	<!-- Image slider code goes in here -->
            	<div id="sliderFrame">
        			<div id="slider">
                			<img src="images/guitars/jacksonDk2DinkyHotRodFlames/resized2.jpg" alt=""/>
                			<img src="images/guitars/bcRichKerryKingMetalMasterTribalFireWarlock/resized6.jpg" alt=""/>
                			<img src="images/guitars/gibsonLesPaultStudio/resized3.jpg" alt=""/>
                			<img src="images/guitars/fenderSquireMijStratocaster/resized2.jpg" alt=""/>
                			<img src="images/guitars/jacksonKvmgProSeriesKingV/resized3.jpg" alt=""/>
                			<img src="images/guitars/bcRichMockingBirdProX/resized3.jpg" alt=""/>
                			<img src="images/guitars/gibsonEpiphoneLimitedEditionLesPaulCustom/resized3.jpg" alt=""/>
                			<img src="images/guitars/fenderAmericanStandardStratocaster/resized2.jpg" alt=""/>
                			<img src="images/guitars/jacksonPdx2DemmelitionKingV/resized7.jpg" alt=""/>
                			<img src="images/guitars/bcRichMockingbirdSt/resized3.jpg" alt=""/>
        			</div>
        			<div id="htmlcaption" style="display: none;">
            			<em>HTML</em> caption. Link to <a href="http://www.google.com/">Google</a>.
        			</div>
    			</div> 
            </div>
                
            <div id="rightColumn">
                <?php
                    // Display faq from faq data file
                    include 'includes/faq_data.html';
                ?>
                
            </div>
        </div>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
            
        </div>
</body>
</html>
