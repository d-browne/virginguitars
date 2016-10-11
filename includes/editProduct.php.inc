<?php
/*
 * This include display the edit product page that allows the administrator to
 * view a specific product's details and edit them, including the main image and
 * images used in the rotator. 
 */

// redirect to product page if view product button pressed
if (isset($_POST['viewProductButton']))
{
    header("Location: product.php?id=".$_POST['viewProductButton']);
}

// get a data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

// Check if id is specified 
if (isset($_GET['id']))
{
    // Sanitize product id input
    $ProductID = mysqli_real_escape_string($dataConnection, $_GET['id']);
    try {
    // Try to create product object using given id
    $product = new Product($ProductID);
    } catch (Exception $ex) {
        if ($ex->getMessage() == "ProductID not found")
        {
            $errorString = "'".$ProductID."' not a valid product id...";
        }
        else
        {
            $errorString = $ex->getMessage();
        }
    }
}
else
{
    // error message id not specified
    $errorString = "A product ID must be specified...";
}

// places holder for success and error strings
$updateSuccessString = "";
$updateErrorString = "";

?>

<div id="contentBox">
    <?php if (!isset($errorString)): // Display page if no erros ?>
    <?php     // Handle updates
    // Check if updated button pressed
    if (isset($_POST['updateButton']))
    {
        // Update Model if changed
        if ($product->getModel() !== $_POST['Model'])
        {
            // Try to update model
            $updateModelResult = $product->setModel($_POST['Model']);
            if ($updateModelResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated Model, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updateModelResult.", ";
            }
        }
        // Update Brand if changed
        if ($product->getBrand() !== $_POST['Brand'])
        {
            // Try to update brand
            $updateBrandResult = $product->setBrand($_POST['Brand']);
            if ($updateBrandResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated Brand, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updateBrandResult.", ";
            }
        }
        // Update Type if changed
        if ($product->getType() !== $_POST['Type'])
        {
            // Try to update Type
            $updateTypeResult = $product->setType($_POST['Type']);
            if ($updateTypeResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated Type, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updateTypeResult.", ";
            }
        }
        // Update Condition if changed
        if ($product->getCondition() !== $_POST['Condition'])
        {
            // Try to update Condition
            $updateConditionResult = $product->setCondition($_POST['Condition']);
            if ($updateConditionResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated Condition, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updateConditionResult.", ";
            }
        }
        // Update CaseType if changed
        if ($product->getCaseType() !== $_POST['CaseType'])
        {
            // Try to update CaseType
            $updateCaseTypeResult = $product->setCaseType($_POST['CaseType']);
            if ($updateCaseTypeResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated CaseType, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updateCaseTypeResult.", ";
            }
        }
        // Update Status if changed
        if ($product->getStatus() !== $_POST['Status'])
        {
            // Try to update Status
            $updateStatusResult = $product->setStatus($_POST['Status']);
            if ($updateStatusResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated Status, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updateStatusResult.", ";
            }
        }
        // Update Price if changed
        if ($product->getPrice() !== $_POST['Price'])
        {
            // Try to update Price
            $updatePriceResult = $product->setPrice($_POST['Price']);
            if ($updatePriceResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated Price, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updatePriceResult.", ";
            }
        }
        // Update Quantity if changed
        if ($product->getQuantity() !== $_POST['Quantity'])
        {
            // Try to update Quantity
            $updateQuantityResult = $product->setQuantity($_POST['Quantity']);
            if ($updateQuantityResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated Quantity, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updateQuantityResult.", ";
            }
        }
        // Update Description if changed
        if ($product->getDescription() !== $_POST['Description'])
        {
            // Try to update Description
            $updateDescriptionResult = $product->setDescription($_POST['Description']);
            if ($updateDescriptionResult === true)
            {
                $updateSuccessString = $updateSuccessString."Updated Description, ";
            }
            else
            {
                $updateErrorString = $updateErrorString.$updateDescriptionResult.", ";
            }
        }
    }
    ?>
    <form action="admin.php?editProduct&id=<?php echo $product->getProductID(); ?>" method="POST">
    <div id="leftColumn">
        <!-- Image slider code goes in here -->
        <div id="sliderFrame">
            <div id="slider">
                <?php
                // Loop through images in databse and dispaly
                
                $query = "SELECT ImagePath FROM PICTURE WHERE ProductFK ='".$product->getProductID()."';";
                // Execute query
                $result = $dataConnection->query($query);
                
                // If query successfull
                if ($result !== false)
                {
                    // If paths returned draw images
                    if ($result->num_rows > 0)
                    {
                        // Loop through each row and draw image
                        while ($row = $result->fetch_assoc())
                        {
                            echo '<img src="'.$row['ImagePath'].'" alt=""/>';
                        }
                    }
                    else
                    {
                        // TODO: add the the "no-image" image.
                    }
                }
                ?>
            </div>
            <div id="htmlcaption" style="display: none;">
                <em>HTML</em> caption. Link to <a href="http://www.google.com/">Google</a>.
            </div>

        </div> 
        <div id="underRotatorDiv">
            <fieldset class="inputFieldSet" id="underRotatorFieldSet">
                <legend>Upload Rotator Images</legend>
                <span class="imageInstructions">Images should be 255x600px</span>
                    <input type="file" name="imageFiles" />
                    <button type="submit" name="updateButton">Clear</button>
            </fieldset>
        </div>
    </div>
    
    <div id="rightColumn">
        <h1>Edit Product</h1>
        <p><span id="updatedMemberLabel"><?php echo $updateSuccessString; ?></span> <span id="updatedMemberErrorLabel"><?php echo $updateErrorString; ?></span></p>
        <fieldset class="inputFieldSet">
            <legend>Admin Details</legend>
                <div class="inputField"><label>ProductID:</label> <input class="textBox" type="text" value="<?php echo $product->getProductID(); ?>" disabled="true"/></div>
                <div class="inputField"><label>Created By:</label> <input class="textBox" type="text" value="<?php echo $product->getCreatedBy(); ?>" disabled="true"/></div>
                <div class="inputField"><label>Modified By:</label> <input class="textBox" type="text" value="<?php echo $product->getModifiedBy(); ?>" disabled="true"/></div>
                <div class="inputField"><label>Creation Date:</label> <input class="textBox" type="text" value="<?php echo $product->getCreationDate(); ?>" disabled="true"/></div>
                <div class="inputField"><label>Modified Date:</label> <input class="textBox" type="text" value="<?php echo $product->getModifiedDate(); ?>" disabled="true"/></div>
                <div class="inputField"><input class="submitButton" name="updateButton" type="submit" value="Delete" /></div>
        </fieldset>

        <fieldset class="inputFieldSet">
            <legend>Product Details</legend>
                <div class="inputField"><label>Primary Image :</label><img src="<?php echo $product->getPrimaryPicturePath(); ?>" alt="<?php echo $product->getModel(); ?>" width="100"><span class="imageInstructions"> (preferably square ratio)</span></div>
                <div class="inputField"><label>Upload :</label> <input type="file" /></div>
                <div class="inputField"><label>Model:</label> <input class="textBox" type="text" name="Model" value="<?php echo $product->getModel(); ?>" placeholder="e.g. Fender Standard Stratocaster" /></div>
                <div class="inputField"><label>Brand:</label> 
                    <select name="Brand">
                        <?php
                        // Query database for all Brands
                        $query = "SELECT BrandName FROM BRAND";
                        
                        // Execute query
                        $result = $dataConnection->query($query);
                        
                        // Loop through each result a draw a select option
                        while ($row = $result->fetch_assoc())
                        {
                            // Check if current products is this brand
                            if ($product->getBrand() == $row['BrandName'])
                            {
                                // Draw option and make it selected
                                echo '<option value="'.$row['BrandName'].'"selected>'.$row['BrandName'].'</option>';
                            }
                            else
                            {
                                // Draw option but don't make it selected
                                echo '<option value="'.$row['BrandName'].'">'.$row['BrandName'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="inputField"><label>Type:</label> 
                    <select name="Type">
                        <?php
                        // Query database for all Types
                        $query = "SELECT Type FROM CLASSIFICATION";
                        
                        // Execute query
                        $result = $dataConnection->query($query);
                        
                        // Loop through each result a draw a select option
                        while ($row = $result->fetch_assoc())
                        {
                            // Check if current products is this Types
                            if ($product->getType() == $row['Type'])
                            {
                                // Draw option and make it selected
                                echo '<option value="'.$row['Type'].'"selected>'.$row['Type'].'</option>';
                            }
                            else
                            {
                                // Draw option but don't make it selected
                                echo '<option value="'.$row['Type'].'">'.$row['Type'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="inputField"><label>Condition:</label> 
                    <select name="Condition">
                        <?php
                        // Query database for Description of appearance (condition)
                        $query = "SELECT Description FROM APPEARENCE";
                        
                        // Execute query
                        $result = $dataConnection->query($query);
                        
                        // Loop through each result a draw a select option
                        while ($row = $result->fetch_assoc())
                        {
                            // Check if current products is this Description
                            if ($product->getCondition() == $row['Description'])
                            {
                                // Draw option and make it selected
                                echo '<option value="'.$row['Description'].'"selected>'.$row['Description'].'</option>';
                            }
                            else
                            {
                                // Draw option but don't make it selected
                                echo '<option value="'.$row['Description'].'">'.$row['Description'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="inputField"><label>Case:</label> 
                    <select name="CaseType">
                        <?php
                        // Query database for case types
                        $query = "SELECT Description FROM CASE_TYPE";
                        
                        // Execute query
                        $result = $dataConnection->query($query);
                        
                        // Loop through each result a draw a select option
                        while ($row = $result->fetch_assoc())
                        {
                            // Check if current products is this case type
                            if ($product->getCaseType() == $row['Description'])
                            {
                                // Draw option and make it selected
                                echo '<option value="'.$row['Description'].'"selected>'.$row['Description'].'</option>';
                            }
                            else
                            {
                                // Draw option but don't make it selected
                                echo '<option value="'.$row['Description'].'">'.$row['Description'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="inputField"><input class="submitButton" name="updateButton" type="submit" value="Update" /></div>
        </fieldset>

        <fieldset class="inputFieldSet" id="stockDetailsFieldSet">
            <legend>Stock Details</legend>
                <div class="inputField"><label>Status:</label> 
                    <select name="Status">
                        <?php
                        // Query database for status
                        $query = "SELECT Description FROM PRODUCT_STATUS";
                        
                        // Execute query
                        $result = $dataConnection->query($query);
                        
                        // Loop through each result a draw a select option
                        while ($row = $result->fetch_assoc())
                        {
                            // Check if current products is this case type
                            if ($product->getStatus() == $row['Description'])
                            {
                                // Draw option and make it selected
                                echo '<option value="'.$row['Description'].'"selected>'.$row['Description'].'</option>';
                            }
                            else
                            {
                                // Draw option but don't make it selected
                                echo '<option value="'.$row['Description'].'">'.$row['Description'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="inputField"><label>Price:</label> <input class="textBox" type="text" name="Price" value="<?php echo $product->getPrice(); ?>" placeholder="e.g. 1001.20" /></div>
                <div class="inputField"><label>Quantity:</label> <input class="textBox" type="text" name="Quantity" value="<?php echo $product->getQuantity(); ?>" placeholder="e.g. 1" /></div>
                <div class="inputField"><input class="submitButton" type="submit" name="updateButton" value="Update" /></div>
        </fieldset>



    </div>
    <div class="centerBottomColumn">
        <fieldset class="inputFieldSet" id="aboutUsBlurbFieldSet">
            <legend>Edit Product Description</legend>
            <div class="controlPanelSection" id="faqEditorBox">
                <textarea name="Description"><?php echo $product->getDescription(); ?></textarea>
            </div>
        </fieldset>
    </div>
    <div id="bottomButtonsBox">
        <button class="formCSSButtonButton" name="updateButton" type="submit">Update</button>
    
        <button type="submit" name="viewProductButton" value="<?php echo $product->getProductID(); ?>" class="formCSSButtonButton">View</button>
        <button type="button" onclick="window.history.back()" class="formCSSButtonButton">Back</button>
    </div>
    </form>
    <?php else: ?>
    <span><?php echo htmlspecialchars($errorString); // Displays error message and strips special html characters ?></span>
    <?php endif; ?>
</div>