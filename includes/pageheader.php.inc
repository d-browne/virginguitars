<?php
// This file displays the page header box

$isCustomerLoggedIn = false;    // Flag to check if cusomter is logged in
$itemsInCart = 0;               // Hold number of items in cart

// Check if customer defined in session
if (isset($_SESSION["currentCustomer"]))
{
    // check if customer is logged it
    if($_SESSION["currentCustomer"]->getIsInitialized())
    {
        // Set logged flag true
        $isCustomerLoggedIn = true;
    }
    
    // Get number of items in cart
    // Create data connection
    $database = new Database();
    $dataConnection = $database->getDataConnection();
    
    // Query to count number of items in cart
    $query = "SELECT SUM(Quantity) As Count FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."';";
    
    // Execute query
    $result = $dataConnection->query($query);
    
    // If query executed successfully
    if ($result !== false)
    {
        // If result returned
        if ($result->num_rows > 0)
        {
            // get row
            $row = $result->fetch_assoc();
            
            // Get value from row
            $itemsInCart = $row['Count'];
        }
    }
}
?>

<div id="headerBox">
    <?php
        // If admin Display "signed in as admin" label in header box
        if ($_SESSION["isAdmin"]) 
        {
            echo '<div id="signedInAsAdminLink"><a href="admin.php">[Signed in as admin]</a></div>';
        }
    ?>
    <a href="index.php"><img src="images/logo.png" width="213" height="200" alt="Virgin Guitars" class="logoImage"></a>
    <h1 class="mainHeader">Virgin Guitars</h1>
    <form action="search.php" method="GET">
        <input type="text" id="searchBox" name="model" placeholder="Site Search..." value="<?php if (isset($_GET['model']) && basename($_SERVER['PHP_SELF']) === "search.php") { echo htmlspecialchars($_GET['model']); } // Set value if search recieved on search page ?>"/>
    </form>

    <div id="checkOutBox">
        <?php if ($itemsInCart > 0): ?>
        <span id="cartItems"><a href="cart.php"><?php echo $itemsInCart; ?></a></span>
        <?php else: ?>
        <?php endif; ?>
        <a href="cart.php"><img src="images/cartIcon.png" id="cartIcon" width="32" height="42" alt="Cart"></a>
        <?php if ($isCustomerLoggedIn == true): ?>
        <a href="members.php?signOut" id="checkoutLink">Sign Out</a>
        <?php else: ?>
        <a href="members.php" id="checkoutLink">Sign In</a>
        <?php endif; ?>
    </div>
</div>