<?php
/*
 * This include display the edit product page that allows the administrator to
 * view a specific product's details and edit them, including the main image and
 * images used in the rotator. 
 */

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

?>

<div id="contentBox">
    <?php if (!isset($errorString)): // Display page if no erros ?>
    <div id="leftColumn">
        <!-- Image slider code goes in here -->
        <div id="sliderFrame">
            <div id="slider">
                <a href="jackson_dk2_dinky_hot_rod_flames.html">
                    <img src="images/guitars/jacksonDk2DinkyHotRodFlames/resized2.jpg" alt=""/>
                </a>
                <a href="bc_rich_kerry_king_metal_master_tribal_fire_warlock.html">
                    <img src="images/guitars/bcRichKerryKingMetalMasterTribalFireWarlock/resized6.jpg" alt=""/>
                </a>
                <a href="gibson_les_paul_studio.html">
                    <img src="images/guitars/gibsonLesPaultStudio/resized3.jpg" alt=""/>
                </a>
                <a href="fender_squire_mij_stratocaster.html">
                    <img src="images/guitars/fenderSquireMijStratocaster/resized2.jpg" alt=""/>
                </a>
                <a href="jackson_kvmg_pro_series_king_v.html">
                    <img src="images/guitars/jacksonKvmgProSeriesKingV/resized3.jpg" alt=""/>
                </a>
                <a href="bc_rich_mockingbird_pro.html">
                    <img src="images/guitars/bcRichMockingBirdProX/resized3.jpg" alt=""/>
                </a>
                <a href="gibson_epiphone_limited_edition_les_paul_custom.html">
                    <img src="images/guitars/gibsonEpiphoneLimitedEditionLesPaulCustom/resized3.jpg" alt=""/>
                </a>
                <a href="fender_american_standard_stratocaster.html">
                    <img src="images/guitars/fenderAmericanStandardStratocaster/resized2.jpg" alt=""/>
                </a>
                <a href="jackson_pdx2_demmelition_king_v.html">
                    <img src="images/guitars/jacksonPdx2DemmelitionKingV/resized7.jpg" alt=""/>
                </a>
                <a href="bc_rich_mockingbird_st.html">
                    <img src="images/guitars/bcRichMockingbirdSt/resized3.jpg" alt=""/>
                </a>
            </div>
            <div id="htmlcaption" style="display: none;">
                <em>HTML</em> caption. Link to <a href="http://www.google.com/">Google</a>.
            </div>

        </div> 
        <div id="underRotatorDiv">
            <fieldset class="inputFieldSet" id="underRotatorFieldSet">
                <legend>Upload Rotator Images</legend>
                <span class="imageInstructions">Images should be 255x600px</span>
                <form id="userDetailsForm" action="members.html">
                    <input type="file" name="imageFiles" />
                    <button>Clear</button>
                </form>
            </fieldset>
        </div>
    </div>

    <div id="rightColumn">
        <h1>Edit Product</h1>
        <p></p>
        <fieldset class="inputFieldSet">
            <legend>Admin Details</legend>
            <form id="userDetailsForm" action="members.html">
                <div class="inputField"><label>ProductID:</label> <input class="textBox" type="text" value="<?php echo $product->getProductID(); ?>" disabled="true"/></div>
                <div class="inputField"><label>Created By:</label> <input class="textBox" type="text" value="<?php echo $product->getCreatedBy(); ?>" disabled="true"/></div>
                <div class="inputField"><label>Modified By:</label> <input class="textBox" type="text" value="<?php echo $product->getModifiedBy(); ?>" disabled="true"/></div>
                <div class="inputField"><label>Creation Date:</label> <input class="textBox" type="text" value="<?php echo $product->getCreationDate(); ?>" disabled="true"/></div>
                <div class="inputField"><label>Modified Date:</label> <input class="textBox" type="text" value="<?php echo $product->getModifiedDate(); ?>" disabled="true"/></div>
                <div class="inputField"><input class="submitButton" type="submit" value="Delete" /></div>
            </form>
        </fieldset>

        <fieldset class="inputFieldSet">
            <legend>Product Details</legend>
            <form id="userDetailsForm" action="members.html">
                <div class="inputField"><label>Primary Image :</label><img src="<?php echo $product->getPrimaryPicturePath(); ?>" alt="<?php echo $product->getModel(); ?>" width="100"><span class="imageInstructions"> (use landscape orientation)</span></div>
                <div class="inputField"><label>Upload :</label> <input type="file" /></div>
                <div class="inputField"><label>Model:</label> <input class="textBox" type="text" value="<?php echo $product->getModel(); ?>" placeholder="e.g. Fender Standard Stratocaster" /></div>
                <div class="inputField"><label>Brand:</label> 
                    <select>
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
                    <select>
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
                    <select>
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
                    <select>
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
                <div class="inputField"><input class="submitButton" type="submit" value="Update" /></div>
            </form>
        </fieldset>

        <fieldset class="inputFieldSet" id="stockDetailsFieldSet">
            <legend>Stock Details</legend>
            <form id="userDetailsForm" action="members.html">
                <div class="inputField"><label>Status:</label> 
                    <select>
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
                <div class="inputField"><label>Price:</label> <input class="textBox" type="text" value="<?php echo $product->getPrice(); ?>" placeholder="e.g. 1001.20" /></div>
                <div class="inputField"><label>Quantity:</label> <input class="textBox" type="text" value="<?php echo $product->getQuantity(); ?>" placeholder="e.g. 1" /></div>
                <div class="inputField"><input class="submitButton" type="submit" value="Update" /></div>
            </form>
        </fieldset>



    </div>
    <div class="centerBottomColumn">
        <fieldset class="inputFieldSet" id="aboutUsBlurbFieldSet">
            <legend>Edit Product Description</legend>
            <div class="controlPanelSection" id="faqEditorBox">
                <textarea name="aboutUsBlurb"><?php echo $product->getDescription(); ?></textarea>
            </div>
        </fieldset>
    </div>
    <div id="bottomButtonsBox">
        <form action="admin.php"><button class="formCSSButtonButton">Update</button></form>
        <form action="cart.html"><button class="formCSSButtonButton">View</button></form>
        <button type="button" onclick="window.history.back()" class="formCSSButtonButton">Back</button>
    </div>
    <?php else: ?>
    <span><?php echo htmlspecialchars($errorString); // Displays error message and strips special html characters ?></span>
    <?php endif; ?>
</div>