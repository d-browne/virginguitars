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
$customer->initializeID($result->fetch_assoc()['CustomerFK']);

// create order object
require_once 'classes/Order.php';
$order = new Order($SalesOrderID);

?>

<div id="contentBox">
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
                    <input type="text" placeholder="e.g. 123 Fake Street" value="<?php echo $order->getStreetAddress(); ?>"/>
                </td>
                <td>
                    <input type="text" placeholder="Sydney" value="<?php echo $order->getCity(); ?>"/>
                </td>
                <td>
                    <input type="text" placeholder="e.g. NSW" value="<?php echo $order->getState(); ?>" />
                </td>
                <td>
                    <input type="text" placeholder="e.g. 2000" value="<?php echo $order->getPostCode(); ?>"/>
                </td>
                <td>
                    <input type="text" placeholder="Australia" value="<?php echo $order->getCountry(); ?>"/>
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
                    <input type="date" value="<?php echo $order->getShippedDate(); ?>" />
                </td>
                <td>
                    <input type="text" placeholder="TN: 234823406" value="<?php echo $order->getShippingRecord(); ?>"/>
                </td>
                <td>
                    <select>
                        <option <?php if($order->getOrderStatus() === "Requested") {echo "selected";} ?>>Requested</option>
                        <option <?php if($order->getOrderStatus() === "Processing") {echo "selected";} ?>>Processing</option>
                        <option <?php if($order->getOrderStatus() === "Shipped") {echo "selected";} ?>>Shipped</option>
                        <option <?php if($order->getOrderStatus() === "Completed") {echo "selected";} ?>>Completed</option>
                        <option> <?php if($order->getOrderStatus() === "Cancelled") {echo "selected";} ?>Cancelled</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>

    <div id="manageCustomersStretcher"></div>
    <div id="bottomButtonsBox">

        <form action="admin.php?back"><button class="formCSSButtonButton">Update</button></form>
        <form action="admin.php?back"><button class="formCSSButtonButton">Back</button></form>
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
        <tr>
            <td>
                <img src="images/guitars/fenderLimitedEditionAmericanStandardTelecaster/1.jpg" width="100" alt="American Standard Strat" />
            </td>
            <td>
                <a href="admin.php">
                    American Standard Stat
                </a>
            </td>
            <td>
                <a href="admin.php">
                    1
                </a>
            </td>
            <td>
                <a href="admin.php">
                    1
                </a>
            </td>
            <td>
                <a href="admin.php">
                    $1000
                </a>
            </td>
            <td>
                <a href="admin.php">
                    $50
                </a>
            </td>
            <td>
                <a href="admin.php">
                    $1050
                </a>
            </td>
        </tr>
    </table>
</div>