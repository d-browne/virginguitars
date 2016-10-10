<?php
/*
 * This file displays the search page and is a clone of the manage stock page
 * however instead of birining up the edit stock interface it links directly
 * to front-end product page
 */

require_once 'includes/globalheader.php';

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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administration</title>
<link href="styles/main.css" rel="stylesheet" type="text/css">
<link href="styles/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="scripts/js-image-slider.js" type="text/javascript"></script>
</head>

<body>
	<div id="mainBox">
    	<?php
            // Display Page header
            include 'includes/pageheader.php.inc';
        ?>
        
        <?php
            // Display menu bar
            include 'includes/menubar.php.inc';
        ?>
        
        <div id="categoryBox">
        	<a href="fender.html"><div class="categoryImage" id="fenderCategory"></div></a>
            <a href="gibson.html"><div class="categoryImage" id="gibsonCategory"></div></a>
            <a href="bcrich.html"><div class="categoryImage" id="bcRichCategory"></div></a>
            <a href="jackson.html"><div class="categoryImage" id="jacksonLogo"></div></a>
            
        </div>

<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Search Catalog</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Search</legend>
            <form id="userDetailsForm" action="search.php">
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
                        echo '<td><a href="'.$row['PrimaryPicturePath'].'"><img src="'.$row['PrimaryPicturePath'].'" width="100" alt="'.$row['Model'].'" /></a></td>';
                        // Draw product id column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>';
                        // Draw model name column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Model'].'</a></td>';
                        // Draw brand column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Brand'].'</a></td>';
                        // Draw type column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Type'].'</a></td>';
                        // Draw condition column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Condition'].'</a></td>';
                        // Draw case column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['CaseType'].'</a></td>';
                        // Draw status column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Status'].'</a></td>';
                        // Draw quantity column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Quantity'].'</a></td>';
                        // Draw price column
                        echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Price'].'</a></td>';
                        
                        // Close table row
                        echo '</tr>';
                    }
                }
                else
                {
                    // Show no stock items returned error
                    echo '</table>No stock items to show...';
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
        <button type="button" onclick="window.history.back()" class="formCSSButtonButton">Back</button>
    </div>
    
    

</div>
            
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
            
        </body>
</html>