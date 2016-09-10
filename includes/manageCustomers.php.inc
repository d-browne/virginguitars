<?php

/* 
 * Virgin Guitars E-Commerce website 2016
 * Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * The purpose of this include is to display the Manage Customers sections of
 * the website and handle any get/post requests to that page. 
 * 
 * Author: Dominic Browne
 */



require_once 'classes/Database.php'; // Include the database

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

$orderBy = "none";  // Determains how to order results
$desc;              // Determins if results should be ordered descending

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
        <h1>Manage Customers</h1>
    </div>
    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Search</legend>
            <form id="userDetailsForm" action="admin.php?manageCustomers">
                <div class="inputField"><label>Customer.ID:</label> <input class="textBox" name="customerid" type="text" placeholder="e.g. 1"/></div>
                <div class="inputField"><label>First Name:</label> <input class="textBox" name="firstname" type="text" placeholder="e.g. Kev" value=""/></div>
                <div class="inputField"><label>Last Name:</label> <input class="textBox" name="lastname" type="text" placeholder="e.g. Smith"/></div>
                <div class="inputField"><label>Email:</label> <input class="textBox" name="email" type="email" placeholder="mail@ne.com"/></div>
                <div class="inputField"><input class="submitButton" type="submit" name="searchButton" value="Search" /></div>
            </form>
        </fieldset>
    </div>
    <div id="tableContainer">
        <table class="cartTable" border="1" >
            <tr class="headerRow">
                <td>
                    <?php
                        if ($orderBy === "CustomerID")
                        {
                            if (isset($desc))
                            {
                                echo "<span class=\"tableHeader tableHeaderDesc\"><a href=\"admin.php?manageCustomers&orderBy=CustomerID\">Customer.ID</a></span>";
                            }
                            else
                            {
                                echo "<span class=\"tableHeader tableHeaderAsc\"><a href=\"admin.php?manageCustomers&orderBy=CustomerID&desc\">Customer.ID</a></span>";
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageCustomers&orderBy=CustomerID">Customer.ID</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "FirstName")
                        {
                            if (isset($desc))
                            {
                                echo "<span class=\"tableHeader tableHeaderDesc\"><a href=\"admin.php?manageCustomers&orderBy=FirstName\">First Name</a></span>";
                            }
                            else
                            {
                                echo "<span class=\"tableHeader tableHeaderAsc\"><a href=\"admin.php?manageCustomers&orderBy=FirstName&desc\">First Name</a></span>";
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageCustomers&orderBy=FirstName">First Name</a></span>';
                        }
                    ?>
                    <!--<span class="tableHeader"><a href="admin.php?manageCustomers&orderBy=FirstName">First Name</a></span>-->
                </td>
                <td><span class="tableHeader"><a href="admin.php?manageCustomers&orderBy=LastName">Last Name</a></span></td>
                <td><span class="tableHeader"><a href="admin.php?manageCustomers&orderBy=Email">Email</a></span></td>
                <td><span class="tableHeader"><a href="admin.php?manageCustomers&orderBy=AllOrders">All Orders</a></span></td>
                <td><span class="tableHeader"><a href="admin.php?manageCustomers&orderBy=NewOrders">New Orders</a></span></td>
                <td><span class="tableHeader">Edit</span></td>
                <td><span class="tableHeader">Del</span></td>
            </tr>
            
            <?php
            // Query database for values and draw table rows
            
            // Query the databse
            $query = "SELECT * FROM CUSTOMERS_AND_ORDERS_VIEW";
            
            // Execute query
            $result = $dataConnection->query($query);
            
            // If query successfull
            if ($result !== false)
            {
                // Check if results returns 
                if ($result->num_rows > 0)
                {
                    $altRow = false; // Holds whether or not an alt row. Used in styling. Alt rows are darker. Creates a checkerboard effect
                    // Loop throw through each row
                    while ($row = $result->fetch_assoc())
                    {
                        // Print row header
                        if ($altRow)
                        {
                           print "<tr class=\"altRow\">"; 
                           $altRow = false;
                        }
                        else
                        {
                            print "<tr>";
                            $altRow = true;
                        }
                        
                        
                        // Print CustomerID column
                        print "<td><a href=\"admin.php?manageCustomers&edit=".$row['CustomerID']."\">".$row['CustomerID']."</a></td>";
                        // Print First name Column
                        print "<td><a href=\"admin.php?manageCustomers&edit=".$row['CustomerID']."\">".$row['FirstName']."</a></td>";
                        // Print Last Name Column
                        print "<td><a href=\"admin.php?manageCustomers&edit=".$row['CustomerID']."\">".$row['LastName']."</a></td>";
                        // Print email column
                        print "<td><a href=\"admin.php?manageCustomers&edit=".$row['CustomerID']."\">".$row['Email']."</a></td>";
                        // Print All Orders
                        print "<td><a href=\"admin.php?manageCustomers\">".$row['All Orders']."</a></td>";
                        // Print All Orders
                        print "<td><a class=\"newOrdersButton\" href=\"admin.php?manageCustomers\">".$row['New Orders']."</a></td>";
                        // Print Edit button
                        print "<td><a class=\"editButton\" href=\"admin.php?manageCustomers&edit=".$row['CustomerID']."\">Edit</a></td>";
                        // Print Delete button
                        print "<td><a class=\"delButton\" href=\"admin.php?manageCustomers&del=".$row['CustomerID']."\">Del</a></td>";
                        
                        // Close table row
                        print "</tr>";
                    }
                }
                else
                {
                    // Display no results found message
                    echo "No results found...";
                }
            }
            else
            {
                // If query fails display error
                echo "Error querying CUSTOMERS_AND_ORDERS_VIEW";
            }
            ?>
            
            

        </table>
    </div>


    <div id="manageCustomersStretcher"></div>
    <div id="bottomButtonsBox">
        <form action="admin.php?manageCustomers&newCustomer"><button class="formCSSButtonButton">New</button></form>
        <form action="admin.php?back"><button class="formCSSButtonButton">Back</button></form>
    </div>

</div>