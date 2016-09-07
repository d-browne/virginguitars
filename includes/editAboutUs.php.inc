<?php
$contactUs = new ContactUs();
$isUpdated = false;
$hasError = false;
$updateResults = [];

// Check if editAboutUsButton clicked
if (isset($_POST['editAboutUsButton']))
{
    $buttonValue = $_POST['editAboutUsButton'];
    
    if ($buttonValue === "back")
    {
        // Redirect to admin panel
        header('Location: admin.php');
    }
    
    
    
    
    if ($buttonValue === "update")
    {
        // Update values
        $contactUs->setAboutUsBlurb($_POST['aboutUsBlurb']);
        $contactUs->setPrivacyBlurb($_POST['privacyPolicyBlurb']);
        array_push($updateResults, $contactUs->set_contact_email($_POST['email']));
        array_push($updateResults, $contactUs->set_contact_telephone($_POST['telephone']));
        array_push($updateResults, $contactUs->set_contact_address_line_1($_POST['address1']));
        array_push($updateResults, $contactUs->set_contact_address_line_2($_POST['address2']));
        array_push($updateResults, $contactUs->set_contact_address_line_3($_POST['address3']));
        array_push($updateResults, $contactUs->set_facebook_url($_POST['facebook']));
        array_push($updateResults, $contactUs->set_twitter_url($_POST['twitter']));
        array_push($updateResults, $contactUs->set_youtube_url($_POST['youtube']));
    }
    
    // Check if there are any errors in results
    foreach ($updateResults as $result)
    {
        // Not true
        if ($result !== true)
        {
            $hasError = true;
        }
    }
    
    // Set isUpdated flag
    $isUpdated = true;
}
?>

<div id="contentBox" class="aboutUsPage">
    <h1>Edit About Us <span class="updateSuccess"><?php if ($isUpdated) { echo "- Updated!"; } ?></span>
        <span class="updateError">
            <?php
                // Check if errors and display
                if ($hasError)
                {
                    echo " - Error: ";
                    // Loop through each error and display
                    foreach ($updateResults as $result)
                    {
                        if ($result !== true)
                        {
                            // Display the error
                            echo $result.", ";
                        }
                    }
                }
            ?>
        </span>
    </h1>

    <form action="admin.php?aboutus" method="POST">

        <fieldset class="inputFieldSet" id="aboutUsBlurbFieldSet">
            <legend>About Us Blurb</legend>
            <div class="controlPanelSection" id="faqEditorBox">
                <textarea name="aboutUsBlurb"><?php echo $contactUs->getAboutUsBlurb(); ?></textarea>
            </div>
        </fieldset>

        <fieldset class="inputFieldSet" id="contactDetailsFieldSet">
            <legend>Contact Us Details</legend>
            <div class="inputField"><label>Email:</label> <input name="email" class="textBox" type="email" placeholder="example@example.com" value="<?php echo $contactUs->get_contact_email(); ?>"/></div>
            <div class="inputField"><label>Telepone:</label> <input name="telephone" class="textBox" type="text" value="<?php echo $contactUs->get_contact_telephone(); ?>" /></div>
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
                <textarea name="privacyPolicyBlurb"><?php echo $contactUs->getPrivacyBlurb(); ?></textarea>
            </div>
        </fieldset>



        <div id="faqEditorButtons" class="controlPanelSection">
            <button type="submit" class="formCSSButtonButton" name="editAboutUsButton" value="update">Update</button>
            <button type="submit" class="formCSSButtonButton" name="editAboutUsButton" value="back">Back</button>
            <button type="reset" class="formCSSButtonButton" id="faqClearButton">Clear</button>
        </div>
    </form>


</div>