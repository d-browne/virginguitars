<?php

/* 
 * This file displays the cart page 
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

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars - Cart</title>
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
        	<h1>Cart</h1>
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
                    <?php
                    // Query cart and display each row
                    // Create data connection
                    $database = new Database();
                    $dataConnection = $database->getDataConnection();
                    
                    // Query to get all cart items for this signed in member
                    $query = "SELECT * FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."';";
                    
                    // Execute query 
                    $result = $dataConnection->query($query);
                    
                    // Check if query successfull 
                    if ($result !== false)
                    {
                        // Check that there are items in the cart
                        if ($result->num_rows > 0)
                        {
                            // Loop through each row retruned and draw table
                            $isAltRow = false;
                            while($row = $result->fetch_assoc())
                            {
                                if ($isAltRow)
                                {
                                    echo '<tr class="altRow">';
                                    $isAltRow = false;
                                }
                                else
                                {
                                    echo '<tr>';
                                    $isAltRow = true;
                                }
                                
                                // Draw image
                                echo '<td><img src="'.$row['PrimaryPicturePath'].'" alt="'.$row['Description'].'" width="100"/></td>';
                                
                                
                                // Close row
                                echo '</tr>';
                            }
                        }
                        else
                        {
                            echo "The cart is empty";
                        }
                    }
                    else
                    {
                        echo "Error querying for cart";
                    }
                    ?>
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
            
            <div id="totalLabelStretcher"></div>
            <div id="totalLabel">Total: 2828.75</div>
            <a href="checkout.html"><div id="checkoutButton">Checkout</div></a>
            
        </div>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
        </div>
</body>
</html>
