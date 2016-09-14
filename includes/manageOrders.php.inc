<?php
/*
 * Virgin Guitars E-Commerce website 2016
 * Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * The purpose of this include is to display the Manage orders sections of
 * the website and handle any get/post requests to that page. 
 * 
 * Author: Dominic Browne
 */

require_once 'classes/Database.php'; // Include the database

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

?>


<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Manage Orders</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Search</legend>
            <form id="userDetailsForm" action="admin.php?manageCustomers">
                <div class="inputField"><label>Order.ID:</label> <input class="textBox" name="orderid" type="text" placeholder="e.g. 1"/></div>
                <div class="inputField"><label>Invoice Date:</label> <input class="textBox" name="invoicedate" type="text" placeholder="e.g. 2016" value=""/></div>
                <div class="inputField"><label>Shipped Date:</label> <input class="textBox" name="shippeddate" type="text" placeholder="e.g. 12"/></div>
                <div class="inputField"><label>Shipping Record:</label> <input class="textBox" name="shippingrecord" type="text" placeholder="e.g. 23532"/></div>
                <div class="inputField">
                    <label>Order Status:</label> 
                    <select>
                        <option>Requested</option>
                        <option>Processing</option>
                        <option>Shipped</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                    </select>
                </div>
                <div class="inputField"><input class="submitButton" type="submit" name="searchButton" value="Search" /></div>
            </form>
        </fieldset>
    </div>
    <div id="tableContainer">
        <table class="cartTable" border="1" >
            <tr class="headerRow">
                <td><span class="tableHeader tableHeaderAsc"><a href="admin.php">Order.ID</a></span></td>
                <td><span class="tableHeader">Invoice Date</span></td>
                <td><span class="tableHeader">Subtotal</span></td>
                <td><span class="tableHeader tableHeaderDesc"><a href="admin.php">Shipping</a></span></td>
                <td><span class="tableHeader">Total Cost</span></td>
                <td><span class="tableHeader">Shipped Date</span></td>
                <td><span class="tableHeader">Shipping Record</span></td>
                <td><span class="tableHeader">Order Status</span></td>
                <td><span class="tableHeader">Edit</span></td>
            </tr>
            <?php
            // Query database for a list of orders
            
            // Query to get orders
            $query = "SELECT * FROM ORDERS_STATUS";
            
            // Execute query
            $result = $dataConnection->query($query);
            
            // Check if query executed successfully
            if ($result !== false)
            {
                // Check if results found (orders exist)
                if ($result->num_rows > 0)
                {
                    // Print the rows
                    $isAltRow = false;
                    while ($row = $result->fetch_assoc())
                    {
                        // Print row header
                        if ($isAltRow)
                        {
                           print "<tr class=\"altRow\">"; 
                           $isAltRow = false;
                        }
                        else
                        {
                            print "<tr>";
                            $isAltRow = true;
                        }
                        
                        // Holds a string of the css class for the order
                        $orderColor = "";
                        
                        // Check order status to set status color
                        switch ($row['Order Status'])
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
                        
                        // Create order ID row
                        echo '<td><a href="admin.php?editOrder&id='.$row['SalesOrderID'].'">'.$row['SalesOrderID'].'</a></td>';
                        // Create Invoice date row
                        echo '<td><a  href="admin.php?editOrder&id='.$row['SalesOrderID'].'">'.$row['InvoiceDate'].'</a></td>';
                        // Create subtotal row
                        echo '<td><a href="admin.php?editOrder&id='.$row['SalesOrderID'].'">$'.$row['SubTotal'].'</a></td>';
                        // Create Shipping row
                        echo '<td><a href="admin.php?editOrder&id='.$row['SalesOrderID'].'">$'.$row['Shipping'].'</a></td>';
                        // Create total cost row
                        echo '<td><a href="admin.php?editOrder&id='.$row['SalesOrderID'].'">$'.$row['Total'].'</a></td>';
                        // Create shipped Date row
                        echo '<td><a  href="admin.php?editOrder&id='.$row['SalesOrderID'].'">'.$row['ShippedDate'].'</a></td>';
                        // Create shipped Date row
                        echo '<td><a href="admin.php?editOrder&id='.$row['SalesOrderID'].'">'.$row['ShippingRecord'].'</a></td>';
                        // Create order status row
                        echo '<td><a class="'.$orderColor.'"href="admin.php?editOrder&id='.$row['SalesOrderID'].'">'.$row['Order Status'].'</a></td>';
                        // Draw edit row
                        echo '<td><a class="editButton" href="admin.php?editOrder&id='.$row['SalesOrderID'].'">Edit</a></td>';
                        
                        // Close row
                        echo '</tr>';
                    }
                }
            }
            else
            {
                // Display Error
                echo "Error querying ORDER_STATUS";
            }
            ?>
        </table>
    </div>


    <div id="manageCustomersStretcher"></div>
    <div id="bottomButtonsBox">
        <form action="admin.php"><button class="formCSSButtonButton">Back</button></form>
    </div>

</div>