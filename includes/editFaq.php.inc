<?php
$faq = new FAQ(); // Create FAQ object
$updated = false; // Holds value of whether or not updated

// Check for form submitted
if (isset($_POST['editFaqButton']))
{
    $buttonValue = $_POST['editFaqButton'];
    
    // if back button pressed
    if ($buttonValue == 'back')
    {
        // Send back to admin menu
        header('Location: admin.php');
    }
    
    // If update button pressed
    if ($buttonValue == 'update')
    {
        // Set the updated faq data
        $faq->setData($_POST['faqData']);
        $updated = true;
    }
}
?>

<div id="contentBox">
    <h1>Edit F.A.Q. <span class="updateSuccess"><?php if ($updated == true) {echo '- Updated';} ?></span></h1>

    <form action="admin.php?faq" method="POST">
        <div class="controlPanelSection" id="faqEditorBox">
            <textarea name="faqData"><?php echo $faq->getData(); ?></textarea>
        </div>

        <div id="faqEditorButtons" class="controlPanelSection">
            <button type="submit" class="formCSSButtonButton" name="editFaqButton" value="update">Update</button>
            <button type="submit" class="formCSSButtonButton" name="editFaqButton" value="back">Back</button>
            <button type="reset" class="formCSSButtonButton" id="faqClearButton">Clear</button>
        </div>
    </form>
</div>