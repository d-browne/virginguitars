<?php
/*
 * Virgin Guitars E-Commerce website 2016
 * Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * The purpose of this include is to display a from where a specific order can be edited
 * 
 * Author: Dominic Browne
 */

// get the customer
require_once 'classes/Customer.php';
$customer = new Customer();

// Initialize from id
$customerIdRow = $result->fetch_assoc();

$customer->initializeID($customerIdRow['CustomerFK']);

// create order object
require_once 'classes/Order.php';
$order = new Order($SalesOrderID);

?>

<div id="contentBox">
    <form action="admin.php" method="POST">
    <input type="hidden" name="orderid" value="<?php echo $order->getSalesOrderID(); ?>" />
    <div id="manageCustomersTopLeft">
        <h1>Edit Order</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Customer</legend>
            <div class="inputField"><label>Customer.ID:</label> <input class="textBox" name="customerid" type="text" value="<?php echo $customer->getCustomerID(); ?>" disabled="true"/></div>
            <div class="inputField"><label>First Name:</label> <input class="textBox" name="firstname" type="text" value="<?php echo $customer->getFirstName(); ?>" disabled="true"/></div>
            <div class="inputField"><label>Last Name:</label> <input class="textBox" name="lastname" type="text" value="<?php echo $customer->getLastName(); ?>" disabled="true"/></div>
            <div class="inputField"><label>Email:</label> <input class="textBox" name="email" type="email" value="<?php echo $customer->getEmail(); ?>" disabled="true"/></div>
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
                    <input type="text" name="streetaddress" placeholder="e.g. 123 Fake Street" value="<?php echo $order->getStreetAddress(); ?>"/>
                </td>
                <td>
                    <input type="text" name="city" placeholder="Sydney" value="<?php echo $order->getCity(); ?>"/>
                </td>
                <td>
                    <input type="text" name="state" placeholder="e.g. NSW" value="<?php echo $order->getState(); ?>" />
                </td>
                <td>
                    <input type="text" name="postcode" placeholder="e.g. 2000" value="<?php echo $order->getPostCode(); ?>"/>
                </td>
                <td>
                    <input type="text" name="country" placeholder="Australia" value="<?php echo $order->getCountry(); ?>"/>
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
                    <span class="tableText"><?php echo $order->getTotal(); ?></span>
                </td>
                <td>
                    <input type="text" name="shippeddate" placeholder="yyyy-mm-dd" value="<?php echo $order->getShippedDate(); ?>" />
                </td>
                <td>
                    <input type="text" name="shippingrecord" placeholder="TN: 234823406" value="<?php echo $order->getShippingRecord(); ?>"/>
                </td>
                <td>
                    <select name="orderstatus">
                        <option value="Requested" <?php if($order->getOrderStatus() === "Requested") {echo "selected";} ?>>Requested</option>
                        <option value="Processing" <?php if($order->getOrderStatus() === "Processing") {echo "selected";} ?>>Processing</option>
                        <option value="Shipped" <?php if($order->getOrderStatus() === "Shipped") {echo "selected";} ?>>Shipped</option>
                        <option value="Completed" <?php if($order->getOrderStatus() === "Completed") {echo "selected";} ?>>Completed</option>
                        <option value="Cancelled" <?php if($order->getOrderStatus() === "Cancelled") {echo "selected";} ?>>Cancelled</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>

    <div id="manageCustomersStretcher"></div>
    <div id="bottomButtonsBox">

        <button type="submit" class="formCSSButtonButton" name="updateOrderButton">Update</button>
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
        <button class="formCSSButtonButton" onclick="back()">Back</button>
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
                    echo '<td><img src="'.$row['PrimaryPicturePath'].'" alt="'.$row['Description'].'" width="100" /></td>';
                    // Draw Model column
                    echo '<td><a href="admin.php">'.$row['Description'].'</a></td>';
                    // Draw Product ID column
                    echo '<td><a href="admin.php">'.$row['ProductID'].'</a></td>';
                    // Draw Quantity column
                    echo '<td><a href="admin.php">'.$row['Quantity'].'</a></td>';
                    // Draw Price
                    echo '<td><a href="admin.php">$'.$row['SubTotal'].'</a></td>';
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
    <br />
    </form>
</div>