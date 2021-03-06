<div id="leftColumn">
    <!-- Image slider code goes in here -->
    <div id="sliderFrame">
        <div id="slider">
                			<img src="images/guitars/jacksonDk2DinkyHotRodFlames/resized2.jpg" alt=""/>
                			<img src="images/guitars/bcRichKerryKingMetalMasterTribalFireWarlock/resized6.jpg" alt=""/>
                			<img src="images/guitars/gibsonLesPaultStudio/resized3.jpg" alt=""/>
                			<img src="images/guitars/fenderSquireMijStratocaster/resized2.jpg" alt=""/>
                			<img src="images/guitars/jacksonKvmgProSeriesKingV/resized3.jpg" alt=""/>
                			<img src="images/guitars/bcRichMockingBirdProX/resized3.jpg" alt=""/>
                			<img src="images/guitars/gibsonEpiphoneLimitedEditionLesPaulCustom/resized3.jpg" alt=""/>
                			<img src="images/guitars/fenderAmericanStandardStratocaster/resized2.jpg" alt=""/>
                			<img src="images/guitars/jacksonPdx2DemmelitionKingV/resized7.jpg" alt=""/>
                			<img src="images/guitars/bcRichMockingbirdSt/resized3.jpg" alt=""/>
        			</div>
        <div id="htmlcaption" style="display: none;">
            <em>HTML</em> caption. Link to <a href="http://www.google.com/">Google</a>.
        </div>
    </div> 
</div>

<div id="rightColumn">
    <h1>Members</h1>
            <p>Welcome back to the members section! From here you can configure your members settings, change your shipping/billing information and your members details.
                <span id="updatedMemberLabel">
                    <?php
                        // Write updated if updated flag set
                        if ($isUpdated)
                        {
                            echo " Updated!";
                        }
                    ?>
                </span>
                <span id="updatedMemberErrorLabel">
                    <?php
                        // Write the error message if there is an error updating member
                        if (isset($updateMemberError))
                        {
                            echo " ".$updateMemberError;
                        }
                    ?>
                </span>
            </p>
    <fieldset class="inputFieldSet" id="userDetailsFieldset">
        <legend>User details</legend>
        <form id="userDetailsForm" action="members.php" method="POST">
            <div class="inputField"><label>Email:</label> <input class="textBox" type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getEmail()); ?>" required/></div>
            <div class="inputField"><label>Re-Type Email:</label> <input class="textBox" type="email" name="emailConfirm" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getEmail()); ?>" required/></div>
            <div class="inputField"><label>Password:</label> <input class="textBox" type="password" name="password" placeholder="••••••••••••••••" /></div>
            <div class="inputField"><label>Re-Type Password:</label> <input class="textBox" type="password" name="passwordConfirm" placeholder="••••••••••••••••" /></div>
            <div class="inputField"><label>Subscribe to newsletter:</label> <input type="checkbox" name="mailingList" <?php if($_SESSION['currentCustomer']->getMailingList() == 1) {echo "checked";} ?>></div>
            <div class="inputField"><input class="submitButton" type="submit" name="updateMember" value="Submit" /></div>
        </form>
    </fieldset>

    <fieldset class="inputFieldSet" id="personalDetailsFieldset">
        <legend>Personal Details</legend>
        <form id="personalDetailsForm" action="members.php" method="POST">
            <div class="inputField"><label>Salutation:</label> <input class="textBox" name="salutation" type="text" placeholder="e.g. Mrs." value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getSalutation()); ?>"/></div>
            <div class="inputField"><label>First Name:</label> <input class="textBox" name="firstname" type="text" placeholder="e.g. April" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getFirstName()); ?>"/></div>
            <div class="inputField"><label>Last Name:</label> <input class="textBox" name="lastname" type="text" placeholder="e.g. Frederick Stevenson" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getLastName()); ?>"/></div>
            <div class="inputField"><label>Street Address:</label> <input class="textBox" name="street" type="text" placeholder="e.g. 26 Music Lane" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getHomeAddress()->getStreetAddress()); ?>"/></div>
            <div class="inputField"><label>City:</label> <input class="textBox" type="text" name="city" nameplaceholder="e.g. Lismore"value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getHomeAddress()->getCity()); ?>" /></div>
            <div class="inputField"><label>Post code:</label> <input class="textBox" type="text" name="postcode" placeholder="e.g. 2480" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getHomeAddress()->getPostCode()); ?>" /></div>
            <div class="inputField"><label>Country:</label> <input class="textBox" type="text" name="country" placeholder="e.g. Australia" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getHomeAddress()->getCountry()); ?>" /></div>
            <div class="inputField"><label>Home Telephone:</label> <input class="textBox" type="text" name="homephone" placeholder="e.g. (02) 6690 1566" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getHomePhone()); ?>" /></div>
            <div class="inputField"><label>Mobile Telephone:</label> <input class="textBox" type="text" name="mobilephone" placeholder="e.g. 0489 321 153" value="<?php echo htmlspecialchars($_SESSION['currentCustomer']->getMobilePhone()); ?>" /></div>
            <div class="inputField"><input class="submitButton" type="submit" name="updatePersonalDetails" value="Submit" /></div>
        </form>
    </fieldset>

    <div id="bottomButtonsBox">
        <form action="members.php" method="GET"><button class="formCSSButtonButton" name="signOut" value="signOut">Signout</button></form>
        <form action="cart.php"><button class="formCSSButtonButton">Cart</button></form>
        <form action="orders.php"><button class="formCSSButtonButton">Orders</button></form>
    </div>
</div>