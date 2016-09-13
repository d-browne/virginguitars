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
<title>Administration</title>
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
                // Check update order post received
                if (isset($_POST['updateOrderButton']))
                {
                    // Create order instance
                    require_once 'classes/Order.php';
                    $order = new Order($_POST['orderid']);
                    
                    // Update street address
                    $order->setStreetAddress($_POST['streetaddress']);
                    // Update city
                    $order->setCity($_POST['city']);
                    // Update State
                    $order->setState($_POST['state']);
                    // Update PostCode
                    $order->setPostCode($_POST['postcode']);
                    // Update country
                    $order->setCountry($_POST['country']);
                    // Update shipped date
                    $order->setShippedDate($_POST['shippeddate']);
                    // Update shipping record
                    $order->setShippingRecord($_POST['shippingrecord']);
                    // Update order status
                    $order->setOrderStatus($_POST['orderstatus']);
                    
                    // Redirect (back) to order page
                    header('Location: admin.php?editOrder&id='.$_POST['orderid']);
                }
                
                if (isset($_GET['faq']))
                {
                    include("includes/editFaq.php.inc");
                }
                else if (isset($_GET['aboutus']))
                {
                    include("includes/editAboutUs.php.inc");
                }
                else if(isset($_GET['manageCustomers']))
                {
                    include("includes/manageCustomers.php.inc");
                }
                else if(isset($_GET['customerOrders']))
                {
                    // Check if CustomerID specified
                    if (isset($_GET['CustomerID']))
                    {
                        // Check if CustomerID is a real valid ID
                        $customerExists = Customer::doesCustomerExistID($_GET['CustomerID']);
                        
                        // If customer exists display customer orders page
                        if ($customerExists)
                        {
                            include("includes/customerOrders.php.inc");
                        }
                        else
                        {
                            // Display invalid customer id error
                            echo '<div id="contentBox"><p>Specified customer ID not found...</p></div>';
                        }
                    }
                    else
                    {
                        // Notify admin that a customer id must be specified
                        echo '<div id="contentBox"><p>A customer id must be specified...</p></div>';
                    }
                }
                else if (isset($_GET['editOrder']))
                {
                    // Check if id specified
                    if (isset($_GET['id']))
                    {
                        // Create data connection
                        $database = new Database();
                        $dataConnection = $database->getDataConnection();
                        
                        // Get and sanitize SalesOrderID
                        $SalesOrderID = mysqli_real_escape_string($dataConnection, $_GET['id']);
                        
                        // Query to check if order exists
                        $query = "SELECT * FROM SALES_ORDER WHERE SALES_ORDER.SalesOrderID=".$SalesOrderID.";";

                        // Execute the query
                        $result = $dataConnection->query($query);
                        
                        // Check if the query executed successfully
                        if ($result !== false)
                        {
                            // Check if results returned
                            if ($result->num_rows > 0)
                            {
                                // Include the edit order page
                                include 'includes/editOrder.php.inc';
                            }
                            else
                            {
                                // Display invalid order error
                                echo '<div id="contentBox"><p>Invalid order ID...</p></div>';
                            }
                        }
                        else
                        {
                            // Display error to administrator
                            echo '<div id="contentBox"><p>Unable to determine if order id exists... (query failed)</p></div>';
                        }
                    }
                    else
                    {
                        // Tell administraotr that an order id must be specified 
                        echo '<div id="contentBox"><p>An order ID must be specified...</p></div>';
                    }
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
