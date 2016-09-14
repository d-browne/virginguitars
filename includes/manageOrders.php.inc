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

// Flags to determine how the columns should be ordered
$orderBy = "none";  // Determains how to order results
$desc = false;      // Determins if results should be ordered descending

// Check request for column ordering
if (isset($_GET['orderBy']))
{
    // Get sanitized input
    $orderBy = mysqli_real_escape_string($dataConnection, $_GET['orderBy']);
}

// Determine if rows have been requested in descending order
if (isset($_GET['desc']))
{
    $desc = true;
}

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
                <td>
                    <?php
                        if ($orderBy === "SalesOrderID")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageOrders&orderBy=SalesOrderID">Order.ID</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageOrders&orderBy=SalesOrderID&desc">Order.ID</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageOrders&orderBy=SalesOrderID">Order.ID</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "InvoiceDate")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageOrders&orderBy=InvoiceDate">Invoice Date</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageOrders&orderBy=InvoiceDate&desc">Invoice Date</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageOrders&orderBy=InvoiceDate">Invoice Date</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "SubTotal")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageOrders&orderBy=SubTotal">SubTotal</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageOrders&orderBy=SubTotal&desc">SubTotal</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageOrders&orderBy=SubTotal">SubTotal</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Shipping")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageOrders&orderBy=Shipping">Shipping</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageOrders&orderBy=Shipping&desc">Shipping</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageOrders&orderBy=Shipping">Shipping</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Total")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageOrders&orderBy=Total">Total Cost</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageOrders&orderBy=Total&desc">Total Cost</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageOrders&orderBy=Total">Total Cost</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "ShippedDate")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageOrders&orderBy=ShippedDate">Shipped Date</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageOrders&orderBy=ShippedDate&desc">Shipped Date</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageOrders&orderBy=ShippedDate">Shipped Date</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "ShippingRecord")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageOrders&orderBy=ShippingRecord">Shipping Record</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageOrders&orderBy=ShippingRecord&desc">Shipping Record</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageOrders&orderBy=ShippingRecord">Shipping Record</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "OrderStatus")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageOrders&orderBy=OrderStatus">Order Status</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageOrders&orderBy=OrderStatus&desc">Order Status</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageOrders&orderBy=OrderStatus">Order Status</a></span>';
                        }
                    ?>
                </td>
                <td><span class="tableHeader">Edit</span></td>
            </tr>
            <?php
            // Query database for a list of orders
            
            // Query to get orders
            $query = "SELECT * FROM ORDERS_STATUS";
            
            // Append order by
            switch($orderBy)
            {
                case "SalesOrderID":
                    $query = $query." ORDER BY SalesOrderID";
                    break;
                case "InvoiceDate":
                    $query = $query." ORDER BY InvoiceDate";
                    break;
                case "SubTotal":
                    $query = $query." ORDER BY SubTotal";
                    break;
                case "Shipping":
                    $query = $query." ORDER BY Shipping";
                    break;
                case "Total":
                    $query = $query." ORDER BY Total";
                    break;
                case "ShippingRecord":
                    $query = $query." ORDER BY ShippingRecord";
                    break;
                case "ShippedDate":
                    $query = $query." ORDER BY ShippedDate";
                    break;
                case "OrderStatus":
                    $query = $query." ORDER BY `Order Status`";
                    break;
            }
            
            // Append descending to query if applicable
            if ($desc === true)
            {
                $query = $query." DESC";
            }
            
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