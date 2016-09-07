<?php
$contactUs = new ContactUs();
?>

<div id="contentBox" class="aboutUsPage">
    <h1>Edit About Us <span class="updateSuccess">- Updated!</span><span class="updateError">- Error: something</span></h1>

    <form action="admin.php" method="POST">

        <fieldset class="inputFieldSet" id="aboutUsBlurbFieldSet">
            <legend>About Us Blurb</legend>
            <div class="controlPanelSection" id="faqEditorBox">
                <textarea name="aboutUsBlurb"></textarea>
            </div>
        </fieldset>

        <fieldset class="inputFieldSet" id="contactDetailsFieldSet">
            <legend>Contact Us Details</legend>
            <div class="inputField"><label>Email:</label> <input name="email" class="textBox" type="email" placeholder="example@example.com" value="<?php echo $contactUs->get_contact_email(); ?>"/></div>
            <div class="inputField"><label>Telepone:</label> <input name="telephone" class="textBox" type="text" pattern="[^\d\(\) ]" value="<?php echo $contactUs->get_contact_telephone(); ?>" /></div>
            <div class="inputField"><label>Address:</label> <input name="address1" class="textBox" type="text" value="<?php echo $contactUs->get_contact_address_line1(); ?>" /></div>
            <div class="inputField"><label>Address:</label> <input name="address2" class="textBox" type="text" value="<?php echo $contactUs->get_contact_address_line2(); ?>" /></div>
            <div class="inputField"><label>Address:</label> <input name="address3" class="textBox" type="text" value="<?php echo $contactUs->get_contact_address_line3(); ?>" /></div>
            <div class="inputField"><label>Facebook Url:</label> <input name="facebook" class="textBox" type="text" value="<?php echo $contactUs->get_facebook_url(); ?>" /></div>
            <div class="inputField"><label>Twitter Url:</label> <input name="twitter" class="textBox" type="text" value="<?php echo $contactUs->get_twitter_url(); ?>" /></div>
            <div class="inputField"><label>Youtube Url:</label> <input name="youtube" class="textBox" type="text" value="<?php echo $contactUs->get_youtube_url(); ?>" /></div>
        </fieldset>

        <fieldset class="inputFieldSet" id="privacyPolicyFieldSet">
            <legend>Privacy Policy Blurb</legend>
            <div class="controlPanelSection" id="faqEditorBox">
                <textarea name="privacyPolicyBlurb"></textarea>
            </div>
        </fieldset>



        <div id="faqEditorButtons" class="controlPanelSection">
            <button type="submit" class="formCSSButtonButton" name="editAboutUsButton" value="update">Update</button>
            <button type="submit" class="formCSSButtonButton" name="editAboutUsButton" value="back">Back</button>
            <button type="reset" class="formCSSButtonButton" id="faqClearButton">Clear</button>
        </div>
    </form>


</div>