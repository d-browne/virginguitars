<?php
// Global includes
require 'includes/globalheader.php';

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
    			</div> 
            </div>
                
            <div id="rightColumn">
                <h1>Ultimate Guitar Fantasies</h1>
                <p>Welcome to Virgin Guitars where you will find a range of quality guitars that are new or have been well maintained throughout their life. While the age of a guitar does not necessarily reflect the condition of the instrument, its appearance and playability is often as important to the performing musician as the tone it produces.</p>
                <p>Guitarists who are passionate about their music tend to have a ‘romantic’ relationship with their instrument and will not settle for second best. Each guitar has been carefully examined by our resident luthier. Any cosmetic blemishes are removed or noted and playability issues corrected. Frets are leveled and dressed, the body polished and the instrument set up to the manufacturer’s specifications.</p>
                <h2>See what we have to offer</h2>
                <p>All guitars are realistically priced to reflect their allure and playability. Please examine our range and do not hesitate to contact us for further information or comment.</p>
            </div>
            
            
        
        </div>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
            
        </div>
</body>
</html>
