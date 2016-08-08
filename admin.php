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
        <?php
            // Check if admin is logged in
            // If admin is logged in display (include) admin control panel
            // Otherwise display (include) admin login page
        ?>
        	<h1>Admin Area</h1>
            
            <div id="signInBoxAdmin">
            <fieldset class="signInFieldSet">
                <legend>Sign in</legend>
                	<div><label>Email:</label><span class="inputSpan"><input type="text" class="inputTextBox" /></span></div>
                    <div><label>Password:</label><span class="inputSpan"><input type="password" class="inputTextBox" /></span></div>
                    <div><label>Remmeber:</label><input type="checkbox" name="remember" checked/></div>
                    <a href="adminControlPanel.html"><div class="formCSSButton">Sign in</div></a>
                </fieldset>
            </div>
        </div>
            <footer id="pageFooter">Copyright © 2015 <a href="mailto:admin@virginguitars.com">Virgin Guitars</a></footer>
            
        </div>
</body>
</html>
