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

$deliveryAddress = "";

// Query to get order address
$query = $query = "SELECT * FROM DELIVERY_ADDRESS_BY_ORDER_ID WHERE SalesOrderID=".$SalesOrderID;

// Execute Query
$result = $dataConnection->query($query);
if ($result !== false)
{
    if ($result->num_rows > 0)
    {
        $deliveryAddress = $result->fetch_assoc();
    }
}

?>

<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Edit Order</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Customer</legend>
            <div class="inputField"><label>Customer.ID:</label> <input class="textBox" name="customerid" type="text" value="<?php echo $customer->getCustomerID(); ?>" disable="true"/></div>
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
                <td><span class="tableHeader">Post code</span></td>
                <td><span class="tableHeader">Country</span></td>

            </tr>
            <tr>
                <td>
                    <input type="text" placeholder="e.g. 123 Fake Street" value="<?php echo $deliveryAddress['StreetAddress']; ?>"/>
                </td>
                <td>
                    <input type="text" placeholder="Sydney" />
                </td>
                <td>
                    <input type="text" placeholder="e.g. NSW" />
                </td>
                <td>
                    <input type="text" placeholder="e.g. 2000" />
                </td>
                <td>
                    <input type="text" placeholder="Australia" />
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
                    <a href="admin.php">
                        1
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        2016-6-11
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        $666
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        $333
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        $1000
                    </a>
                </td>
                <td>
                    <input type="date" value="2016-6-13" />
                </td>
                <td>
                    <input type="text" placeholder="TN: 234823406" />
                </td>
                <td>
                    <select>
                        <option>Requested</option>
                        <option>Processing</option>
                        <option>Shipped</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
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