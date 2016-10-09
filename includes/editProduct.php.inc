<?php
/*
 * This include display the edit product page that allows the administrator to
 * view a specific product's details and edit them, including the main image and
 * images used in the rotator. 
 */
?>

<div id="contentBox">

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
                <div class="inputField"><label>ProductID:</label> <input class="textBox" type="email" placeholder="e.g. 1" disabled="true"/></div>
                <div class="inputField"><label>Created By:</label> <input class="textBox" type="text" value="admin" disabled="true"/></div>
                <div class="inputField"><label>Modified By:</label> <input class="textBox" type="text" value="admin" disabled="true"/></div>
                <div class="inputField"><label>Creation Date:</label> <input class="textBox" type="text" value="2016-08-08" disabled="true"/></div>
                <div class="inputField"><label>Modified Date:</label> <input class="textBox" type="text" value="2016-08-08" disabled="true"/></div>
                <div class="inputField"><input class="submitButton" type="submit" value="Delete" /></div>
            </form>
        </fieldset>

        <fieldset class="inputFieldSet">
            <legend>Product Details</legend>
            <form id="userDetailsForm" action="members.html">
                <div class="inputField"><label>Primary Image :</label><img src="images/guitars/gibsonEpiphoneLimitedEditionLesPaulCustom/1.jpg" alt="Gibson Epiphone Limited Edition Les Paul Custom" width="100"><span class="imageInstructions"> (use landscape orientation)</span></div>
                <div class="inputField"><label>Upload :</label> <input type="file" /></div>
                <div class="inputField"><label>Model:</label> <input class="textBox" type="email" placeholder="e.g. Fender Standard Stratocaster" required/></div>
                <div class="inputField"><label>Brand:</label> <select><option>Fender</option></select></div>
                <div class="inputField"><label>Type:</label> <select><option>Electric Guitar</option></select></div>
                <div class="inputField"><label>Condition:</label> <select><option>Brand New</option></select></div>
                <div class="inputField"><label>Case:</label> <select><option>Hard Case</option></select></div>
                <div class="inputField"><input class="submitButton" type="submit" value="Update" /></div>
            </form>
        </fieldset>

        <fieldset class="inputFieldSet" id="stockDetailsFieldSet">
            <legend>Stock Details</legend>
            <form id="userDetailsForm" action="members.html">
                <div class="inputField"><label>Status:</label> <select><option>In Stock</option></select></div>
                <div class="inputField"><label>Price:</label> <input class="textBox" type="email" placeholder="e.g. 1001.20" required/></div>
                <div class="inputField"><label>Quantity:</label> <input class="textBox" type="email" placeholder="e.g. 1" required/></div>
                <div class="inputField"><input class="submitButton" type="submit" value="Update" /></div>
            </form>
        </fieldset>



    </div>
    <div class="centerBottomColumn">
        <fieldset class="inputFieldSet" id="aboutUsBlurbFieldSet">
            <legend>Edit Product Description</legend>
            <div class="controlPanelSection" id="faqEditorBox">
                <textarea name="aboutUsBlurb"></textarea>
            </div>
        </fieldset>
    </div>
    <div id="bottomButtonsBox">
        <form action="members.php?signout"><button class="formCSSButtonButton">Update</button></form>
        <form action="cart.html"><button class="formCSSButtonButton">View</button></form>
        <form action="orders.html"><button class="formCSSButtonButton">Back</button></form>
    </div>
</div>