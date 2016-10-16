<?php

/*
 * Virgin Guitars E-Commerce website 2016
 * Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * checkout.php
 * The purpose of this page is to display the checkout page, simlar to the cart
 * but allows user user to input shipping and payment details. 
 * 
 * Author: Dominic Browne
 */

// Include the global header
include "includes/globalheader.php";

// Include the database
require_once 'classes/Database.php';

// if member is not signed in redirect to member signin page
if ($_SESSION["currentCustomer"]->getIsInitialized() != true)
{
    header("Location: members.php");
}

// Refresh cart
$cart = new Cart($_SESSION["currentCustomer"]->getCustomerID());
$cart->refreshQuantity();

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars - Checkout</title>
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
        	<h1>Checkout</h1>
            <div id="tableContainer">
                <table class="cartTable" border="1">
                    <tr class="headerRow">
                        <td></td>
                        <td><span class="tableHeader">Description</span></td>
                        <td><span class="tableHeader">Prod.ID</span></td>
                        <td><span class="tableHeader">Quantity</span></td>
                        <td><span class="tableHeader">Price</span></td>
                        <td><span class="tableHeader">Total</span></td>
                        <td><span class="tableHeader">Del</span></td>
                    </tr>
                    <tr>
                        <td>
                        	<a href="images/guitars/jacksonDk2DinkyHotRodFlames/1.jpg">
                        		<img src="images/guitars/jacksonDk2DinkyHotRodFlames/1.jpg" alt="Jackson DK2 Dinky Hot Rod Flames" width="100"/>
                            </a>
                        </td>
                        <td>
                        	<a href="jackson_dk2_dinky_hot_rod_flames.html">
                            	Jackson DK2 Dinky Hot Rod Flames
                            </a>
                        </td>
                        <td>234</td>
                        <td>1</td>
                        <td>AU $970.34</td>
                        <td>AU $970.34</td>
                        <td><span class="delButton">Del</span></td>
                    </tr>
                    <tr class="altRow">
                        <td>
                        	<a href="images/guitars/bcRichKerryKingMetalMasterTribalFireWarlock/1.jpg">
                        		<img src="images/guitars/bcRichKerryKingMetalMasterTribalFireWarlock/1.jpg" alt="Kerry King Metal Master Tribal Fire Warlock" width="100"/>
                            </a>
                        </td>
                        <td>
                        	<a href="bc_rich_kerry_king_metal_master_tribal_fire_warlock.html">
                            	Kerry King Metal Master Tribal Fire Warlock
                            </a>
                        </td>
                        <td>134</td>
                        <td>1</td>
                        <td>AU $420.89</td>
                        <td>AU $420.89</td>
                        <td><span class="delButton">Del</span></td>
                    </tr>
                    <tr>
                        <td>
                        	<a href="images/guitars/gibsonEpiphoneLimitedEditionLesPaulCustom/1.jpg">
                        		<img src="images/guitars/gibsonEpiphoneLimitedEditionLesPaulCustom/1.jpg" alt="Gibson Epiphone Limited Edition Les Paul Custom" width="100"/>
                            </a>
                        </td>
                        <td>
                        	<a href="gibson_epiphone_limited_edition_les_paul_custom.html">
                            	Gibson Epiphone Limited Edition Les Paul Custom
                            </a>
                        </td>
                        <td>34</td>
                        <td>1</td>
                        <td>AU $635.25</td>
                        <td>AU $635.25</td>
                        <td><span class="delButton">Del</span></td>
                    </tr>
                    <tr class="altRow">
                        <td>
                        	<a href="images/guitars/fenderAmericanStandardStratocaster/1.jpg">
                        		<img src="images/guitars/fenderAmericanStandardStratocaster/1.jpg" alt="American Standard Stratocaster" width="100"/>
                            </a>
                        </td>
                        <td>
                        	<a href="fender_american_standard_stratocaster.html">
                            	American Standard Stratocaster
                            </a>
                        </td>
                        <td>12</td>
                        <td>1</td>
                        <td>AU $802.27</td>
                        <td>AU $802.27</td>
                        <td><span class="delButton">Del</span></td>
                    </tr>
                    
                </table>
            </div>
            
            <div id="formsContainer">
                <div id="leftForm" class="formDiv">
                        <fieldset class="checkoutFieldSet" id="checkoutShippingDetails">
                            <legend>Shipping Detials</legend>
                            <div><label>Street Address:</label><input type="text" /></div>
                            <div><label>City:</label><input type="text" /></div>
                            <div><label>Post Code:</label><input type="text" /></div>
                            <div><label>Country:</label><input type="text" /></div>
                            <div><label>Telephone:</label><input type="text" /></div>
                        </fieldset>
                    </div>
                    <div id="rightForm" class="formDiv">
                        <fieldset class="checkoutFieldSet" id="checkoutPaymentMethod">
                            <legend>Payment method</legend>
                            <div><label>Method:</label> Bitcoin <input type="radio" name="payment" /> Paypal <input type="radio" name="payment" checked/></div>
                            <div><label>Paypal Email: </label><input type="text" /></div>
                            
                           	<div id="payButton">Pay</div>
                        </fieldset>
                    </div>
                </div>
                
                
                
        </div>
        
        	<div id="summaryDetailsBox">
                        <form action="cart.php"><button class="formCSSButtonButton" style="left: 0.5em;">Back</button></form>
            	<div id="shippingLabel">Shipping: $200</div>
            	<div id="totalLabel">Total: $3028.75</div>
            </div>
        
        
        
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
            
        </div>
</body>
</html>
