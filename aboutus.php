<?php
// Global includes
require 'includes/globalheader.php';
$contactUs = new ContactUs();

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars - About us</title>
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
        			<div id="htmlcaption" style="display: none;">
            			<em>HTML</em> caption. Link to <a href="http://www.google.com/">Google</a>.
        			</div>
    			</div> 
            </div>
                
            <div id="rightColumn">
                <h1>About us</h1>
                <?php
                    // include the about us blurb
                    include $contactUs->get_blurb_path();
                ?>
                <h2>Contact</h2>
                <p>Virgin Guitars can be contacted by:</p>
                <div class="contactField"><label>Email:</label> <a href="<?php echo $contactUs->get_contact_email(); ?>"><?php echo $contactUs->get_contact_email(); ?></a></div>
                <div class="contactField"><label>Telephone:</label> <?php echo $contactUs->get_contact_telephone(); ?></div>
                <div class="contactField"><label>Mail:</label> <?php echo $contactUs->get_contact_address_line1(); ?></div>
                <div class="contactField"><label></label> <?php echo $contactUs->get_contact_address_line2(); ?></div>
                <div class="contactField"><label></label> <?php echo $contactUs->get_contact_address_line3(); ?></div>
            </div>
            
            <h4>Social Media</h4>
            <div class="socialMediaIcon" id="facebookIcon">
            	<a href="<?php echo $contactUs->get_facebook_url(); ?>">
                	<img src="images/socialmedia/facebookIcon.png" alt="facebook" width="40"/>
                </a>
            </div>
            <div class="socialMediaIcon" id="twitterIcon">
                <a href="<?php echo $contactUs->get_twitter_url(); ?>">
                	<img src="images/socialmedia/twitterIcon.png" alt="facebook" width="40"/>
                </a>
            </div>
            <div class="socialMediaIcon" id="youtubeIcon">
            	<a href="<?php echo $contactUs->get_youtube_url(); ?>">
                	<img src="images/socialmedia/youtubeIcon.png" alt="facebook" width="40"/>
                </a>
            </div>
            
            <h4 style="margin-bottom:0px;">Privacy/Security Policy</h4>
            <?php echo $contactUs->getPrivacyBlurb(); ?>
            
            
        
        </div>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
            
        </div>
</body>
</html>
