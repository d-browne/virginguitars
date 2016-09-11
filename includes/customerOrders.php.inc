<?php
/*
 * Virgin Guitars E-Commerce website 2016
 * Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * The purpose of this include is to display all the orders for a specific customer
 * 
 * Author: Dominic Browne
 */

require_once 'classes/Database.php'; // Include the database 

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

// Get customer ID 
$CustomerID = mysqli_real_escape_string($dataConnection, $_GET['CustomerID']);

// Check if requested new (Requested) orders only
$newOrders = false;
$newOrdersUrl = ""; // Holds the string to append to url if new orders only
if (isset($_GET['newOrders']))
{
    $newOrders = true;
    $newOrdersUrl = "newOrders&";
}

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

// Create customer object to use
$customer = new Customer();
$customer->initializeID($CustomerID);
?>


<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Customer Orders</h1>
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
                <td>
                    <?php
                        if ($orderBy === "SalesOrderID")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=SalesOrderID">Order.ID</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=SalesOrderID&desc">Order.ID</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=SalesOrderID">Order.ID</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "InvoiceDate")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=InvoiceDate">Invoice Date</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=InvoiceDate&desc">Invoice Date</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=InvoiceDate">Invoice Date</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "SubTotal")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=SubTotal">SubTotal</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=SubTotal&desc">SubTotal</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=SubTotal">SubTotal</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Shipping")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=Shipping">Shipping</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=Shipping&desc">Shipping</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=Shipping">Shipping</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Total")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=Total">Total Cost</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=Total&desc">Total Cost</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=Total">Total Cost</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "ShippedDate")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=ShippedDate">Shipped Date</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=ShippedDate&desc">Shipped Date</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=ShippedDate">Shipped Date</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "ShippingRecord")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=ShippingRecord">Shipping Record</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=ShippingRecord&desc">Shipping Record</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=ShippingRecord">Shipping Record</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "OrderStatus")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=OrderStatus">Order Status</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=OrderStatus&desc">Order Status</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&'.$newOrdersUrl.'orderBy=OrderStatus">Order Status</a></span>';
                        }
                    ?>
                </td>
                <td><span class="tableHeader">Edit</span></td>
            </tr>
            
            <?php
            // Get each order and output it as a table row
            
            // Query to select orders
            $query = "SELECT * FROM ORDERS_STATUS WHERE CustomerFK=".$CustomerID."";
            
            // If new orders only (Requested) append where clause
            if ($newOrders)
            {
                $query = $query." AND `Order Status`='Requested'";
            }
            
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
            
            // Check if query successful
            if ($result !== false)
            {
                // Check if there are results
                if ($result->num_rows > 0)
                {
                    $isAltRow = false; // Flag to determine if is alternate row. Creates checkerboard style effect
                    
                    // Loop through each result and create the corresponding html row
                    while ($row = $result->fetch_assoc())
                    {
                        // Create table row (alt or not)
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
                        echo '<td><a href="admin.php?editOrder&id='.$CustomerID.'">'.$row['SalesOrderID'].'</a></td>';
                        // Create Invoice date row
                        echo '<td><a  href="admin.php?editOrder&id='.$CustomerID.'">'.$row['InvoiceDate'].'</a></td>';
                        // Create subtotal row
                        echo '<td><a href="admin.php?editOrder&id='.$CustomerID.'">$'.$row['SubTotal'].'</a></td>';
                        // Create Shipping row
                        echo '<td><a href="admin.php?editOrder&id='.$CustomerID.'">$'.$row['Shipping'].'</a></td>';
                        // Create total cost row
                        echo '<td><a href="admin.php?editOrder&id='.$CustomerID.'">$'.$row['Total'].'</a></td>';
                        // Create shipped Date row
                        echo '<td><a  href="admin.php?editOrder&id='.$CustomerID.'">'.$row['ShippedDate'].'</a></td>';
                        // Create shipped Date row
                        echo '<td><a href="admin.php?editOrder&id='.$CustomerID.'">'.$row['ShippingRecord'].'</a></td>';
                        // Create order status row
                        echo '<td><a class="'.$orderColor.'"href="admin.php?editOrder&id='.$CustomerID.'">'.$row['Order Status'].'</a></td>';
                        // Draw edit row
                        echo '<td><a class="editButton" href="admin.php?editOrder&id='.$CustomerID.'">Edit</a></td>';
                    }
                }
            }
            else
            {
                // Display query failed error to administrator
                echo "<tr>Query failed</tr>";
            }
            ?>

        </table>
    </div>


    <div id="manageCustomersStretcher"></div>
    <div id="bottomButtonsBox">
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
        <form action="admin.php"><button class="formCSSButtonButton" onClick="back()" name="manageOrders">Back</button></form>
    </div>
</div>