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

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

// Hold error and success strings
$successString = "";
$errorString = "";

// "Add Cart" button click on product.php page
if (isset($_POST['addCartButton']))
{
    // Sanitize input
    $addProductID = mysqli_real_escape_string($dataConnection, $_POST['addCartButton']);
    
    // Create cart object
    $cart = new Cart($_SESSION["currentCustomer"]->getCustomerID());
    
    // Add product to cart
    $addToCartResult = $cart->addToCart($addProductID);
    
    // set success message if successful
    if ($addToCartResult === true)
    {
        $successString = $successString."Product '".$addProductID."' added to cart";
    }
    else
    {
        $errorString = $errorString.$addToCartResult.", ";
    }
}

// Handle delete button clicked
if (isset($_GET['delete']))
{
    // Sanitize input
    $deleteID = mysqli_real_escape_string($dataConnection, $_GET['delete']);
    
    // Create cart object
    $cart = new Cart($_SESSION["currentCustomer"]->getCustomerID());
    
    // Delete item from cart
    $deleteResult = $cart->delItem($deleteID);
    
    // set success or error message
    if ($deleteResult === true)
    {
        $successString = $successString."Product '".$deleteID."' deleted from cart";
    }
    else
    {
        $errorString = $errorString.$deleteResult.", ";
    }
}

// Check for update number of items in cart
if (isset($_POST['updateCart']))
{
    // Check if productid and desired number of items recieved
    if (isset($_POST['ProductID']) && isset($_POST['ProductID']))
    {
        // Create cart object
        $cart = new Cart($_SESSION["currentCustomer"]->getCustomerID());
        
        // Get id of item to be updated and it's desired new number of items
        $CartProductID = mysqli_real_escape_string($dataConnection, $_POST['ProductID']);
        $numberOfItems = mysqli_real_escape_string($dataConnection, $_POST['numberOfItems']);
        
        // Update the cart
        $updateCartResult = $cart->setQuantity($CartProductID, $numberOfItems);
        if($updateCartResult === true)
        {
            // Display success message
            $successString = $successString."Updated product '".$CartProductID."' quantity to: '".$numberOfItems."', ";
        }
        else
        {
            $errorString = $errorString.$updateCartResult.", ";
        }
    }
    else
    {
        $errorString = $errorString.", unable to update item in cart";
    }
    
    
    
    
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
                <p><span id="updatedMemberLabel"><?php echo $successString; ?></span> <span id="updatedMemberErrorLabel"><?php echo $errorString; ?></span></p>
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
            
            <div id="totalLabelStretcher"></div>
            <div id="totalLabel">Total: $
            <?php // Get total
            // Query to calculate total
            $query = "SELECT SUM(Total) As 'Sumtotal' FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."' AND isDeleted='0' AND Status<>'Out Of Stock';";
            
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
            <a href="checkout.html"><div id="checkoutButton">Checkout</div></a>
            
        </div>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
        </div>
</body>
</html>
