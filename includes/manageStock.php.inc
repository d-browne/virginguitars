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

// search values
$productid = "";
$model = "";
$brand = "";
$type = "";
$condition = "";
$case = "";
$status = "";
$quantity = "";

// Get search values from get request
if (isset($_GET['quantity']))
{
    try {
        $quantity = mysqli_real_escape_string($dataConnection, $_GET['quantity']);
    } catch (Exception $ex) {

    }
}
if (isset($_GET['status']))
{
    try {
        $status = mysqli_real_escape_string($dataConnection, $_GET['status']);
    } catch (Exception $ex) {

    }
}
if (isset($_GET['case']))
{
    try {
        $case = mysqli_real_escape_string($dataConnection, $_GET['case']);
    } catch (Exception $ex) {

    }
}
if (isset($_GET['productid']))
{
    try {
        $productid = mysqli_real_escape_string($dataConnection, $_GET['productid']);
    } catch (Exception $ex) {

    }
}
if (isset($_GET['model']))
{
    try {
        $model = mysqli_real_escape_string($dataConnection, $_GET['model']);
    } catch (Exception $ex) {

    }
}
if (isset($_GET['brand']))
{
    try {
        $brand = mysqli_real_escape_string($dataConnection, $_GET['brand']);
    } catch (Exception $ex) {

    }
}
if (isset($_GET['type']))
{
    try {
        $type = mysqli_real_escape_string($dataConnection, $_GET['type']);
    } catch (Exception $ex) {

    }
}
if (isset($_GET['condition']))
{
    try {
        $condition = mysqli_real_escape_string($dataConnection, $_GET['condition']);
    } catch (Exception $ex) {

    }
}

// Set search string
$searchString = "productid=".$productid."&model=".$model."&brand=".$brand."&type=".$type."&condition=".$condition."&case=".$case."&status=".$status."&quantity=".$quantity."&SearchButton";

?>

<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Manage Stock</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Search</legend>
            <form id="userDetailsForm" action="admin.php">
                <input type="hidden" name="manageStock" />
                <div class="inputField"><label>Product ID:</label> <input class="textBox" name="productid" type="text" placeholder="e.g. 1" value="<?php echo $productid ?>" /></div>
                <div class="inputField"><label>Model:</label> <input class="textBox" name="model" type="text" placeholder="e.g. American" value="<?php echo $model ?>" /></div>
                <div class="inputField"><label>Brand:</label> <input class="textBox" name="brand" type="text" placeholder="e.g. Fender" value="<?php echo $brand ?>" /></div>
                <div class="inputField"><label>Type:</label> <input class="textBox" name="type" type="text" placeholder="e.g. Electric" value="<?php echo $type ?>" /></div>
                <div class="inputField"><label>Condition:</label> <input class="textBox" name="condition" type="text" placeholder="e.g. Used" value="<?php echo $condition ?>"/></div>
                <div class="inputField"><label>Case:</label> <input class="textBox" name="case" type="text" placeholder="e.g. Hard" value="<?php echo $case ?>" /></div>
                <div class="inputField"><label>Status:</label> <input class="textBox" name="status" type="text" placeholder="e.g. Back" value="<?php echo $status ?>" /></div>
                <div class="inputField"><label>Quantity:</label> <input class="textBox" name="quantity" type="text" placeholder="e.g. 1" value="<?php echo $quantity ?>" /></div>
                <div class="inputField"><input class="submitButton" type="submit" name="searchButton" value="Search" /></div>
            </form>
        </fieldset>
    </div>
    <div id="tableContainer">
        <table class="cartTable bottomTable" border="1" >
            <tr class="headerRow">
                <td><span class="tableHeader">Image</span></td>
                <td>
                    <?php
                        if ($orderBy === "ProductID")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=ProductID">Prod.ID</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=ProductID&desc">Prod.ID</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=ProductID">Prod.ID</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Model")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Model">Model</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Model&desc">Model</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Model">Model</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Brand")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Brand">Brand</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Brand&desc">Brand</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Brand">Brand</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Type")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Type">Type</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Type&desc">Type</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Type">Type</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Condition")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Condition">Condition</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Condition&desc">Condition</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Condition">Condition</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Case")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Case">Case</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Case&desc">Case</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Case">Case</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Status")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Status">Status</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Status&desc">Status</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Status">Status</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Quantity")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Quantity">Quantity</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Quantity&desc">Quantity</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Quantity">Quantity</a></span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($orderBy === "Price")
                        {
                            if ($desc !== false) // Is descending
                            {
                                echo '<span class="tableHeader tableHeaderDesc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Price">Price</a></span>';
                            }
                            else
                            {
                                echo '<span class="tableHeader tableHeaderAsc"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Price&desc">Price</a></span>';
                            }
                        }
                        else
                        {
                            echo '<span class="tableHeader"><a href="admin.php?manageStock&'.$searchString.'&orderBy=Price">Price</a></span>';
                        }
                    ?>
                </td>
                <td><span class="tableHeader"></span></td>
            </tr>
            
            <?php // Draw each stock item as table row
            // Query to get stock items
            $query = "SELECT * FROM MANAGE_STOCK_VIEW";
            
            $hasSearch = false; // falg to determine if search appended
            
            // Append the search options
            if ($productid !== "")
            {
                $query = $query." WHERE ProductID LIKE '%".$productid."%'";
                $hasSearch = true;
            }
            if ($model !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND Model LIKE '%".$model."%'";
                }
                else
                {
                    $query = $query." WHERE Model LIKE '%".$model."%'";
                    $hasSearch = true;
                }
            }
            if ($brand !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND Brand LIKE '%".$brand."%'";
                }
                else
                {
                    $query = $query." WHERE Brand LIKE '%".$brand."%'";
                    $hasSearch = true;
                }
            }
            if ($type !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND Type LIKE '%".$type."%'";
                }
                else
                {
                    $query = $query." WHERE Type LIKE '%".$type."%'";
                    $hasSearch = true;
                }
            }
            if ($condition !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND Condition LIKE '%".$condition."%'";
                }
                else
                {
                    $query = $query." WHERE Condition LIKE '%".$condition."%'";
                    $hasSearch = true;
                }
            }
            if ($case !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND CaseType LIKE '%".$case."%'";
                }
                else
                {
                    $query = $query." WHERE CaseType LIKE '%".$case."%'";
                    $hasSearch = true;
                }
            }
            if ($status !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND Status LIKE '%".$status."%'";
                }
                else
                {
                    $query = $query." WHERE Status LIKE '%".$status."%'";
                    $hasSearch = true;
                }
            }
            if ($quantity !== "")
            {
                if ($hasSearch)
                {
                    $query = $query." AND Quantity LIKE '%".$quantity."%'";
                }
                else
                {
                    $query = $query." WHERE Quantity LIKE '%".$quantity."%'";
                    $hasSearch = true;
                }
            }
            
            // Append order by
            switch($orderBy)
            {
                case "ProductID":
                    $query = $query." ORDER BY ProductID";
                    break;
                case "Model":
                    $query = $query." ORDER BY Model";
                    break;
                case "Brand":
                    $query = $query." ORDER BY Brand";
                    break;
                case "Type":
                    $query = $query." ORDER BY Type";
                    break;
                case "Condition":
                    $query = $query." ORDER BY `Condition`";
                    break;
                case "Case":
                    $query = $query." ORDER BY CaseType";
                    break;
                case "Status":
                    $query = $query." ORDER BY Status";
                    break;
                case "Quantity":
                    $query = $query." ORDER BY Quantity";
                    break;
                case "Price":
                    $query = $query." ORDER BY Price";
                    break;
            }
            
            // Append descending to query if applicable
            if ($desc === true)
            {
                $query = $query." DESC";
            }       
            
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
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'"><img src="'.$row['PrimaryPicturePath'].'" width="100" alt="'.$row['Model'].'" /></a></td>';
                        // Draw product id column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>';
                        // Draw model name column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['Model'].'</a></td>';
                        // Draw brand column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['Brand'].'</a></td>';
                        // Draw type column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['Type'].'</a></td>';
                        // Draw condition column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['Condition'].'</a></td>';
                        // Draw case column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['CaseType'].'</a></td>';
                        // Draw status column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['Status'].'</a></td>';
                        // Draw quantity column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['Quantity'].'</a></td>';
                        // Draw price column
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'">'.$row['Price'].'</a></td>';
                        // Draw del button
                        echo '<td><a href="admin.php?editProduct&id='.$row['ProductID'].'" class="delButton">Del</a></td>';
                        
                        // Close table row
                        echo '</tr>';
                    }
                }
                else
                {
                    // Show no stock items returned error
                    echo "</table>No stock items to show...";
                }
            }
            else
            {
                // Show message that query failed
                echo "</table>Unable to query MANAGE_STOCK_VIEW";
            }
            ?>
        </table>
    </div>


    <div id="manageCustomersStretcher"></div>
    <div id="bottomButtonsBox">
        <form action="admin.php?manageCustomers&newCustomer"><button class="formCSSButtonButton">New</button></form>
        <button type="button" onclick="window.history.back()" class="formCSSButtonButton">Back</button>
    </div>

</div>