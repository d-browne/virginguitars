<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Include global header
include 'includes/globalheader.php';

require_once 'classes/Database.php'; // Include the database

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

$errorString = ''; // Contain error string

// If member is not signed in redirect to sign in page
if ($_SESSION["currentCustomer"]->getIsInitialized() !== true)
{
    header('Location: members.php');
}

// Hold the error
$errorString = '';

// Check if id is set
if (isset($_GET['id']))
{
    // Sanitize the order id
    $orderId = mysqli_real_escape_string($dataConnection, $_GET['id']);
    
    // Check if order exists

    // Query for the specified order
    $orderQuery = "SELECT * FROM PRODUCTS_BY_ORDER_VIEW WHERE SalesOrderFK ='".$orderId."' AND CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."';";
    
    //echo $orderQuery; //debug
    
    // Execute query
    $orderQueryResult = $dataConnection->query($orderQuery);
    
    // Check if no errors
    if ($orderQueryResult !== false)
    {
        // Check if results returned
        if ($orderQueryResult->num_rows > 0)
        {
            // Contruct order object
            $order = new Order($orderId);
        }
        else
        {
            // Order not found error
            $errorString = "Order '".$orderId."' not found...";
        }
    }
    else
    {
        // Query error
        $errorString = "Query Error";
    }
}
else
{
    $errorString = 'ID must be specified';
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Order</title>
<link href="styles/main.css" rel="stylesheet" type="text/css">
<link href="styles/js-image-slider.css" rel="stylesheet" type="text/css" />
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
    <form action="admin.php" method="POST">
    <div id="manageCustomersTopLeft">
        <h1>View Order</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Customer</legend>
            <div class="inputField"><label>Customer.ID:</label> <input class="textBox" name="customerid" type="text" value="<?php echo $_SESSION["currentCustomer"]->getCustomerID(); ?>" disabled="true"/></div>
            <div class="inputField"><label>First Name:</label> <input class="textBox" name="firstname" type="text" value="<?php echo $_SESSION["currentCustomer"]->getFirstName(); ?>" disabled="true"/></div>
            <div class="inputField"><label>Last Name:</label> <input class="textBox" name="lastname" type="text" value="<?php echo $_SESSION["currentCustomer"]->getLastName(); ?>" disabled="true"/></div>
            <div class="inputField"><label>Email:</label> <input class="textBox" name="email" type="email" value="<?php echo $_SESSION["currentCustomer"]->getEmail(); ?>" disabled="true"/></div>
        </fieldset>
    </div>
    <div id="tableContainer">
        <table class="cartTable" border="1" >
            <tr class="headerRow">
                <td><span class="tableHeader">Street</span></td>
                <td><span class="tableHeader">City</span></td>
                <td><span class="tableHeader">State</span></td>
                <td><span class="tableHeader">Post Code</span></td>
                <td><span class="tableHeader">Country</span></td>

            </tr>
            <tr>
                <td>
                    <input type="text" name="streetaddress" placeholder="e.g. 123 Fake Street" value="<?php echo $order->getStreetAddress(); ?>" disabled="true"/>
                </td>
                <td>
                    <input type="text" name="city" placeholder="Sydney" value="<?php echo $order->getCity(); ?>" disabled="true"/>
                </td>
                <td>
                    <input type="text" name="state" placeholder="e.g. NSW" value="<?php echo $order->getState(); ?>" disabled="true"/>
                </td>
                <td>
                    <input type="text" name="postcode" placeholder="e.g. 2000" value="<?php echo $order->getPostCode(); ?>" disabled="true"/>
                </td>
                <td>
                    <input type="text" name="country" placeholder="Australia" value="<?php echo $order->getCountry(); ?>" disabled="true"/>
                </td>
            </tr>
        </table>
        <table class="cartTable" border="1" >
            <tr class="headerRow">
                <td><span class="tableHeader">Order.ID</span></td>
                <td><span class="tableHeader">Invoice Date</span></td>
                <td><span class="tableHeader">Subtotal</span></td>
                <td><span class="tableHeader">Shipping</span></td>
                <td><span class="tableHeader">Total Cost</span></td>
                <td><span class="tableHeader">Shipped Date</span></td>
                <td><span class="tableHeader">Shipping Record</span></td>
                <td><span class="tableHeader">Order Status</span></td>
            </tr>
            <tr>
                <td>
                    <span class="tableText"><?php echo $order->getSalesOrderID(); ?></span>
                </td>
                <td>
                    <span class="tableText"><?php echo $order->getInvoiceDate(); ?></span>
                </td>
                <td>
                    <span class="tableText"><?php echo $order->getSubTotal(); ?></span>
                </td>
                <td>
                    <span class="tableText"><?php echo $order->getShipping(); ?></span>
                </td>
                <td>
                    <span class="tableText greenLink"><?php echo $order->getTotal(); ?></span>
                </td>
                <td>
                    <span class="tableText"><?php echo $order->getShippedDate(); ?></span>
                    <?php /*<input type="text" name="shippeddate" placeholder="yyyy-mm-dd" value="<?php echo $order->getShippedDate(); ?>" /> */?>
                </td>
                <td>
                    <span class="tableText"><?php echo $order->getShippingRecord(); ?></span>
                    <?php /*<input type="text" name="shippingrecord" placeholder="TN: 234823406" value="<?php echo $order->getShippingRecord(); ?>"/> */?>
                </td>
                <td>
                    <?php
                        // Check the order status to get color
                        switch ($order->getOrderStatus())
                        {
                            case "Shipped":
                                $orderColor = "greenLink";
                                break;
                            case "Completed":
                                $orderColor = "greenLink";
                                break;
                            case "Requested": 
                                $orderColor = "orangeLink";
                                break;
                            case "Processing":
                                $orderColor = "orangeLink";
                                break;
                            case "Cancelled":
                                $orderColor = "redLink";
                                break;
                            default:
                                $orderColor = "";
                        }
                        echo '<span class="tableText '.$orderColor.'">'.$order->getOrderStatus().'</span>';
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <div id="manageCustomersStretcher"></div>
    <div id="bottomButtonsBox">

        <?php //<button type="submit" class="formCSSButtonButton" name="updateOrderButton">Update</button> ?>
        <script> 
            function back() 
            { 
                <?php
                // Will cause the browser to go back
                // In the event javascript is disabled
                // or the browser doesn't support javascript
                // the back button will return the user to 
                // the admin panel
                ?>
                window.history.back(); 
            } 
        </script>
        <button type="button" class="formCSSButtonButton" onclick="back()">Back</button>
    </div>

    <h2 id="productsHeader">Products</h2>

    <table class="cartTable bottomTable" border="1" >
        <tr class="headerRow">
            <td><span class="tableHeader">Image</span></td>
            <td><span class="tableHeader">Model</span></td>
            <td><span class="tableHeader">Prod.ID</span></td>
            <td><span class="tableHeader">Quantity</span></td>
            <td><span class="tableHeader">Price</span></td>
            <td><span class="tableHeader">Shipping</span></td>
            <td><span class="tableHeader">Total</span></td>
        </tr>
        <?php
        // Loop draw a table row for each product in this order
        
        // Query to get products in order
        $query = "SELECT * FROM PRODUCTS_BY_ORDER_VIEW WHERE SalesOrderFK='".$order->getSalesOrderID()."';";
        
        // Execute query
        $result = $dataConnection->query($query);
        
        if ($result !== false)
        {
            // Check that products are returned
            if ($result->num_rows > 0) 
            {
                // Print each row
                $isAltRow = false;
                while ($row = $result->fetch_assoc())
                {
                    // start row
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
                    
                    // Draw image column
                    echo '<td><a href="'.$row['PrimaryPicturePath'].'"><img src="'.$row['PrimaryPicturePath'].'" alt="'.$row['Description'].'" width="70"/></a></td>';
                    // Draw Model column
                    echo '<td><a href="admin.php">'.$row['Description'].'</a></td>';
                    // Draw Product ID column
                    echo '<td><a href="admin.php">'.$row['ProductID'].'</a></td>';
                    // Draw Quantity column
                    echo '<td><a href="admin.php">'.$row['Quantity'].'</a></td>';
                    // Draw Price
                    echo '<td><a href="admin.php">$'.$row['UnitPrice'].'</a></td>';
                    // Draw Shipping
                    echo '<td><a href="admin.php">$'.$row['TotalShipping'].'</a></td>';
                    // Draw Total price
                    echo '<td><a href="admin.php">$'.$row['Total'].'</a></td>';
                    
                    // End row
                    echo '</tr>';
                }
            }
        }
        else
        {
            // Display error that query could could execute
            echo "Error querying for order products";
        }
        ?>
    </table>
    <div id="totalLabelStretcher" class="editOrderTotalLabelStretcher"><div id="totalLabel" class="editOrderTotalLabel">Total: <?php echo $order->getTotal(); ?></div></div>
    
    </form>
</div>
            
            
                    </div>
</body>
</html>