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
$desc = false;              // Determins if results should be ordered descending

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

// Search values
$customerid = "";
$firstname = "";
$lastname = "";
$email = "";
$viewDeleted = "";

// Handle delete and resotre requests
if (isset($_GET['res']))
{
    try {
        $customer = new Customer();
        $customer->initializeID(mysqli_real_escape_string($dataConnection, $_GET['res']));
        
        // Check if customer initialized
        if ($customer->getIsInitialized())
        {
            // set deleted to true
            $customer->setIsDeleted(false);
            
            $viewDeleted = ""; // Show all customers after restore
        }
    } catch (Exception $ex) {

    }
}
if (isset($_GET['del']))
{
    try {
        $customer = new Customer();
        $customer->initializeID(mysqli_real_escape_string($dataConnection, $_GET['del']));
        
        // Check if customer initialized
        if ($customer->getIsInitialized())
        {
            // set deleted to true
            $customer->setIsDeleted(true);
            
            $viewDeleted = "on"; // Show the deleted customers after delete
        }
    } catch (Exception $ex) {

    }
}

// Try to set search values from get requests
if (isset($_GET['viewDeleted']))
{
    try {
        $viewDeleted = mysqli_real_escape_string($dataConnection, $_GET['viewDeleted']);
    } catch (Exception $ex) {

    }
}
if (isset($_GET['CustomerID']))
{
        // Get search form values
        //$customerid = $_GET['CustomerID'];
        //$firstname = $_GET['FirstName'];
        //$lastname = $_GET['LastName'];
        //$email = $_GET['Email'];

        try {
            $customerid = mysqli_real_escape_string($dataConnection, $_GET['CustomerID']);
        } catch (Exception $ex) {

        }
}

if (isset($_GET['FirstName']))
{
    try {
        $firstname = mysqli_real_escape_string($dataConnection, $_GET['FirstName']);
    } catch (Exception $ex) {

    }
}

if (isset($_GET['LastName']))
{
    try {
        $lastname = mysqli_real_escape_string($dataConnection, $_GET['LastName']);
    } catch (Exception $ex) {

    }
}

if (isset($_GET['Email']))
{
    try {
        $email = mysqli_real_escape_string($dataConnection, $_GET['Email']);
    } catch (Exception $ex) {

    }
}
// End setting search values from get requests. 

$searchString = 'CustomerID='.$customerid.'&FirstName='.$firstname.'&LastName='.$lastname.'&Email='.$email.'&viewDeleted='.$viewDeleted.'&searchButton';
?>

<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Manage Customers</h1>
    </div>
    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Search</legend>
            <form id="userDetailsForm" action="admin.php">
                <input type="hidden" name="manageCustomers" />
                <div class="inputField"><label>Customer.ID:</label> <input class="textBox" name="CustomerID" type="text" placeholder="e.g. 1" value="<?php echo $customerid; ?>"/></div>
                <div class="inputField"><label>First Name:</label> <input class="textBox" name="FirstName" type="text" placeholder="e.g. Kev" value="<?php echo $firstname; ?>"/></div>
                <div class="inputField"><label>Last Name:</label> <input class="textBox" name="LastName" type="text" placeholder="e.g. Smith" value="<?php echo $lastname; ?>"/></div>
                <div class="inputField"><label>Email:</label> <input class="textBox" name="Email" type="text" placeholder="mail@ne.com" value="<?php echo $email; ?>"/></div>
                <div class="inputField"><label>View Deleted:</label> <input type="checkbox" name="viewDeleted" <?php if ($viewDeleted === "on") {echo "checked";} ?>></div>
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
                            if ($desc !== false)
                            {
                                echo "<span class=\"tableHeader tableHeaderDesc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=CustomerID\">Customer.ID</a></span>";
                            }
                            else
                            {
                                echo "<span class=\"tableHeader tableHeaderAsc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=CustomerID&desc\">Customer.ID</a></span>";
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageCustomers&'.$searchString.'&orderBy=CustomerID">Customer.ID</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "FirstName")
                        {
                            if ($desc !== false)
                            {
                                echo "<span class=\"tableHeader tableHeaderDesc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=FirstName\">First Name</a></span>";
                            }
                            else
                            {
                                echo "<span class=\"tableHeader tableHeaderAsc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=FirstName&desc\">First Name</a></span>";
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageCustomers&'.$searchString.'&orderBy=FirstName">First Name</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "LastName")
                        {
                            if ($desc !== false)
                            {
                                echo "<span class=\"tableHeader tableHeaderDesc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=LastName\">Last Name</a></span>";
                            }
                            else
                            {
                                echo "<span class=\"tableHeader tableHeaderAsc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=LastName&desc\">Last Name</a></span>";
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageCustomers&'.$searchString.'&orderBy=LastName">Last Name</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Email")
                        {
                            if ($desc!== false)
                            {
                                echo "<span class=\"tableHeader tableHeaderDesc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=Email\">Email</a></span>";
                            }
                            else
                            {
                                echo "<span class=\"tableHeader tableHeaderAsc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=Email&desc\">Email</a></span>";
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageCustomers&'.$searchString.'&orderBy=Email">Email</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "All Orders")
                        {
                            if ($desc !== false)
                            {
                                echo "<span class=\"tableHeader tableHeaderDesc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=All Orders\">All Orders</a></span>";
                            }
                            else
                            {
                                echo "<span class=\"tableHeader tableHeaderAsc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=All Orders&desc\">All Orders</a></span>";
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageCustomers&'.$searchString.'&orderBy=All Orders">All Orders</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "New Orders")
                        {
                            if ($desc !== false)
                            {
                                echo "<span class=\"tableHeader tableHeaderDesc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=New Orders\">New Orders</a></span>";
                            }
                            else
                            {
                                echo "<span class=\"tableHeader tableHeaderAsc\"><a href=\"admin.php?manageCustomers&".$searchString."&orderBy=New Orders&desc\">New Orders</a></span>";
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageCustomers&'.$searchString.'&orderBy=New Orders">New Orders</a></span>';
                        }
                    ?>
                </td>
                <td><span class="tableHeader">Edit</span></td>
                <td><span class="tableHeader">Del</span></td>
            </tr>
            
            <?php
            // Query database for values and draw table rows
            
            // Query to get customers and orders from database
            
            // Fag to check if ordered
            $isOrdered = false;
            
            $query = "SELECT * FROM CUSTOMERS_AND_ORDERS_VIEW";
            
            $hasSearch = false;
            
            // Append the search options
            if ($customerid !== "")
            {
                $query = $query." WHERE CustomerID LIKE '%".$customerid."%'";
                $hasSearch = true;
            }
            if ($firstname !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND FirstName LIKE '%".$firstname."%'";
                }
                else
                {
                    $query = $query." WHERE FirstName LIKE '%".$firstname."%'";
                    $hasSearch = true;
                }
            }
            if ($lastname !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND LastName LIKE '%".$lastname."%'";
                }
                else
                {
                    $query = $query." WHERE LastName LIKE '%".$lastname."%'";
                    $hasSearch = true;
                }
                
            }
            if ($email !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND Email LIKE '%".$email."%'";
                }
                else
                {
                    $query = $query." WHERE Email LIKE '%".$email."%'";
                    $hasSearch = true;
                }
            }
            
            // view deleted customers
            if ($viewDeleted !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND isDeleted='1'";
                }
                else
                {
                    $query = $query." WHERE isDeleted='1'";
                }
            }
            else
            {
                if ($hasSearch)
                {
                    $query = $query." AND isDeleted<>'1'";
                }
                else
                {
                    $query = $query." WHERE isDeleted<>'1'";
                }
            }
            
            // Appened the order options
            switch ($orderBy)
            {
                case "CustomerID":
                    $query = $query." ORDER BY CustomerID";
                    $isOrdered = true;
                    break;
                case "FirstName":
                    $query = $query." ORDER BY FirstName";
                    $isOrdered = true;
                    break;
                case "LastName":
                    $query = $query." ORDER BY LastName";
                    $isOrdered = true;
                    break;
                case "Email":
                    $query = $query." ORDER BY Email";
                    $isOrdered = true;
                    break;
                case "All Orders":
                    $query = $query." ORDER BY `All Orders`";
                    $isOrdered = true;
                    break;
                case "New Orders":
                    $query = $query." ORDER BY `New Orders`";
                    $isOrdered = true;
                    break;
            }
            
            // Append descending if descending
            if ($desc && $isOrdered) // ensures table is ordered first or query will break
            {
                $query = $query." desc";
            }
            
            
            
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
                        print "<td><a href=\"admin.php?customerOrders&CustomerID=".$row['CustomerID']."\">".$row['All Orders']."</a></td>";
                        // Print All Orders
                        print "<td><a class=\"newOrdersButton\" href=\"admin.php?customerOrders&CustomerID=".$row['CustomerID']."&newOrders\">".$row['New Orders']."</a></td>";
                        // Print Edit button
                        print "<td><a class=\"editButton\" href=\"admin.php?manageCustomers&edit=".$row['CustomerID']."\">Edit</a></td>";
                        // Print Delete button
                        if ($row['isDeleted'] == 0)
                        {
                            print "<td><a class=\"delButton\" href=\"admin.php?manageCustomers&del=".$row['CustomerID']."\">Del</a></td>";
                        }
                        else
                        {
                            print "<td><a class=\"editButton\" href=\"admin.php?manageCustomers&res=".$row['CustomerID']."\">Res</a></td>";
                        }
                        
                        
                        // Close table row
                        print "</tr>";
                    }
                }
                else
                {
                    // Do nothing (no results)
                    
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
        <form action="members.php?signOut" method="POST"><button class="formCSSButtonButton">New</button></form>
        <form action="admin.php?back"><button class="formCSSButtonButton">Back</button></form>
    </div>

</div>