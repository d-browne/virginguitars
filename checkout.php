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
                    <?php
                    // Query cart and display each row

                    // Query to get all cart items for this signed in member
                    $query = "SELECT * FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."' AND isDeleted='0' AND Status<>'Out Of Stock';";
                    
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
                                echo '<td><a href="product.php?id='.$row['ProductID'].'"><img src="'.$row['PrimaryPicturePath'].'" alt="'.$row['Description'].'" width="100"/></a></td>';
                                // Draw description
                                echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Description'].'</a></td>';
                                // Draw product id
                                echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>';
                                // Draw Quantity
                                echo '<form action="cart.php" method="POST"><td><input type="text" style="width: 4em;" name="numberOfItems" value="'.$row['Quantity'].'" /></a></td><input type="hidden" name="ProductID" value="'.$row['ProductID'].'" /><button type="submit" name="updateCart" hidden="true" /></form>';
                                // Draw price
                                echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Price'].'</a></td>';
                                // Draw total
                                echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Total'].'</a></td>';
                                // Draw del
                                echo '<td><a href="cart.php?delete='.$row['ProductID'].'"><span class="delButton">Del</span></a></td>';
                                
                                // Close row
                                echo '</tr>';
                            }
                        }
                        else
                        {
                            echo "</table>The cart is empty";
                        }
                    }
                    else
                    {
                        echo "</table>Error querying for cart";
                    }
                    ?>
                    
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
                            <?php //<div><label>Method:</label> Bitcoin <input type="radio" name="payment" /> Paypal <input type="radio" name="payment" checked/></div> ?>
                            <div><label>Paypal Email: </label><input type="text" /></div>
                            
                           	<div id="payButton">Pay</div>
                        </fieldset>
                    </div>
                </div>
                
                
                
        </div>
        
        	<div id="summaryDetailsBox">
                        <form action="cart.php"><button class="formCSSButtonButton" style="left: 0.5em;">Back</button></form>
            	<div id="shippingLabel">Shipping: $
                    <?php // Get total
                    // Query to calculate total
                    $query = "SELECT SUM(Quantity)*50 As 'Sumtotal' FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."' AND isDeleted='0' AND Status<>'Out Of Stock';";

                    // Execute query
                    $result = $dataConnection->query($query);

                    // if query successfull
                    if ($result !== false)
                    {
                        // Check if result resturned
                        if ($result->num_rows > 0)
                        {
                            // Get first row
                            $row = $result->fetch_assoc();

                            // show the total
                            echo $row['Sumtotal'];
                        }
                        else
                        {
                            echo "0";
                        }
                    }
                    else
                    {
                        // Error querying for total
                        echo "ERR";
                    }
                    ?>
                    </div>
            	<div id="totalLabel">Total: $
                    <?php // Get total
                    // Query to calculate total
                    $query = "SELECT SUM(Total)+SUM(Quantity)*50 As 'Sumtotal' FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."' AND isDeleted='0' AND Status<>'Out Of Stock';";

                    // Execute query
                    $result = $dataConnection->query($query);

                    // if query successfull
                    if ($result !== false)
                    {
                        // Check if result resturned
                        if ($result->num_rows > 0)
                        {
                            // Get first row
                            $row = $result->fetch_assoc();

                            // show the total
                            echo $row['Sumtotal'];
                        }
                        else
                        {
                            echo "0";
                        }
                    }
                    else
                    {
                        // Error querying for total
                        echo "ERR";
                    }
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
