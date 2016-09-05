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
    	<div id="headerBox">
        	<a href="index.html"><img src="images/logo.png" width="213" height="200" alt="Virgin Guitars" class="logoImage"></a>
			<h1 class="mainHeader">Virgin Guitars</h1>
            <form action="search.html">
            	<input type="text" id="searchBox" placeholder="Site Search..." />
             </form>
        	
            <div id="checkOutBox">
            	<span id="cartItems"><a href="cart.html">4</a></span>
            	<a href="cart.html"><img src="images/cartIcon.png" id="cartIcon" width="32" height="42" alt="Cart"></a>
                <a href="checkout.html" id="checkoutLink">checkout</a>
            </div>
      </div>
        
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
                <?php
                    // Display faq from faq data file
                    include 'includes/faq_data.html';
                ?>
                
            </div>
        </div>
            <footer id="pageFooter">Copyright © 2015 <a href="mailto:admin@virginguitars.com">Virgin Guitars</a></footer>
            
        </div>
</body>
</html>
