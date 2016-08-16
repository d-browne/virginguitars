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
</div>

<div id="rightColumn">
    <h1>Members</h1>
    <p>Welcome back to the members section! From here you can configure your members settings, change your shipping/billing information and your members details</p>
    <fieldset class="inputFieldSet" id="userDetailsFieldset">
        <legend>User details</legend>
        <form id="userDetailsForm" action="members.html">
            <div class="inputField"><label>Email:</label> <input class="textBox" type="email" value="<?php echo $_SESSION['currentCustomer']->getEmail(); ?>" required/></div>
            <div class="inputField"><label>Password:</label> <input class="textBox" type="password" placeholder="••••••••••••••••" /></div>
            <div class="inputField"><label>Re-Type Password:</label> <input class="textBox" type="password" placeholder="••••••••••••••••" /></div>
            <div class="inputField"><label>Subscribe to newsletter:</label> <input type="checkbox" <?php if($_SESSION['currentCustomer']->getMailingList() == 1) {echo "checked";} ?>></div>
            <div class="inputField"><input class="submitButton" type="submit" value="Submit" /></div>
        </form>
    </fieldset>

    <fieldset class="inputFieldSet" id="shippingDetailsFieldset">
        <legend>Shipping details</legend>
        <form id="shippingDetailsForm" action="members.html">
            <div class="inputField"><label>First Name:</label> <input class="textBox" type="text" value="April"/></div>
            <div class="inputField"><label>Last Name:</label> <input class="textBox" type="text" value="Frederick Stevenson"/></div>
            <div class="inputField"><label>Street Address:</label> <input class="textBox" type="text" value="26 Music Lane"/></div>
            <div class="inputField"><label>City:</label> <input class="textBox" type="text" value="Lismore" required/></div>
            <div class="inputField"><label>Post code:</label> <input class="textBox" type="text" value="2480" required/></div>
            <div class="inputField"><label>Country:</label> <input class="textBox" type="text" value="Australia" required/></div>
            <div class="inputField"><label>Telephone:</label> <input class="textBox" type="text" value="02 6690 156" required/></div>
            <div class="inputField"><input class="submitButton" type="submit" value="Submit" /></div>
        </form>
    </fieldset>

    <div id="bottomButtonsBox">
        <form action="members.php" method="GET"><button class="formCSSButtonButton" name="signOut" value="signOut">Signout</button></form>
        <form action="cart.html"><button class="formCSSButtonButton">Cart</button></form>
        <form action="orders.html"><button class="formCSSButtonButton">Orders</button></form>
    </div>
</div>