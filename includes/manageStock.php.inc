<?php
/*
 * This file displays the manage stock areas of the admin panel.
 * It displays a list of each product and gives the administrator
 * the ability to edit each item. This area also faciliates the creation and
 * deletion of stock items.
 */

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();


?>

<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Manage Stock</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Search</legend>
            <form id="userDetailsForm" action="admin.php?manageCustomers">
                <div class="inputField"><label>Product ID:</label> <input class="textBox" name="productid" type="text" placeholder="e.g. 1"/></div>
                <div class="inputField"><label>Model:</label> <input class="textBox" name="model" type="text" placeholder="e.g. American" value=""/></div>
                <div class="inputField"><label>Brand:</label> <input class="textBox" name="brand" type="text" placeholder="e.g. Fender"/></div>
                <div class="inputField"><label>Type:</label> <input class="textBox" name="type" type="text" placeholder="e.g. Electric"/></div>
                <div class="inputField"><label>Condition:</label> <input class="textBox" name="condition" type="text" placeholder="e.g. Used"/></div>
                <div class="inputField"><label>Case:</label> <input class="textBox" name="case" type="text" placeholder="e.g. Hard"/></div>
                <div class="inputField"><label>Status:</label> <input class="textBox" name="status" type="text" placeholder="e.g. Back"/></div>
                <div class="inputField"><label>Quantity:</label> <input class="textBox" name="quantity" type="text" placeholder="e.g. 1"/></div>
                <div class="inputField"><input class="submitButton" type="submit" name="searchButton" value="Search" /></div>
            </form>
        </fieldset>
    </div>
    <div id="tableContainer">
        <table class="cartTable bottomTable" border="1" >
            <tr class="headerRow">
                <td><span class="tableHeader">Image</span></td>
                <td><span class="tableHeader">Prod.ID</span></td>
                <td><span class="tableHeader">Model</span></td>
                <td><span class="tableHeader">Brand</span></td>
                <td><span class="tableHeader">Type</span></td>
                <td><span class="tableHeader">Condition</span></td>
                <td><span class="tableHeader">Case</span></td>
                <td><span class="tableHeader">Status</span></td>
                <td><span class="tableHeader">Quantity</span></td>
                <td><span class="tableHeader">Price</span></td>
                <td><span class="tableHeader"></span></td>
            </tr>
            
            <?php // Draw each stock item as table row
            // Query to get stock items
            $query = "SELECT * FROM MANAGE_STOCK_VIEW";

            // Execute query
            $result = $dataConnection->query($query);

            // if query succeeded
            if ($result !== false)
            {
                // Check if stock items returned
                if ($result->num_rows > 0)
                {
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

                        // Draw image column
                        echo '<td><img src="'.$row['PrimaryPicturePath'].'" width="100" alt="'.$row['Model'].'" /></td>';
                        // Draw product id column
                        echo '<td><a href="admin.php">'.$row['ProductID'].'</a></td>';
                        // Draw model name column
                        echo '<td><a href="admin.php">'.$row['Model'].'</a></td>';
                        // Draw brand column
                        echo '<td><a href="admin.php">'.$row['Brand'].'</a></td>';
                        // Draw type column
                        echo '<td><a href="admin.php">'.$row['Type'].'</a></td>';
                        // Draw condition column
                        echo '<td><a href="admin.php">'.$row['Condition'].'</a></td>';
                        // Draw case column
                        echo '<td><a href="admin.php">'.$row['CaseType'].'</a></td>';
                        // Draw status column
                        echo '<td><a href="admin.php">'.$row['Status'].'</a></td>';
                        // Draw quantity column
                        echo '<td><a href="admin.php">'.$row['Quantity'].'</a></td>';
                        // Draw price column
                        echo '<td><a href="admin.php">'.$row['Price'].'</a></td>';
                        // Draw del button
                        echo '<td><a href="admin.php" class="delButton">Del</a></td>';
                        
                        // Close table row
                        echo '</tr>';
                    }
                }
                else
                {
                    // Show no stock items returned error
                    echo "No stock items to show...";
                }
            }
            else
            {
                // Show message that query failed
                echo "Unable to query MANAGE_STOCK_VIEW";
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