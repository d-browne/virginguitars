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
        <h1>Customer Orders</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Customer</legend>
            <div class="inputField"><label>Customer.ID:</label> <input class="textBox" name="customerid" type="text" value="4" disabled="true"/></div>
            <div class="inputField"><label>First Name:</label> <input class="textBox" name="firstname" type="text" value="Dominic" disabled="true"/></div>
            <div class="inputField"><label>Last Name:</label> <input class="textBox" name="lastname" type="text" value="Browne" disabled="true"/></div>
            <div class="inputField"><label>Email:</label> <input class="textBox" name="email" type="email" value="dominic@mail.com" disabled="true"/></div>
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
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&orderBy=SalesOrderID">Order.ID</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&orderBy=SalesOrderID&desc">Order.ID</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&orderBy=SalesOrderID">Order.ID</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "InvoiceDate")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&orderBy=InvoiceDate">Invoice Date</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&orderBy=InvoiceDate&desc">Invoice Date</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?customerOrders&CustomerID='.$CustomerID.'&orderBy=InvoiceDate">Invoice Date</a></span>';
                        }
                    ?>
                    
                </td>
                <td><span class="tableHeader">Subtotal</span></td>
                <td><span class="tableHeader tableHeaderDesc"><a href="admin.php">Shipping</a></span></td>
                <td><span class="tableHeader">Total Cost</span></td>
                <td><span class="tableHeader">Shipped Date</span></td>
                <td><span class="tableHeader">Shipping Record</span></td>
                <td><span class="tableHeader">Order Status</span></td>
                <td><span class="tableHeader">Edit</span></td>
            </tr>
            
            <?php
            // Get each order and output it as a table row
            
            // Query to select orders
            $query = "SELECT * FROM ORDERS_STATUS WHERE CustomerFK=".$CustomerID."";
            
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