<?php
// Global includes
require 'includes/globalheader.php';

//Check if post recieved
if (isset($_POST['submit'])) {
    // Get email and password from POST
    $adminUsername = $_POST['adminUsername'];
    $adminPassword = $_POST['adminPassword'];
    
    // Check if username and password for admin are valid
    $admin = new Admin($adminUsername, $adminPassword);
    
    // If admin credentails check out set logged in flag to true
    if ($admin->getAuthenticated() == true)
    {
        $_SESSION["isAdmin"] = true;
    }
}

// Check if logout recieved and log out admin
if (isset($_GET["logout"]))
{
    $_SESSION["isAdmin"] = false;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars - Sign In</title>
<link href="styles/main.css" rel="stylesheet" type="text/css">
<link href="styles/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="scripts/js-image-slider.js" type="text/javascript"></script>
<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ 
    selector:'textarea', 
            content_css : 'styles/main.css', 
            content_style: "body {background-color: #FFFFFF !important;",
    toolbar: 'toolbar: undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | questionButton answerButton',
    setup: function (editor) {
        editor.addButton('questionButton', { // Function to add Question format to textarea
           text: false,
           image: 'images/editorIcons/q_icon.ico',
           onclick: function () {
               editor.insertContent('<p class="questionParagraph"><span class="questionLetter">Q:</span> Question</p>');
           }
        });
        editor.addButton('answerButton', {
           text: false,
           image: 'images/editorIcons/a_icon.ico',
           onclick: function () {
               editor.insertContent('<p class="answerParagraph"><span class="questionLetter">A:</span> Answer</p>');
           }
        });
    }
});</script>
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
        
        <?php
            // Check if admin is logged in
            if ($_SESSION["isAdmin"])
            {
                if (isset($_GET['faq']))
                {
                    include("includes/editFaq.php.inc");
                }
                else if (isset($_GET['aboutus']))
                {
                    include("includes/editAboutUs.php.inc");
                }
                else
                {
                    // If admin is logged in and no control selected dispaly admin page
                    include("includes/adminControlPanel.php.inc");
                }
            }
            else
            {
                // Otherwise display (include) admin login page
                include("includes/adminlogin.php.inc");
            }
            
        ?>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>

        </div>
</body>
</html>
