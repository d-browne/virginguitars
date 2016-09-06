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
        
        <div id="categoryBox">
        	<a href="fender.html"><div class="categoryImage" id="fenderCategory"></div></a>
            <a href="gibson.html"><div class="categoryImage" id="gibsonCategory"></div></a>
            <a href="bcrich.html"><div class="categoryImage" id="bcRichCategory"></div></a>
            <a href="jackson.html"><div class="categoryImage" id="jacksonLogo"></div></a>
            
        </div>
        
        <div id="contentBox">
            
            <div id="leftColumn">
            	<!-- Image slider code goes in here -->
            	<div id="sliderFrame">
        			<div id="slider">
                		<a href="jackson_dk2_dinky_hot_rod_flames.html">
                			<img src="images/guitars/jacksonDk2DinkyHotRodFlames/resized2.jpg" alt=""/>
                        </a>
                        <a href="bc_rich_kerry_king_metal_master_tribal_fire_warlock.html">
                			<img src="images/guitars/bcRichKerryKingMetalMasterTribalFireWarlock/resized6.jpg" alt=""/>
                        </a>
                        <a href="gibson_les_paul_studio.html">
                			<img src="images/guitars/gibsonLesPaultStudio/resized3.jpg" alt=""/>
                        </a>
                        <a href="fender_squire_mij_stratocaster.html">
                			<img src="images/guitars/fenderSquireMijStratocaster/resized2.jpg" alt=""/>
                        </a>
                        <a href="jackson_kvmg_pro_series_king_v.html">
                			<img src="images/guitars/jacksonKvmgProSeriesKingV/resized3.jpg" alt=""/>
                        </a>
                        <a href="bc_rich_mockingbird_pro.html">
                			<img src="images/guitars/bcRichMockingBirdProX/resized3.jpg" alt=""/>
                        </a>
                        <a href="gibson_epiphone_limited_edition_les_paul_custom.html">
                			<img src="images/guitars/gibsonEpiphoneLimitedEditionLesPaulCustom/resized3.jpg" alt=""/>
                        </a>
                        <a href="fender_american_standard_stratocaster.html">
                			<img src="images/guitars/fenderAmericanStandardStratocaster/resized2.jpg" alt=""/>
                        </a>
                        <a href="jackson_pdx2_demmelition_king_v.html">
                			<img src="images/guitars/jacksonPdx2DemmelitionKingV/resized7.jpg" alt=""/>
                        </a>
                        <a href="bc_rich_mockingbird_st.html">
                			<img src="images/guitars/bcRichMockingbirdSt/resized3.jpg" alt=""/>
                        </a>
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